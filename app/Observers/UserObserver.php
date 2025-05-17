<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function created(User $user)
    {
        // if (tenant()) {
        //     $role = Role::firstOrCreate(['name' => 'Usuario', 'guard_name' => 'web']);
        //     $user->assignRole($role);
        // }
    }
}
