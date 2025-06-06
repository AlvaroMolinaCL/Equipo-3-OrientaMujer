<?php

namespace App\Jobs;

use App\Models\Tenant;
use Database\Seeders\Tenant\TenantInitialSetupSeeder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SeedTenantJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $tenant;
    protected $password;

    public function __construct(Tenant $tenant, string $password)
    {
        $this->tenant = $tenant;
        $this->password = $password;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->tenant->run(function () {
            (new TenantInitialSetupSeeder(
                $this->tenant->name,
                $this->tenant->email,
                $this->password
            ))->run();
        });
    }
}
