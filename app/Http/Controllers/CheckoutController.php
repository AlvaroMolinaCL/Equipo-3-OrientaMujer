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
            'payment_method' => 'required|in:credit_card,transfer'
        ]);

        $cart = Cart::with('items.product')
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->firstOrFail();

        // Crear la orden
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $cart->items->sum(function ($item) {
                return $item->price * $item->quantity;
            }),
            'status' => 'completed',
            'payment_method' => $validated['payment_method']
        ]);

        // Asociar items
        foreach ($cart->items as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price
            ]);
        }

        // Actualizar carrito
        $cart->update(['status' => 'completed']);


        $slotId = session('appointment_slot_id');
        $description = session('appointment_description');

        if ($slotId && $description) {
            $slot = AvailableSlot::find($slotId); // <- ESTA LÍNEA ES CLAVE

            if ($slot) {
                // ❗ Verificación temporalmente desactivada:
                // if ($slot->appointments()->count() < $slot->max_bookings) {
                Appointment::create([
                    'user_id' => $user->id,
                    'available_slot_id' => $slotId,
                    'description' => $description
                ]);
                // }
            }

            session()->forget(['appointment_slot_id', 'appointment_description']);
        }

        // Enviar correo de confirmación
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