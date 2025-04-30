<?php

namespace App\Tenants;

use Stancl\Tenancy\Events\TenantCreated;

class TenantCreatedListener
{
    public function handle(TenantCreated $event)
    {
        $tenant = $event->tenant;

        // $tenant->run(function () {
        //     \Spatie\Permission\Models\Role::create(['name' => 'Rol 1']);
        //     \Spatie\Permission\Models\Role::create(['name' => 'Rol 2']);
        // });
    }
}
