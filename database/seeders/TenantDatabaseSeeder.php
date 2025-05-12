<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\Tenant;
use Stancl\Tenancy\Facades\Tenancy;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Obtener todos los tenants
        $tenants = Tenant::all(); // Puedes modificar esto si es necesario obtener solo algunos tenants

        // Iterar sobre cada tenant y crear los roles en su base de datos
        foreach ($tenants as $tenant) {
            // Inicializa la conexión del tenant
            tenancy()->initialize($tenant);

            // Crear los roles dentro de la base de datos del tenant
            Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
            Role::firstOrCreate(['name' => 'User', 'guard_name' => 'web']);
        }
    }
}
