<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tenant;

class TenantMigrateStatus extends Command
{
    protected $name = 'tenants:migrate:status';
    protected $description = 'Obtain the migrate status of all tenant databases.';

    public function handle()
    {
        $tenants = Tenant::all();

        foreach ($tenants as $tenant) {
            tenancy()->initialize($tenant);
            
            $this->info("Checking migrate status for: {$tenant->name}");

            try {
                $this->call('migrate:status', [
                    '--path' => 'database/migrations/tenant',
                ]);
            } catch (\Exception $e) {
                $this->error("Error in {$tenant->name}: " . $e->getMessage());
            }

            tenancy()->end();
        }
    }
}
