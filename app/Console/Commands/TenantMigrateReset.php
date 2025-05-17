<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tenant;

class TenantMigrateReset extends Command
{
    protected $name = 'tenants:migrate:reset';
    protected $description = 'Reset migrates all tenant databases.';

    public function handle()
    {
        $tenants = Tenant::all();

        foreach ($tenants as $tenant) {
            tenancy()->initialize($tenant);
            
            $this->info("Resetting database for: {$tenant->name}");

            try {
                $this->call('migrate:reset', [
                    '--path' => 'database/migrations/tenant',
                ]);
                $this->info('Migrated successfully!');
            } catch (\Exception $e) {
                $this->error("Error migrating {$tenant->name}: " . $e->getMessage());
            }

            tenancy()->end();
        }

        $this->info('All tenant databases reset successfully.');
    }
}
