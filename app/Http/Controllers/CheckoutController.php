<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\Appointment;
use App\Models\AvailableSlot;
use App\Mail\AppointmentConfirmationMail;


class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::with('items.product')
            ->where('user_id', auth()->id())
            ->where('status', 'active')
            ->firstOrFail();

        return view('tenants.default.checkout.index', [
            'cart' => $cart,
            'items' => $cart->items
        ]);
    }

    public function process(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'payment_method' => 'required|in:tarjeta,transferencia'
        ]);

        $cart = Cart::with('items.product')
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->firstOrFail();

        $order = Order::create([
            'user_id' => $user->id,
            'total' => $cart->items->sum(function ($item) {
                return $item->price * $item->quantity;
            }),
            'status' => 'completed',
            'payment_method' => $validated['payment_method']
        ]);

        foreach ($cart->items as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price
            ]);
        }

        $cart->update(['status' => 'completed']);

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

        if ($slotId && $firstName && $lastName && $secondLastName && $email && $phoneNumber && $residenceRegionId && $residenceCommuneId && $incidentRegionId && $incidentCommuneId && $questionnaireResponseId) {
            $slot = AvailableSlot::find($slotId);

            if ($slot) {
                Appointment::create([
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
                    'questionnaire_response_id' => $questionnaireResponseId
                ]);

                $userName = $user->name;
                $productNames = $cart->items->map(function ($item) {
                    return $item->product->name ?? 'Producto desconocido';
                })->toArray();

                Mail::to($user->email)->send(
                    new AppointmentConfirmationMail($userName, $slot, $productNames)
                );
            }

            session()->forget(['appointment_slot_id', 'appointment_description']);
        }

        Mail::to($user->email)->send(new OrderConfirmationMail($order));

        return redirect()->route('checkout.success')->with([
            'order_id' => $order->id,
            'total' => $order->total
        ]);
    }

    public function success(Request $request)
    {
        return view('tenants.default.checkout.success', [
            'order_id' => session('order_id'),
            'total' => session('total')
        ]);
    }
}
