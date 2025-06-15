<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id(), 'status' => 'active']
        );

        $items = $cart->items()->with('product')->get();

        return view('checkout', compact('cart', 'items'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id(), 'status' => 'active']
        );

        // Antes de agregar el nuevo producto, limpia los anteriores
        $cart->items()->delete();

        $product = Product::findOrFail($request->product_id);

        // Agrega el nuevo producto con cantidad fija 1
        CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->price,
        ]);

        return redirect()->route('tenant.agenda.questionnaire')->with('success', 'Producto agregado al carrito.');
    }



    public function remove($itemId)
    {
        $item = CartItem::findOrFail($itemId);
        $item->delete();

        return redirect()->back()->with('success', 'Producto eliminado.');
    }


    public function clear()
    {
        $cart = Cart::where('user_id', auth()->id())
            ->where('status', 'active')
            ->firstOrFail();

        $cart->items()->delete();

        return back()->with('success', 'Carrito vaciado correctamente');
    }


}
