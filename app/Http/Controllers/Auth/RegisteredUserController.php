<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view(tenantView('auth.register'));

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
            $expectedToken = substr(hash_hmac('sha256', now()->format('Y-m-d'), config('app.key')), 0, 6);

            if ($request->access_token !== $expectedToken) {
                return back()->withErrors(['access_token' => 'El token de acceso es incorrecto.'])->withInput();
            }
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


}