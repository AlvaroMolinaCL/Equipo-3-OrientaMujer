<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Tenant;
use App\Models\User;

class DashboardController extends Controller
{
public function index()
{
    $user_count = User::count();
    $user_today = User::whereDate('created_at', '=', now()->format('Y-m-d'))->count();
    $last_users = User::whereRaw('DATE(created_at) >= ?', now()->subDays(5)->format('Y-m-d'))->get();

    if (tenant()) {
        return view(tenantView('dashboard'), [
            'user_count' => $user_count,
            'user_today' => $user_today,
            'last_users' => $last_users,
        ]);
    } else {
        $tenant_count = Tenant::count();
        $tenant_today = Tenant::whereDate('created_at', '=', now()->format('Y-m-d'))->count();
        $last_tenants = Tenant::whereRaw('DATE(created_at) >= ?', now()->subDays(5)->format('Y-m-d'))->get();

        return view('dashboard', [
            'user_count' => $user_count,
            'user_today' => $user_today,
            'last_users' => $last_users,
            'tenant_count' => $tenant_count,
            'tenant_today' => $tenant_today,
            'last_tenants' => $last_tenants,
        ]);
    }
}

}
