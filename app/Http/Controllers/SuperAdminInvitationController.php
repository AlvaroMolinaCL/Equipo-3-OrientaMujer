<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SuperAdminInvitation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class SuperAdminInvitationController extends Controller
{
    public function form($token)
    {
        $invitacion = SuperAdminInvitation::where('token', $token)->where('used', false)->firstOrFail();
        return view('auth.registro-superadmin', ['email' => $invitacion->email, 'token' => $token]);
    }

    public function register(Request $request, $token)
    {
        $invitacion = SuperAdminInvitation::where('token', $token)->where('used', false)->firstOrFail();

        $request->validate([
            'name' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $invitacion->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('Super Admin');

        $invitacion->update(['used' => true]);

        auth()->login($user);

        return redirect('/dashboard')->with('success', 'Bienvenido, Super Administrador.');
    }
}
