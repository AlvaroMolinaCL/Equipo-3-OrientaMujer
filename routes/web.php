<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\TenantPageController;
use App\Http\Controllers\Admin\TokenController;
use App\Http\Controllers\App\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminSuperAdminRequestController;
use App\Http\Controllers\PublicSuperAdminRequestController;
use App\Http\Controllers\SuperAdminInvitationController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/solicitar-superadmin', [PublicSuperAdminRequestController::class, 'form']);
Route::post('/solicitar-superadmin', [PublicSuperAdminRequestController::class, 'submit']);

Route::get('/registro-superadmin/{token}', [SuperAdminInvitationController::class, 'form']);
Route::post('/registro-superadmin/{token}', [SuperAdminInvitationController::class, 'register']);

// Página Principal
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


    Route::get('solicitudes-superadmin', [AdminSuperAdminRequestController::class, 'index']);
    Route::post('solicitudes-superadmin/{id}/aprobar', [AdminSuperAdminRequestController::class, 'approve'])->name('admin.solicitudes.aprobar');


    // Gestión de Tenants
    Route::resource('tenants', TenantController::class);
    Route::delete('tenants/{tenant}', [TenantController::class, 'destroy'])->name('tenants.destroy');
    Route::get('tenants/{tenant}/edit', [TenantController::class, 'edit'])->name('tenants.edit');
    Route::put('tenants/{tenant}', [TenantController::class, 'update'])->name('tenants.update');

    // Gestión de Páginas por Tenant
    Route::get('tenants/{tenant}/pages/edit', [TenantPageController::class, 'edit'])->name('tenants.pages.edit');
    Route::put('tenants/{tenant}/pages/update', [TenantPageController::class, 'update'])->name('tenants.pages.update');

    // Gestión de Dominios
    Route::resource('domains', DomainController::class);
    Route::delete('domains/{domain}', [DomainController::class, 'destroy'])->name('domains.destroy');
    Route::get('domains/{domain}/edit', [DomainController::class, 'edit'])->name('domains.edit');
    Route::put('domains/{domain}', [DomainController::class, 'update'])->name('domains.update');

    // Gestión de Usuarios
    Route::resource('users', UserController::class);

    // Token de Acceso
    Route::get('/admin/token', [TokenController::class, 'show'])->name('admin.token');
});

require __DIR__ . '/auth.php';
