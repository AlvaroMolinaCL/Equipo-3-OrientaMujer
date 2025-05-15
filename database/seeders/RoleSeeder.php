<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(
            ['name' => 'Super Admin'],
            ['guard_name' => 'web'],
        )->syncPermissions(
            [
                'Acceder al Panel de Control',
                'Ver Tenants',
                'Crear y Editar Tenants',
                'Editar Páginas de Tenants',
                'Eliminar Tenants',
                'Ver Dominios',
                'Crear y Editar Dominios',
                'Eliminar Dominios',
                'Ver Usuarios',
                'Crear y Editar Usuarios',
                'Eliminar Usuarios',
                'Ver Token de Acceso',
            ]
        );
    }
}
