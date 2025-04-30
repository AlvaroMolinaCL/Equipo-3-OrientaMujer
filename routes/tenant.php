<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

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

Route::middleware(['web'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');

    // Página "Inicio"
    Route::get('/', function () {
        return view('index');
    });

    // Página "Servicios"
    Route::get('/servicios', function () {
        return view('services');
    });

    // Página "Contacto"
    Route::get('/contacto', function () {
        return view('contact');
    });

    // Página "Tips"
    Route::get('/tips', function () {
        return view('tips');
    });

    // Página "Sobre Orienta Mujer"
    Route::get('/acerca-de', function () {
        return view('about');
    });

    // Página para Agendar Asesorías
    Route::get('/agenda', function () {
        return view('agenda.index');
    }); // Se debe agregar al middleware una vez se implemente el inicio de sesión

    require __DIR__ . '/tenant-auth.php';
});
