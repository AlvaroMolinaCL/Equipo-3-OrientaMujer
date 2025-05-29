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
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id(), 'status' => 'active']
        );

        $product = Product::findOrFail($request->product_id);

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

        return redirect()->route('agenda.questionnaire')->with('success', 'Producto agregado al carrito.');
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
