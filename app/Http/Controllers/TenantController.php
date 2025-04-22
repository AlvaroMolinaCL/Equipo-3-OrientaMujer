<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Tenant;  // Asegúrate de usar la clase personalizada
use Stancl\Tenancy\Facades\Tenancy;
use App\Models\User;

class TenantController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos
        $validated = $request->validate([
            'nombre' => 'required|alpha_dash|unique:tenants,id',
            'empresa' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'logo' => 'nullable|image|max:2048',
        ]);

        // Subir logo (si se envió)
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store("tenants/{$validated['nombre']}/logo", 'public');
            // Verifica si la subida fue exitosa
            if (!$logoPath) {
                return redirect()->back()->withErrors(['logo' => 'Error al subir el logo.']);
            }
        } else {
            return redirect()->back()->withErrors(['logo' => 'El archivo de logo es obligatorio.']);
        }


        // Crear el tenant
        $tenant = Tenant::create([
            'id' => $validated['nombre'], // Este será el subdominio
            'data' => [
                'empresa' => $validated['empresa'],
                'logo' => $logoPath,
            ],
        ]);

        // Asociar un dominio al tenant y guardarlo en la base de datos central
        $tenant->domains()->create([
            'domain' => "{$validated['nombre']}.localhost" // Ajusta el dominio según sea necesario
        ]);

        // Ejecutar migraciones del tenant
        $tenant->run(function () use ($validated) {
            // Crear usuario administrador
            User::create([
                'name' => 'Administrador',
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);
        });

        // Redirigir con mensaje de éxito
        return redirect()->back()->with('success', 'Tenant creado correctamente.');
    }

}
