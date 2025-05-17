<?php

declare(strict_types=1);

use App\Http\Controllers\App\ProfileController;
use App\Http\Controllers\App\UserController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AppearanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

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
    // Sistema de Agendamiento
    Route::middleware(['auth'])->group(function () {
        Route::get('/agenda/cuestionario', [AgendaController::class, 'showQuestionnaire'])->name('tenant.agenda.questionnaire');
        Route::post('/agenda/cuestionario', [AgendaController::class, 'processQuestionnaire'])->name('tenant.agenda.questionnaire.process');

        Route::get('/agenda', [AgendaController::class, 'index'])->name('tenant.agenda.index');
        Route::post('/agenda', [AgendaController::class, 'store'])->name('tenant.agenda.store');
    });

    // Rutas para acciones de archivos
    Route::resource('files', FileController::class);
    Route::get('files/{file}/download', [FileController::class, 'download'])->name('files.download');
    Route::get('/files/{file}/preview', [FileController::class, 'preview'])->name('files.preview');
    Route::delete('/files/{file}', [FileController::class, 'destroy'])->name('files.destroy');

    // Rutas para compartir archivos
    Route::middleware(['role:Admin'])->group(function () {
        Route::post('files/{file}/share', [FileController::class, 'share'])->name('files.share');
    });

    // Rutas para archivos compartidos
    Route::get('/shared-folders', [FileController::class, 'sharedFolders'])->name('files.shared.folders');
    Route::get('/shared-folders/{user}', [FileController::class, 'sharedByUser'])->name('files.shared.byUser');

    Route::get('/appearance', [AppearanceController::class, 'index'])->name('appearance');
    Route::post('/appearance', [AppearanceController::class, 'update'])->name('appearance.update');

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

    require __DIR__ . '/tenant-auth.php';
});
