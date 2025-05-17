<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();

        if (tenant()) {
            return view(tenantView('users'), ['users' => $users]);
        }

        return view('users.index', ['users' => $users]);
    }

    public function create(User $user)
    {
        $roles = Role::get();

        if (tenant()) {
            return view(tenantView('create-users'), ['user' => $user, 'roles' => $roles]);
        }

        return view('users.create', ['user' => $user, 'roles' => $roles]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'roles' => 'required|array'
        ]);

        $user = User::create($validateData);
        $user->roles()->sync($request->input('roles'));

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        $roles = Role::get();

        if (tenant()) {
            return view(tenantView('edit-users'), ['user' => $user, 'roles' => $roles]);
        }

        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    public function update(Request $request, User $user)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'roles' => 'required|array'
        ]);

        $user->update($validateData);
        $user->roles()->sync($request->input('roles'));

        return redirect()->route('users.index');
    }

    public function destroy(\App\Models\User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}
