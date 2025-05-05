<?php

namespace App\Http\Controllers;

use App\Jobs\SeedTenantJob;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::with('domains')->get();
        return view('index', ['tenants' => $tenants]);
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validationData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'domain_name' => 'required|string|max:255|unique:domains,domain',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $tenant = Tenant::create([
            'id' => $validationData['domain_name'],
            'name' => $validationData['name'],
            'email' => $validationData['email'],
        ]);

        $tenant->domains()->create([
            'domain' => $validationData['domain_name'] . '.' . config('app.domain')
        ]);

        SeedTenantJob::dispatch($tenant, Hash::make($validationData['password']));

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
        return view('edit', compact('tenant'));
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

    public function seedPermissions(Tenant $tenant)
    {
        // Ejecuta el seeder dentro del contexto del tenant
        $tenant->run(function () {
            Artisan::call('db:seed', [
                '--class' => 'TenantPermissionSeeder',
                '--force' => true
            ]);
        });

        return redirect()->route('tenants.index')->with('success', 'Permisos sembrados en el tenant correctamente.');
    }

    public function editPermissions(Tenant $tenant)
    {
        $permisosDisponibles = include resource_path('data/permisos_disponibles.php');

        return view('tenants.edit-permissions', [
            'tenant' => $tenant,
            'permisos' => $permisosDisponibles,
        ]);
    }

    public function updatePermissions(Request $request, Tenant $tenant)
    {
        $permisosSeleccionados = $request->input('permisos', []);

        $tenant->run(function () use ($permisosSeleccionados) {
            // Crear o actualizar los permisos
            foreach ($permisosSeleccionados as $permiso) {
                \Spatie\Permission\Models\Permission::firstOrCreate([
                    'name' => $permiso,
                    'guard_name' => 'web',
                ]);
            }

            // Eliminar permisos que ya no están seleccionados
            $todos = \Spatie\Permission\Models\Permission::pluck('name')->toArray();
            $aEliminar = array_diff($todos, $permisosSeleccionados);
            \Spatie\Permission\Models\Permission::whereIn('name', $aEliminar)->delete();

            // Opcional: actualizar rol admin
            $admin = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
            $admin->syncPermissions($permisosSeleccionados);
        });

        return redirect()->route('tenants.index')->with('success', 'Permisos actualizados.');
    }
}
