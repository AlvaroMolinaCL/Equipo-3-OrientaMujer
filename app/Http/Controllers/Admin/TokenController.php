<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    /**
     * Mostrar el token actual del día.
     */
    public function show()
    {
        $token = substr(hash_hmac('sha256', now()->format('Y-m-d'), config('app.key')), 0, 6);
        return view('admin.token', compact('token'));
    }
}
