<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Database\Seeders\Tenant\TenantInitialSetupSeeder;
use Illuminate\Database\Seeder;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $tenants = Tenant::all();

        foreach ($tenants as $tenant) {
            tenancy()->initialize($tenant);

            (new TenantInitialSetupSeeder(
                name: $tenant->name,
                email: $tenant->email,
                password: 'asdf1234'
            ))->run();

            tenancy()->end();
        }
    }
}
