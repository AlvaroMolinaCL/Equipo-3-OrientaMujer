<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Tenant;
use Stancl\Tenancy\Facades\Tenancy;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;


class TenantController extends Controller
{

    public function index()
    {
        $tenants = Tenant::with('domains')->get();
        return view('tenants.index', ['tenants' => $tenants]);
    }

    public function create()
    {
        return view('tenants.create');
    }

    public function store(Request $request)
    {
        //validation
        $validationData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'domain_name' => 'required|string|max:255|unique:domains,domain',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $tenant = Tenant::create($validationData);

        $tenant->domains()->create([
            'domain' => $validationData['domain_name'] . '.' . config('app.domain')
        ]);

        return redirect()->route('tenants.index');

    }

    public function destroy(Tenant $tenant)
    {
        // Eliminar el tenant y sus dominios
        $tenant->domains()->delete();
        $tenant->delete();

        // Redirigir después de eliminar
        return redirect()->route('tenants.index')->with('success', 'Tenant eliminado con éxito');
    }

    


}
