<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AvailableSlot;
use Carbon\Carbon;
use App\Models\Tenant;

class DeleteExpiredSlots extends Command
{
    protected $signature = 'slots:purge-expired';
    protected $description = 'Elimina horarios disponibles expirados en todos los tenants.';

    public function handle()
    {
        $now = Carbon::now();
        $total = 0;

        Tenant::all()->each(function ($tenant) use ($now, &$total) {
            // Inicializa el tenant (conexión, configuración, etc.)
            tenancy()->initialize($tenant);

            // Ejecuta la eliminación en la base de datos del tenant
            $deleted = AvailableSlot::whereRaw(
                "STR_TO_DATE(CONCAT(date, ' ', end_time), '%Y-%m-%d %H:%i:%s') < ?", [$now]
            )->delete();

            $this->info("🧹 [$tenant->id] Horarios eliminados: $deleted");
            $total += $deleted;

            tenancy()->end(); // Limpia el contexto
        });

        $this->info("✅ Total de horarios eliminados: $total");
    }
}