<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;
use App\Models\Tenant;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {

        // Página de inicio
        Route::get('/', function () {
            return view('welcome');
        });

        // Dashboard solo para usuarios autenticados
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard');

        // Perfil de usuario
        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });

        // Formulario para crear un nuevo tenant
        Route::get('/create-tenant', function () {
            return view('create-tenant');
        })->middleware('auth');

        // Procesar creación del tenant
        Route::post('/create-tenant', [TenantController::class, 'store'])->middleware('auth');

        // Rutas de autenticación de Breeze
        require __DIR__.'/auth.php';
    });
}
