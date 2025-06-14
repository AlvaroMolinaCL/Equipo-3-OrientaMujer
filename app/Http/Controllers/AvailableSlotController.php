<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AvailableSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\ScheduleBatch;

class AvailableSlotController extends Controller
{
    public function index()
    {
        $slots = AvailableSlot::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->get();

        $scheduleBatches = ScheduleBatch::withCount('slots')
            ->where('user_id', Auth::id())
            ->latest()
            ->take(10)
            ->get();

        return view('tenants.default.available-slots.index', compact('slots', 'scheduleBatches'));
    }


    public function apiIndex(Request $request)
    {
        $query = AvailableSlot::with('appointments');

        $today = now()->format('Y-m-d');
        $currentTime = now()->format('H:i:s');

        if ($request->has('date')) {
            $date = $request->query('date');
            $query->where('date', $date);

            if ($date === $today) {
                $query->where('end_time', '>', $currentTime);
            }
        } else {
            $query->where(function ($q) use ($today, $currentTime) {
                $q->where('date', '>', $today)
                    ->orWhere(function ($subq) use ($today, $currentTime) {
                        $subq->where('date', $today)
                            ->where('end_time', '>', $currentTime);
                    });
            });
        }

        $query->whereDoesntHave('appointments')->orderBy('date')->orderBy('start_time');

        return response()->json(
            $query->get()->map(function ($slot) {
                $now = now();
                $slotStart = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $slot->date . ' ' . $slot->start_time);
                $slotEnd = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $slot->date . ' ' . $slot->end_time);
                $inProgress = $now->between($slotStart, $slotEnd);

                return [
                    'id' => $slot->id,
                    'title' => substr($slot->start_time, 0, 5) . ' - ' . substr($slot->end_time, 0, 5),
                    'start' => $slot->date,
                    'start_time' => $slot->start_time,
                    'end_time' => $slot->end_time,
                    'available' => true,
                    'in_progress' => $inProgress,
                ];
            })
        );
    }


    public function clientSlots(Request $request)
    {
        $query = AvailableSlot::with('appointments');

        $today = now()->format('Y-m-d');
        $currentTime = now()->format('H:i:s');

        if ($request->has('date')) {
            $date = $request->query('date');
            $query->where('date', $date);

            // Si es hoy, aplicar filtro por hora actual
            if ($date === $today) {
                $query->where('start_time', '>=', $currentTime);
            }
        } else {
            // Cuando no se filtra por día: excluir slots de hoy con hora expirada
            $query->where(function ($q) use ($today, $currentTime) {
                $q->where('date', '>', $today)
                ->orWhere(function ($subq) use ($today, $currentTime) {
                    $subq->where('date', $today)
                        ->where('start_time', '>=', $currentTime);
                });
            });
        }

        $usedSlotIds = Appointment::pluck('available_slot_id')->toArray();
        $query->whereNotIn('id', $usedSlotIds)->orderBy('start_time');

        return response()->json(
            $query->get()->map(function ($slot) {
                return [
                    'id' => $slot->id,
                    'title' => $slot->start_time . ' - ' . $slot->end_time,
                    'start' => $slot->date,
                    'start_time' => $slot->start_time,
                    'end_time' => $slot->end_time,
                    'available' => true,
                ];
            })
        );
    }

    public function create()
    {
        return view('tenants.default.available-slots.create');
    }

    public function store(Request $request)
    {
        if ($request->mode === 'puntual') {
            $request->validate([
                'date' => 'required|date',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
            ]);

            $today = now()->format('Y-m-d');
            if ($request->date === $today) {
                $nowTime = now()->format('H:i');
                if ($request->start_time < $nowTime) {
                    return back()->with('error', 'La hora de inicio debe ser igual o posterior a la hora actual.');
                }
            }

            AvailableSlot::create([
                'user_id' => Auth::id(),
                'date' => $request->date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);

            return redirect()->route('available-slots.index')->with('success', 'Horario puntual agregado.');
        }

        if ($request->mode === 'recurrente') {
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'duration' => 'required|numeric|min:5',
                'weekdays' => 'required|array|min:1',
            ]);

            $startDate = \Carbon\Carbon::parse($request->start_date);
            $endDate = \Carbon\Carbon::parse($request->end_date);
            $weekdays = array_map('intval', $request->weekdays);
            $duration = intval($request->duration);

            $period = \Carbon\CarbonPeriod::create($startDate, $endDate);

            foreach ($period as $date) {
                if (!in_array($date->dayOfWeek, $weekdays)) {
                    continue;
                }

                $start = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $date->format('Y-m-d') . ' ' . $request->start_time);
                $end = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $date->format('Y-m-d') . ' ' . $request->end_time);

                while ($start->lt($end)) {
                    $next = $start->copy()->addMinutes($duration);

                    AvailableSlot::create([
                        'user_id' => Auth::id(),
                        'date' => $date->format('Y-m-d'),
                        'start_time' => $start->format('H:i'),
                        'end_time' => $next->format('H:i'),
                    ]);

                    $start = $next;
                }
            }

            return redirect()->route('available-slots.index')->with('success', 'Disponibilidad recurrente agregada.');
        }

        return back()->with('error', 'Modo de disponibilidad no válido.');
    }


    public function edit(AvailableSlot $slot)
    {
        return view('tenants.default.available-slots.edit', compact('slot'));
    }

    public function update(Request $request, AvailableSlot $slot)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        // Protección: no permitir editar si ya hay una cita
        if ($slot->appointments()->exists()) {
            return back()->with('error', 'No se puede modificar este horario, ya ha sido reservado.');
        }

        $slot->update([
            'user_id' => Auth::id(),
            'date' => $validated['date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
        ]);

        return redirect()->route('available-slots.index')->with('success', 'Bloque actualizado correctamente.');
    }


    public function destroy(AvailableSlot $availableSlot)
    {
        $availableSlot->delete();

        return redirect()->route('available-slots.index')->with('success', 'Disponibilidad eliminada correctamente.');
    }

    public function getAvailableHours(Request $request)
    {
        $date = $request->query('date');

        $slots = AvailableSlot::with(['appointments', 'user'])
            ->where('date', $date)
            ->get()
            ->map(function ($slot) {
                return [
                    'slot_id' => $slot->id,
                    'start_time' => $slot->start_time,
                    'end_time' => $slot->end_time,
                    'available' => $slot->appointments->isEmpty(),
                    'lawyer_name' => $slot->user->name ?? 'Abogado',
                ];
            });

        return response()->json($slots);
    }

    public function reservations($slotId)
    {
        $slot = AvailableSlot::with(['appointments.user'])->findOrFail($slotId);

        $reservations = $slot->appointments->map(function ($appointment) {
            return [
                'id' => $appointment->id,
                'user_name' => $appointment->user->name,
                'created_at' => $appointment->created_at->format('d/m/Y H:i'),
                'email' => $appointment->user->email,
                'phone' => $appointment->user->phone_number,
            ];
        });

        return response()->json($reservations);
    }
}