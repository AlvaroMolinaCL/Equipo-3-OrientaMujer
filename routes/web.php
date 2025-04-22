<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Tenant;
use Illuminate\Http\Request;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', function () {
            return view('welcome');
        });

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard');

        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });

        // Agregar rutas para crear tenants
        Route::get('/create-tenant', function () {
            return view('create-tenant');
        })->middleware('auth'); // Opcional: solo usuarios logueados pueden crear tenants

        Route::post('/create-tenant', function (Request $request) {
            $request->validate([
                'nombre' => 'required|alpha_dash|unique:domains,domain',
            ]);

            $tenant = Tenant::create([
                'id' => $request->nombre,
            ]);

            $tenant->domains()->create([
                'domain' => $request->nombre . '.localhost',
            ]);

            return redirect()->back()->with('success', 'Tenant creado exitosamente.');
        })->middleware('auth');

        require __DIR__.'/auth.php';
    });
}
