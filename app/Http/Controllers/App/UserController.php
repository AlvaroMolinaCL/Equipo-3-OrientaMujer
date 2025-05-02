<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Tenant;
use Stancl\Tenancy\Facades\Tenancy;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{

    public function index()
    {
        $users = User::with('roles')->get();
        return view('app.users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('app.users.create');
    }

    public function store(Request $request)
    {
    
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create($validateData);

        return redirect()->route('users.index');

    }

    public function edit(User $user)
    {
        $roles = Role::get();
        return view('app.users.edit', ['user' => $user, 'roles'=>$roles]);
    }

    public function update(Request $request, User $user)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'roles'=>'required|array'
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
