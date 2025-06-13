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
        $validated = $request->validate([
            'days' => 'required|integer|min:1|max:14',
            'slots' => 'required|array',
            'name'  => 'nullable|string|max:255',
        ]);

        // Crear la carga
        $batch = ScheduleBatch::create([
            'user_id' => Auth::id(),
            'name'    => $validated['name'] ?? null,
            'days'    => $validated['days'],
        ]);

        // Guardar horarios día por día
        foreach ($validated['slots'] as $dayIndex => $slots) {
            foreach ($slots as $slot) {
                if (!empty($slot['start']) && !empty($slot['end'])) {
                    ScheduleBatchSlot::create([
                        'batch_id'   => $batch->id,
                        'day_index'  => $dayIndex,
                        'start_time' => $slot['start'],
                        'end_time'   => $slot['end'],
                    ]);
                }
            }
        }

        return redirect()->route('available-slots.index')
            ->with('success', 'Carga de horarios guardada correctamente.');
    }

    public function applyBatch(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:schedule_batches,id',
            'start_date' => 'required|date',
        ]);

        $batch = ScheduleBatch::with('slots')->findOrFail($request->batch_id);
        $startDate = \Carbon\Carbon::parse($request->start_date);
        $originalStart = \Carbon\Carbon::parse($batch->start_date);
        $daysOffset = $startDate->diffInDays($originalStart, false);

        foreach ($batch->slots as $slot) {
            $newDate = \Carbon\Carbon::parse($batch->start_date)
                ->addDays($slot->day_index + $daysOffset);

            \App\Models\AvailableSlot::create([
                'user_id' => Auth::id(),
                'date' => $newDate->format('Y-m-d'),
                'start_time' => $slot->start_time,
                'end_time' => $slot->end_time,
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function previewBatch(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:schedule_batches,id',
        ]);

        $batch = ScheduleBatch::with('slots')->findOrFail($request->id);

        return response()->json(
            $batch->slots->map(function ($slot) {
                return [
                    'day_index' => $slot->day_index,
                    'start_time' => $slot->start_time,
                    'end_time' => $slot->end_time,
                ];
            })
        );
    }

    public function create()
    {
        $scheduleBatches = ScheduleBatch::withCount('slots')
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('tenants.default.available-slots.create', compact('scheduleBatches'));
    }
}