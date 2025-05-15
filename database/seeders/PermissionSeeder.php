<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::firstOrCreate(
            ['name' => 'Acceder al Panel de Control'],
            ['guard_name' => 'web']
        );

        Permission::firstOrCreate(
            ['name' => 'Ver Tenants'],
            ['guard_name' => 'web']
        );

        Permission::firstOrCreate(
            ['name' => 'Crear y Editar Tenants'],
            ['guard_name' => 'web']
        );

        Permission::firstOrCreate(
            ['name' => 'Editar Páginas de Tenants'],
            ['guard_name' => 'web']
        );

        Permission::firstOrCreate(
            ['name' => 'Eliminar Tenants'],
            ['guard_name' => 'web']
        );

        Permission::firstOrCreate(
            ['name' => 'Ver Dominios'],
            ['guard_name' => 'web']
        );

        Permission::firstOrCreate(
            ['name' => 'Crear y Editar Dominios'],
            ['guard_name' => 'web']
        );

        Permission::firstOrCreate(
            ['name' => 'Eliminar Dominios'],
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

        Permission::firstOrCreate(
            ['name' => 'Ver Token de Acceso'],
            ['guard_name' => 'web']
        );
    }
}
