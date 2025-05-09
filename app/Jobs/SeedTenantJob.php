<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\{Tenant, User};
use Spatie\Permission\Models\Role;


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
            $user = User::create([
                'name' => $this->tenant->name,
                'email' => $this->tenant->email,
                'password' => $this->password,
            ]);

            $adminRole = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
            $user->assignRole($adminRole);
        });
    }
}