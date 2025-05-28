<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

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
}