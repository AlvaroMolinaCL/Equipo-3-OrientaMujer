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


class UserController extends Controller
{

    public function index()
    {
        $users = User::get();
        return view('app.users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('app.users.create');
    }

    public function store(Request $request)
    {
        //validation
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create($validateData);

        return redirect()->route('users.index');

    }


}
