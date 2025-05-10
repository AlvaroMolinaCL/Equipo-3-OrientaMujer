<?php

namespace App\Http\Controllers;

use App\Jobs\SeedTenantJob;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

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
        $validationData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'domain_name' => 'required|string|max:255|unique:domains,domain',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'logo_1' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
            'logo_2' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
            'background_color_1' => 'nullable|string|max:7',
            'text_color_1' => 'nullable|string|max:7',
            'background_color_2' => 'nullable|string|max:7',
            'text_color_2' => 'nullable|string|max:7',
            'navbar_color_1' => 'nullable|string|max:7',
            'navbar_text_color_1' => 'nullable|string|max:7',
            'navbar_color_2' => 'nullable|string|max:7',
            'navbar_text_color_2' => 'nullable|string|max:7',
            'navbar_font' => 'nullable|string|max:255',
            'heading_font' => 'nullable|string|max:255',
            'body_font' => 'nullable|string|max:255',
        ]);

        $logoPath1 = null;
        $logoPath2 = null;

        if ($request->hasFile('logo_1')) {
            $filename = Str::uuid() . '.' . $request->file('logo_1')->getClientOriginalExtension();
            $request->file('logo_1')->move(public_path('images/logo'), $filename);
            $logoPath1 = 'images/logo/' . $filename;
        }
        if ($request->hasFile('logo_2')) {
            $filename = Str::uuid() . '.' . $request->file('logo_2')->getClientOriginalExtension();
            $request->file('logo_2')->move(public_path('images/logo'), $filename);
            $logoPath2 = 'images/logo/' . $filename;
        }

        $tenant = Tenant::create([
            'id' => $validationData['domain_name'],
            'name' => $validationData['name'],
            'email' => $validationData['email'],
            'logo_path_1' => $logoPath1,
            'logo_path_2' => $logoPath2,
            'background_color_1' => $request->input('background_color_1'),
            'text_color_1' => $request->input('text_color_1'),
            'background_color_2' => $request->input('background_color_2'),
            'text_color_2' => $request->input('text_color_2'),
            'navbar_color_1' => $request->input('navbar_color_1'),
            'navbar_text_color_1' => $request->input('navbar_text_color_1'),
            'navbar_color_2' => $request->input('navbar_color_2'),
            'navbar_text_color_2' => $request->input('navbar_text_color_1'),
            'navbar_font' => $request->input('navbar_font'),
            'heading_font' => $request->input('heading_font'),
            'body_font' => $request->input('body_font'),
        ]);

        $tenant->domains()->create([
            'domain' => $validationData['domain_name'] . '.' . config('app.domain')
        ]);

        SeedTenantJob::dispatch($tenant, Hash::make($validationData['password']));

        return redirect()->route('tenants.index');
    }

    public function destroy(Tenant $tenant)
    {
        $tenant->domains()->delete();
        $tenant->delete();

        return redirect()->route('tenants.index')->with('success', 'Tenant eliminado con éxito');
    }

    public function edit(Tenant $tenant)
    {
        return view('tenants.edit', compact('tenant'));
    }

    public function update(Request $request, Tenant $tenant)
    {
        $tenants = Tenant::select('id', 'logo_path_1', 'logo_path_2')->get();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'domain_name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'logo_1' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
            'logo_2' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
            'background_color_1' => 'nullable|string|max:7',
            'text_color_1' => 'nullable|string|max:7',
            'background_color_2' => 'nullable|string|max:7',
            'text_color_2' => 'nullable|string|max:7',
            'navbar_color_1' => 'nullable|string|max:7',
            'navbar_text_color_1' => 'nullable|string|max:7',
            'navbar_color_2' => 'nullable|string|max:7',
            'navbar_text_color_2' => 'nullable|string|max:7',
            'navbar_font' => 'nullable|string|max:255',
            'heading_font' => 'nullable|string|max:255',
            'body_font' => 'nullable|string|max:255',
        ]);

        $logoPath1 = null;
        $logoPath2 = null;

        if ($request->hasFile('logo_1')) {
            if ($tenants->logo_path_1 && file_exists(public_path($tenants->logo_path_1))) {
                unlink(public_path($tenants->logo_path_1));
            }
            $filename = Str::uuid() . '.' . $request->file('logo_1')->getClientOriginalExtension();
            $request->file('logo_1')->move(public_path('images/logo'), $filename);
            $logoPath1 = 'images/logo/' . $filename;
        }
        if ($request->hasFile('logo_2')) {
            if ($tenants->logo_path_2 && file_exists(public_path($tenants->logo_path_2))) {
                unlink(public_path($tenants->logo_path_1));
            }
            $filename = Str::uuid() . '.' . $request->file('logo_2')->getClientOriginalExtension();
            $request->file('logo_2')->move(public_path('images/logo'), $filename);
            $logoPath2 = 'images/logo/' . $filename;
        }

        $tenant->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'logo_path_1' => $logoPath1,
            'logo_path_2' => $logoPath2,
            'background_color_1' => $request->input('background_color_1'),
            'text_color_1' => $request->input('text_color_1'),
            'background_color_2' => $request->input('background_color_2'),
            'text_color_2' => $request->input('text_color_2'),
            'navbar_color_1' => $request->input('navbar_color_1'),
            'navbar_text_color_1' => $request->input('navbar_text_color_1'),
            'navbar_color_2' => $request->input('navbar_color_2'),
            'navbar_text_color_2' => $request->input('navbar_text_color_1'),
            'navbar_font' => $request->input('navbar_font'),
            'heading_font' => $request->input('heading_font'),
            'body_font' => $request->input('body_font'),
        ]);

        $tenant->domains()->update([
            'domain' => $validated['domain_name'] . '.' . config('app.domain')
        ]);

        tenancy()->initialize($tenant);

        $user = User::first();

        if ($user) {
            $user->name = $validated['name'];
            $user->email = $validated['email'];

            if (!empty($validated['password'])) {
                $user->password = Hash::make($validated['password']);
            }

            $user->save();
        }

        tenancy()->end();

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

        return view('permissions.edit', [
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
