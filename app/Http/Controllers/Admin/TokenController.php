<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TokenController extends Controller
{
    /**
     * Mostrar el token actual.
     * Generar un nuevo token al inicio del día si no existe.
     */
    public function show()
    {
        // Verificar si el token actual ya fue generado para el día de hoy
        $token = Cache::get('current_token');

        // Si no existe un token, generarlo
        if (!$token) {
            $token = $this->generateToken();
            Cache::put('current_token', $token, now()->endOfDay()); // El token expira a las 11:59 PM
        }

        return view('admin.token', compact('token'));
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
