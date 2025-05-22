<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AvailableSlotController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant API Routes
|--------------------------------------------------------------------------
|
| Estas rutas API son exclusivas para los tenants.
| Se aplican automáticamente en dominios como gestiondecitas.localhost.
|
*/

Route::middleware([
    'api',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    // ✅ Ruta para obtener horarios disponibles para agendamiento (usada por FullCalendar)
    Route::get('/slots', [AvailableSlotController::class, 'apiIndex']);

    // 🧭 Ruta que ya tenías (para obtener horarios válidos para clientes)
    Route::get('/available-hours', [AvailableSlotController::class, 'getAvailableHours']);
});
