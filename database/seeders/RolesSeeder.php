<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        // Crear solo si no existe
        Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
    }
}
