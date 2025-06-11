<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScheduleBatch;
use App\Models\ScheduleBatchSlot;
use Illuminate\Support\Facades\Auth;

class ScheduleBatchController extends Controller
{
    public function store(Request $request)
    {
        // Validación básica
        $validated = $request->validate([
            'days' => 'required|integer|min:1|max:14',
            'slots' => 'required|array',
        ]);

        // Crear el batch
        $batch = ScheduleBatch::create([
            'user_id' => Auth::id(),
            'start_date' => now()->toDateString(),
            'end_date' => now()->addDays($validated['days'] - 1)->toDateString(),
        ]);

        // Recorrer los días y guardar cada horario
        foreach ($request->input('slots') as $dayIndex => $slots) {
            foreach ($slots as $slot) {
                if (!empty($slot['start']) && !empty($slot['end'])) {
                    ScheduleBatchSlot::create([
                        'batch_id' => $batch->id,
                        'day_index' => $dayIndex,
                        'start_time' => $slot['start'],
                        'end_time' => $slot['end'],
                        'max_bookings' => 1, // valor fijo por diseño actual
                    ]);
                }
            }
        }

        return redirect()->route('available-slots.index')
                         ->with('success', 'Carga de horarios guardada correctamente.');
    }
}