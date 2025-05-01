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

    public function edit(Tenant $tenant)
    {
        return view('tenants.edit', compact('tenant'));
    }


    public function update(Request $request, Tenant $tenant)
        {
            // 1. Validar entrada
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'domain_name' => 'required|string|max:255',
                'password' => 'nullable|string|min:8|confirmed',
            ]);
        
            // 2. Actualizar datos en la base de datos central (laravel)
            $tenant->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);
        
            $tenant->domains()->update([
                'domain' => $validated['domain_name'],
            ]);
        
            // 3. Inicializar el tenant (cambia el contexto a la base de datos del tenant)
            tenancy()->initialize($tenant);
        
            // 4. Actualizar el usuario dentro de la base de datos del tenant
            $user = User::first(); // Asumimos que hay solo un usuario principal por tenant
        
            if ($user) {
                $user->name = $validated['name'];
                $user->email = $validated['email'];
        
                if (!empty($validated['password'])) {
                    $user->password = Hash::make($validated['password']);
                }
        
                $user->save();
            }
        
            tenancy()->end(); // Finaliza el contexto del tenant
        
            return redirect()->route('tenants.index')->with('success', 'Tenant y usuario actualizados correctamente.');
        }
}