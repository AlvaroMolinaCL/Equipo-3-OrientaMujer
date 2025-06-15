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

        // Calcular el total aquí mismo
        $total = $cart->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('tenants.default.checkout.index', [
            'cart' => $cart,
            'items' => $cart->items,
            'total' => $total // Pasar el total calculado a la vista
        ]);
    }

    public function process(Request $request)
    {
        $request->validate([
            'total_amount' => 'required|numeric|min:100'
        ]);

        $user = auth()->user();
        $cart = Cart::with('items.product')
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->firstOrFail();

        // Usar el total recibido del formulario
        $total = $request->total_amount;

        // Crear la orden con el total
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $total,
            'status' => 'pending',
            'payment_method' => 'webpay'
        ]);

        session(['current_order_id' => $order->id]);


        // Guardar items de la orden
        foreach ($cart->items as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price
            ]);
        }

        // Guardar en sesión
        session([
            'current_order_id' => $order->id,
            'current_cart_id' => $cart->id,
            'transbank_amount' => $total
        ]);

        // Redirigir al proceso de pago
        return view('tenants.default.checkout.process', [
            'amount' => $total,
            'order' => $order
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
