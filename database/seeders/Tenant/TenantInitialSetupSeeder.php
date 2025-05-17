<?php

namespace Database\Seeders\Tenant;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TenantInitialSetupSeeder extends Seeder
{
    protected $name;
    protected $email;
    protected $password;

    public function __construct(string $name = 'Admin', string $email = 'admin@example.com', string $password = 'secret')
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function run(): void
    {
        Permission::firstOrCreate(
            ['name' => 'Acceder al Panel de Control'],
            ['guard_name' => 'web']
        );

        Permission::firstOrCreate(
            ['name' => 'Ver Usuarios'],
            ['guard_name' => 'web']
        );

        Permission::firstOrCreate(
            ['name' => 'Crear y Editar Usuarios'],
            ['guard_name' => 'web']
        );

        Permission::firstOrCreate(
            ['name' => 'Eliminar Usuarios'],
            ['guard_name' => 'web']
        );

        Role::firstOrCreate(
            ['name' => 'Admin'],
            ['guard_name' => 'web']
        )->syncPermissions(
            [
                'Acceder al Panel de Control',
                'Ver Usuarios',
                'Crear y Editar Usuarios',
                'Eliminar Usuarios',
            ]
        );

        Role::firstOrCreate(
            ['name' => 'Usuario'],
            ['guard_name' => 'web']
        );

        $user = User::firstOrCreate(
            ['email' => $this->email],
            [
                'name' => $this->name,
                'password' => Hash::make($this->password),
                'email_verified_at' => now(),
            ]
        );

        $userCount = User::count();

        if ($userCount === 1) {
            $user->assignRole('Admin');
        } else {
            $user->assignRole('Usuario');
        }
    }
}
