<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\SuperAdminRequest;


class TokenController extends Controller
{
    /**
     * Mostrar el token actual.
     * Generar un nuevo token al inicio del día si no existe.
     */

public function show()
{
    $token = Cache::get('current_token');

    if (!$token) {
        $token = $this->generateToken();
        Cache::put('current_token', $token, now()->endOfDay());
    }

    // Esta es la línea que te falta:
    $solicitudes = SuperAdminRequest::where('approved', false)->get();

    return view('admin.token', compact('token', 'solicitudes'));
}


    /**
     * Generar un token único y complejo basado en la fecha actual.
     *
     * @return string
     */
    protected function generateToken()
    {
        // Generar un token complejo
        return strtoupper(Str::random(4)) . '-' . strtoupper(Str::random(4)) . '-' . rand(1000, 9999);
    }
}
