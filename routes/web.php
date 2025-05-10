<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\App\UserController;
use App\Http\Controllers\Admin\TokenController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Ruta al dashboard accesible por cualquier usuario autenticado y verificado
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas exclusivas para SUPER ADMINISTRADOR
Route::middleware(['auth', 'verified', 'role:Super Admin'])->group(function () {
    // Gestión de tenants
    Route::resource('tenants', TenantController::class);
    Route::delete('tenants/{tenant}', [TenantController::class, 'destroy'])->name('tenants.destroy');
    Route::get('tenants/{tenant}/edit', [TenantController::class, 'edit'])->name('tenants.edit');
    Route::put('tenants/{tenant}', [TenantController::class, 'update'])->name('tenants.update');

    Route::get('/admin/token', [TokenController::class, 'show'])->name('admin.token');


    // Gestión de usuarios
    Route::resource('users', UserController::class);

    // Permisos por tenant
    Route::get('/tenants/{tenant}/seed-permissions', [TenantController::class, 'seedPermissions'])->name('tenants.seedPermissions');
    Route::get('/tenants/{tenant}/permissions/edit', [TenantController::class, 'editPermissions'])->name('tenants.permissions.edit');
    Route::post('/tenants/{tenant}/permissions/update', [TenantController::class, 'updatePermissions'])->name('tenants.permissions.update');
});

// Autenticación (login, register, etc.)
require __DIR__ . '/auth.php';