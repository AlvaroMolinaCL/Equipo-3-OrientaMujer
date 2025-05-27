<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\DeleteExpiredSlots;

class Kernel extends ConsoleKernel
{
    /**
     * Registro del comando personalizado
     */
    protected $commands = [
        DeleteExpiredSlots::class,
    ];

    /**
     * Programar tareas automáticas
     */
    protected function schedule(Schedule $schedule): void
    {
        // Ejecutar todos los días a la medianoche
        $schedule->command('slots:purge-expired')->dailyAt('00:00');
    }

    /**
     * Cargar comandos adicionales
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}