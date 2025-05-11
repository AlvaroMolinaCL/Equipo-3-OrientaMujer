<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\TenantPageController;
use App\Http\Controllers\App\UserController;
use App\Http\Controllers\Admin\TokenController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Página principal
Route::get('/', function () {
    return view('index');
})->name('index');

// Rutas solo para usuarios que han iniciado sesión
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Perfil de Usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas exclusivas para Super Administrador
Route::middleware(['auth', 'verified', 'role:Super Admin'])->group(function () {
    // Gestión de Tenants
    Route::resource('tenants', TenantController::class);
    Route::delete('tenants/{tenant}', [TenantController::class, 'destroy'])->name('tenants.destroy');
    Route::get('tenants/{tenant}/edit', [TenantController::class, 'edit'])->name('tenants.edit');
    Route::put('tenants/{tenant}', [TenantController::class, 'update'])->name('tenants.update');
    Route::get('/admin/token', [TokenController::class, 'show'])->name('admin.token');

    // Gestión de Dominios
    Route::resource('domains', DomainController::class);
    Route::delete('domains/{domain}', [DomainController::class, 'destroy'])->name('domains.destroy');
    Route::get('domains/{domain}/edit', [DomainController::class, 'edit'])->name('domains.edit');
    Route::put('domains/{domain}', [DomainController::class, 'update'])->name('domains.update');

    // Gestión de Usuarios
    Route::resource('users', UserController::class);

    // Gestión de Páginas por Tenant
    Route::get('tenants/{tenant}/pages/edit', [TenantPageController::class, 'edit'])->name('tenants.pages.edit');
    Route::put('tenants/{tenant}/pages/update', [TenantPageController::class, 'update'])->name('tenants.pages.update');

    // Permisos por Tenant
    // Route::get('/tenants/{tenant}/seed-permissions', [TenantController::class, 'seedPermissions'])->name('tenants.seedPermissions');
    // Route::get('/tenants/{tenant}/permissions/edit', [TenantController::class, 'editPermissions'])->name('tenants.permissions.edit');
    // Route::post('/tenants/{tenant}/permissions/update', [TenantController::class, 'updatePermissions'])->name('tenants.permissions.update');
});

// Autenticación (login, register, etc.)
require __DIR__ . '/auth.php';
