<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tenant;

class TenantMigrateFresh extends Command
{
    protected $name = 'tenants:migrate:fresh';
    protected $description = 'Fresh migrates all tenant databases.';

    public function handle()
    {
        $tenants = Tenant::all();

        foreach ($tenants as $tenant) {
            tenancy()->initialize($tenant);
            
            $this->info("Freshing database for: {$tenant->name}");

            try {
                $this->call('migrate:fresh', [
                    '--path' => 'database/migrations/tenant',
                ]);
                $this->info('Migrated successfully!');
            } catch (\Exception $e) {
                $this->error("Error migrating {$tenant->name}: " . $e->getMessage());
            }

            tenancy()->end();
        }

        $this->info('All tenant databases freshed successfully.');
    }
}
