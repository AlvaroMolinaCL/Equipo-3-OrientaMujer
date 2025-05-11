<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\App\UserController;
use App\Http\Controllers\App\ProfileController;
use App\Http\Controllers\DashboardController;


/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    // Gestión de usuarios
    Route::resource('users', UserController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['auth'])
        ->name('dashboard');

    // Página "Inicio"
    Route::get('/', function () {
        return view(tenantView('index'));
    });

    // Página "Servicios"
    Route::get('/services', function () {
        return view(tenantView('services'));
    })->middleware('check.tenant.page.enabled:services');

    // Página "Contacto"
    Route::get('/contact', function () {
        return view(tenantView('contact'));
    })->middleware('check.tenant.page.enabled:contact');

    // Página "Tips"
    Route::get('/tips', function () {
        return view(tenantView('tips'));
    })->middleware('check.tenant.page.enabled:tips');

    // Página "Sobre Orienta Mujer"
    Route::get('/about', function () {
        return view(tenantView('about'));
    })->middleware('check.tenant.page.enabled:about');

    // Página para Agendar Asesorías
    Route::get('/agenda', function () {
        return view(tenantView('agenda.index'));
    })->middleware('check.tenant.page.enabled:agenda');

    require __DIR__ . '/tenant-auth.php';
});
