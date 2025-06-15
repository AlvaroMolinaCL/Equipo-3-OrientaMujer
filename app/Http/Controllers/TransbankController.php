<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;
use Illuminate\Support\Facades\Log;

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
            $amount = $request->input('amount');
            $sessionId = uniqid();
            $buyOrder = 'ORD-' . time() . '-' . rand(1000, 9999);
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