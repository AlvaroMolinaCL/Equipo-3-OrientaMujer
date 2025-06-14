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
        $userId = Auth::id();

        foreach ($batch->slots as $slot) {
            $targetDate = $startDate->copy()->addDays($slot->day_index)->toDateString();

            $startTime = $slot->start_time;
            $endTime = $slot->end_time;

            // Validar solapamiento con horarios existentes del mismo usuario y misma fecha
            $hasConflict = \App\Models\AvailableSlot::where('user_id', $userId)
                ->where('date', $targetDate)
                ->where(function ($query) use ($startTime, $endTime) {
                    $query->where(function ($q) use ($startTime, $endTime) {
                        $q->where('start_time', '<', $endTime)
                        ->where('end_time', '>', $startTime);
                    });
                })
                ->exists();

            if ($hasConflict) {
                return response()->json([
                    'success' => false,
                    'error' => 'overlap'
                ]);
            }
        }

        // Si no hay conflictos, proceder con la inserción
        foreach ($batch->slots as $slot) {
            $targetDate = $startDate->copy()->addDays($slot->day_index)->toDateString();

            \App\Models\AvailableSlot::create([
                'user_id' => $userId,
                'date' => $targetDate,
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

    public function edit($id)
    {
        $batch = ScheduleBatch::with('slots')->where('user_id', Auth::id())->findOrFail($id);

        // Organiza los slots por día
        $organizedSlots = [];
        foreach ($batch->slots as $slot) {
            $organizedSlots[$slot->day_index][] = [
                'start_time' => $slot->start_time,
                'end_time' => $slot->end_time
            ];
        }

        ksort($organizedSlots); // Asegura el orden de los días

        return view('tenants.default.available-slots.edit-batch', compact('batch', 'organizedSlots'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'days' => 'required|integer|min:1|max:14',
            'slots' => 'required|array',
            'name'  => 'nullable|string|max:255',
        ]);

        $batch = ScheduleBatch::with('slots')->where('user_id', Auth::id())->findOrFail($id);

        // Actualizar datos generales
        $batch->update([
            'name' => $validated['name'] ?? null,
            'days' => $validated['days'],
        ]);

        // Crear arreglo de slots existentes indexados por día, hora inicio y fin
        $existingSlots = $batch->slots->keyBy(function ($slot) {
            return $slot->day_index . '-' . $slot->start_time . '-' . $slot->end_time;
        });

        $newSlotKeys = [];

        // Recorrer nuevos horarios y registrar los que no existen aún
        foreach ($validated['slots'] as $dayIndex => $slots) {
            foreach ($slots as $slot) {
                if (!empty($slot['start']) && !empty($slot['end'])) {
                    $key = $dayIndex . '-' . $slot['start'] . '-' . $slot['end'];
                    $newSlotKeys[] = $key;

                    if (!$existingSlots->has($key)) {
                        ScheduleBatchSlot::create([
                            'batch_id'   => $batch->id,
                            'day_index'  => $dayIndex,
                            'start_time' => $slot['start'],
                            'end_time'   => $slot['end'],
                        ]);
                    }
                }
            }
        }

        // Eliminar los que ya no están en la nueva carga
        foreach ($existingSlots as $key => $slot) {
            if (!in_array($key, $newSlotKeys)) {
                $slot->delete();
            }
        }

        return redirect()->route('available-slots.index')
            ->with('success', 'Carga de horarios actualizada correctamente.');
    }

    public function destroy($id)
    {
        $batch = ScheduleBatch::where('user_id', Auth::id())->findOrFail($id);
        $batch->slots()->delete(); // elimina los horarios relacionados
        $batch->delete();

        return redirect()->route('available-slots.index')
            ->with('success', 'Carga de horarios eliminada correctamente.');
    }
}