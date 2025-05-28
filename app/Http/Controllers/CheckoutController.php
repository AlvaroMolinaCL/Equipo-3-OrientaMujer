<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;

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

        // Validación de datos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'payment_method' => 'required|in:credit_card,transfer'
        ]);

        // Obtener el carrito activo
        $cart = Cart::with('items')
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->firstOrFail();

        // Aquí iría la lógica real de procesamiento de pago
        // Simulamos que el pago fue aprobado

        // Crear la orden
        $order = Order::create([
            'user_id' => $user->id, // Ahora es fillable
            'total' => $cart->items->sum(function ($item) {
                return $item->price * $item->quantity;
            }),
            'status' => 'completed',
            'payment_method' => $validated['payment_method']
        ]);

        // Asociar los items del carrito a la orden
        foreach ($cart->items as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price
            ]);
        }

        // Marcar el carrito como completado (no lo borramos físicamente)
        $cart->update(['status' => 'completed']);

        // Opcional: Borrar físicamente los items del carrito
        $cart->items()->delete();

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