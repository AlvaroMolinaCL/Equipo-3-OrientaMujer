<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        if (tenant()) {
            return view(tenantView('auth.register'));
        }

        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $noUsersExist = User::count() === 0;

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ];

        // Solo pedir access_token si ya hay usuarios
        if (!$noUsersExist) {
            $rules['access_token'] = 'required|string';
        }

        $request->validate($rules);

        // Validar token si ya hay usuarios
        if (!$noUsersExist) {
            $submittedToken = $request->access_token;

            // Obtener el token actual desde el cache
            $currentToken = Cache::get('current_token');

            if ($submittedToken !== $currentToken) {
                return back()->withErrors(['access_token' => 'El token de acceso es incorrecto.'])->withInput();
            }

            // Cambiar el token después de que alguien lo haya usado
            $this->changeToken();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('Super Admin');

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Cambiar el token dinámicamente.
     */
    protected function changeToken()
    {
        // Generar un nuevo token
        $newToken = strtoupper(Str::random(4)) . '-' . strtoupper(Str::random(4)) . '-' . rand(1000, 9999);

        // Guardar el nuevo token en el cache
        Cache::put('current_token', $newToken, now()->endOfDay()); // Expira a las 11:59 PM
    }
}
