<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Ver el carrito
    public function index()
    {
        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id(), 'status' => 'active']
        );

        $items = $cart->items()->with('product')->get();

        return view('cart.index', compact('cart', 'items'));
    }

    // Agregar producto al carrito
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id(), 'status' => 'active']
        );

        $product = Product::findOrFail($request->product_id);

        // Ver si ya está
        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            $item->quantity += $request->quantity;
            $item->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->price,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Producto agregado al carrito.');
    }

    // Eliminar item del carrito
    public function remove($itemId)
    {
        $item = CartItem::findOrFail($itemId);
        $item->delete();

        return redirect()->route('cart.index')->with('success', 'Producto eliminado.');
    }
}
