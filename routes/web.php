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
use App\Http\Controllers\AvailableSlotController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí se registran las rutas web de la aplicación.
| Estas rutas están agrupadas por middleware y permisos según el rol.
|
*/

// Solicitud de Super Admin (público)
Route::get('/solicitar-superadmin', [PublicSuperAdminRequestController::class, 'form']);
Route::post('/solicitar-superadmin', [PublicSuperAdminRequestController::class, 'submit']);

// Registro desde invitación
Route::get('/registro-superadmin/{token}', [SuperAdminInvitationController::class, 'form']);
Route::post('/registro-superadmin/{token}', [SuperAdminInvitationController::class, 'register']);

// Página de inicio
Route::get('/', function () {
    return view('index');
})->name('index');

// Rutas para cualquier usuario autenticado
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard y perfil
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Calendario del abogado
    Route::get('/admin/disponibilidad/calendario', function () {
        return view('tenants.default.available-slots.calendar');
    })->middleware('role:Admin')->name('admin.disponibilidad.calendario');

    // Ruta necesaria para FullCalendar en contexto tenant
    Route::get('/available-slots', [AvailableSlotController::class, 'apiIndex']);
});

// Rutas exclusivas para Super Administrador
Route::middleware(['auth', 'verified', 'role:Super Admin'])->group(function () {

    Route::get('solicitudes-superadmin', [AdminSuperAdminRequestController::class, 'index']);
    Route::post('solicitudes-superadmin/{id}/aprobar', [AdminSuperAdminRequestController::class, 'approve']);

    // Gestión de Tenants
    Route::resource('tenants', TenantController::class);
    Route::delete('tenants/{tenant}', [TenantController::class, 'destroy'])->name('tenants.destroy');
    Route::get('tenants/{tenant}/edit', [TenantController::class, 'edit'])->name('tenants.edit');
    Route::put('tenants/{tenant}', [TenantController::class, 'update'])->name('tenants.update');

    // Páginas de tenant
    Route::get('tenants/{tenant}/pages/edit', [TenantPageController::class, 'edit'])->name('tenants.pages.edit');
    Route::put('tenants/{tenant}/pages/update', [TenantPageController::class, 'update'])->name('tenants.pages.update');

    // Gestión de Dominios
    Route::resource('domains', DomainController::class);
    Route::delete('domains/{domain}', [DomainController::class, 'destroy'])->name('domains.destroy');
    Route::get('domains/{domain}/edit', [DomainController::class, 'edit'])->name('domains.edit');
    Route::put('domains/{domain}', [DomainController::class, 'update'])->name('domains.update');

    // Gestión de Usuarios
    Route::resource('users', UserController::class);

    // Visualización de token
    Route::get('/admin/token', [TokenController::class, 'show'])->name('admin.token');
});

require __DIR__ . '/auth.php';
