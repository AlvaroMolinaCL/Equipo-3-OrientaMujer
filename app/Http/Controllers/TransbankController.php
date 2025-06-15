<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Models\Cart;



class TransbankController extends Controller
{
    public function __construct()
    {
        if (config('app.env') == 'production') {
            WebpayPlus::configureForProduction(
                config('services.transbank.commerce_code'),
                config('services.transbank.api_key')
            );
        } else {
            WebpayPlus::configureForTesting();
        }
    }
    public function createTransaction(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:100'
        ]);

        try {
            $orderId = session('current_order_id');
            if (!$orderId) {
                return back()->with('error', 'No se encontró la orden para procesar el pago.');
            }
            $amount = $request->input('amount');
            $sessionId = uniqid();
            $buyOrder = $orderId;
            $returnUrl = route('transbank.response');

            $response = (new Transaction)->create($buyOrder, $sessionId, $amount, $returnUrl);

            return view('tenants.default.webpay.redirect', [
                'url' => $response->getUrl(),
                'token' => $response->getToken()
            ]);

        } catch (\Exception $e) {
            Log::error('Error al crear transacción: ' . $e->getMessage());
            return back()->with('error', 'Error al iniciar el pago');
        }
    }

    public function response(Request $request)
    {
        // Compatibilidad con GET y POST
        $token = $request->input('token_ws', $request->query('token_ws'));

        if (!$token) {
            Log::warning('Transacción cancelada - Sin token recibido');
            return view('tenants.default.webpay.cancelled');
        }

        try {
            $response = (new Transaction)->commit($token);

            if ($response->isApproved()) {
                Log::info('Pago aprobado', [
                    'buyOrder' => $response->getBuyOrder(),
                    'amount' => $response->getAmount(),
                    'authorizationCode' => $response->getAuthorizationCode()
                ]);

                // Recuperar datos guardados en sesión (del formulario anterior al pago)
                $user = auth()->user();
                $slotId = session('appointment_slot_id');
                $firstName = session('appointment_first_name');
                $lastName = session('appointment_last_name');
                $secondLastName = session('appointment_second_last_name');
                $email = session('appointment_email');
                $phoneNumber = session('appointment_phone_number');
                $residenceRegionId = session('appointment_residence_region_id');
                $residenceCommuneId = session('appointment_residence_commune_id');
                $incidentRegionId = session('appointment_incident_region_id');
                $incidentCommuneId = session('appointment_incident_commune_id');
                $questionnaireResponseId = session('appointment_questionnaire_response_id');

                // Crear la cita si todo está presente
                if ($slotId && $firstName && $lastName && $secondLastName && $email && $phoneNumber && $residenceRegionId && $residenceCommuneId && $incidentRegionId && $incidentCommuneId && $questionnaireResponseId) {
                    \App\Models\Appointment::create([
                        'user_id' => $user->id,
                        'available_slot_id' => $slotId,
                        'first_name' => $firstName,
                        'last_name' => $lastName,
                        'second_last_name' => $secondLastName,
                        'email' => $email,
                        'phone_number' => $phoneNumber,
                        'residence_region_id' => $residenceRegionId,
                        'residence_commune_id' => $residenceCommuneId,
                        'incident_region_id' => $incidentRegionId,
                        'incident_commune_id' => $incidentCommuneId,
                        'questionnaire_response_id' => $questionnaireResponseId,
                        'description' => 'Pago confirmado. Cita generada automáticamente.'
                    ]);


                    $order = Order::find($response->getBuyOrder());

                    if ($order && $order->status !== 'completed') {
                        $order->update(['status' => 'completed']);

                        // Obtener el usuario relacionado con la orden o el usuario autenticado
                        $user = $order->user ?? auth()->user();
                        $userName = $user ? $user->name : 'Usuario desconocido';

                        // Si tienes un carrito asociado, obtén los productos; si no, deja vacío
                        $cart = Cart::with('items.product')
                            ->where('user_id', $order->user_id)
                            ->where('status', 'active')
                            ->first();

                        $productNames = $cart ? $cart->items->map(function ($item) {
                            return $item->product->name ?? 'Producto desconocido';
                        })->toArray() : [];

                        $slot = \App\Models\AvailableSlot::find($slotId);

                        if ($user && $user->email) {
                            Mail::to($user->email)->send(
                                new \App\Mail\AppointmentConfirmationMail($userName, $slot, $productNames)
                            );
                        }
                        // Puedes enviar correo de confirmación aquí también
                        Mail::to($order->user->email)->send(new \App\Mail\OrderConfirmationMail($order));
                    }

                    // Limpiar datos de sesión
                    session()->forget([
                        'appointment_slot_id',
                        'appointment_first_name',
                        'appointment_last_name',
                        'appointment_second_last_name',
                        'appointment_email',
                        'appointment_phone_number',
                        'appointment_residence_region_id',
                        'appointment_residence_commune_id',
                        'appointment_incident_region_id',
                        'appointment_incident_commune_id',
                        'appointment_questionnaire_response_id'
                    ]);
                }

                return view('tenants.default.webpay.success', [
                    'buyOrder' => $response->getBuyOrder(),
                    'amount' => $response->getAmount(),
                    'authorizationCode' => $response->getAuthorizationCode(),
                    'transactionDate' => $response->getTransactionDate()
                ]);
            }

            // Obtener mensaje de error correctamente para SDK 2.0
            $errorMessage = $this->getResponseMessage($response->getResponseCode());

            Log::warning('Pago rechazado', [
                'buyOrder' => $response->getBuyOrder(),
                'responseCode' => $response->getResponseCode(),
                'errorMessage' => $errorMessage
            ]);

            return view('tenants.default.webpay.failure', [
                'buyOrder' => $response->getBuyOrder(),
                'responseCode' => $response->getResponseCode(),
                'errorMessage' => $errorMessage
            ]);

        } catch (\Exception $e) {
            Log::error('Error al confirmar pago: ' . $e->getMessage());
            return view('tenants.default.webpay.failure')->with('error', $e->getMessage());
        }
    }

    /**
     * Obtiene el mensaje de respuesta según el código (para SDK 2.0)
     */
    protected function getResponseMessage($responseCode)
    {
        $messages = [
            -1 => 'Transacción rechazada',
            0 => 'Transacción aprobada',
            1 => 'Transacción rechazada por tarjeta inválida',
            2 => 'Transacción rechazada por fondos insuficientes',
            3 => 'Transacción rechazada por tarjeta vencida',
            4 => 'Transacción rechazada por tarjeta restringida',
            5 => 'Transacción rechazada por error en el proceso',
            6 => 'Transacción rechazada por intentos excedidos',
            7 => 'Transacción rechazada por tarjeta bloqueada',
            8 => 'Transacción rechazada por tarjeta reportada',
            97 => 'Límite excedido en monto de transacciones',
            98 => 'Límite excedido en frecuencia de transacciones',
            99 => 'Transacción rechazada por error general'
        ];

        return $messages[$responseCode] ?? 'Error desconocido en la transacción';
    }
}