<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AvailableSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvailableSlotController extends Controller
{
    public function index()
    {
        $slots = AvailableSlot::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->get();

        return view('tenants.default.available-slots.index', compact('slots'));
    }

    public function create()
    {
        return view('tenants.default.available-slots.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'slots.*.start-time' => 'required|date_format:H:i',
            'slots.*.end-time' => 'required|date_format:H:i',
            'slots.*.max-bookings' => 'required|integer|min:1',
        ]);

        foreach ($validated['slots'] as $index => $slot) {
            if (strtotime($slot['end-time']) <= strtotime($slot['start-time'])) {
                return back()->withErrors(["slots.$index.end-time" => 'La hora de fin debe ser posterior a la de inicio.'])->withInput();
            }

            AvailableSlot::create([
                'user_id' => Auth::id(),
                'date' => $validated['date'],
                'start_time' => $slot['start-time'],
                'end_time' => $slot['end-time'],
                'max_bookings' => $slot['max-bookings'],
            ]);
        }

        return redirect()->route('available-slots.index')->with('success', 'Disponibilidad agregada correctamente.');
    }

    public function edit(AvailableSlot $slot)
    {
        return view('tenants.default.available-slots.edit', compact('slot'));
    }

    public function update(Request $request, AvailableSlot $slot)
    {
        $request->merge([
            'slots' => [
                [
                    'start-time' => date('H:i', strtotime($request->input('slots.0.start-time'))),
                    'end-time' => date('H:i', strtotime($request->input('slots.0.end-time'))),
                    'max-bookings' => $request->input('slots.0.max-bookings')
                ]
            ]
        ]);

        $validated = $request->validate([
            'date' => 'required|date',
            'slots.0.start-time' => 'required|date_format:H:i',
            'slots.0.end-time' => 'required|date_format:H:i',
            'slots.0.max-bookings' => 'required|integer|min:1',
        ]);

        $slotData = $validated['slots'][0];

        if (strtotime($slotData['end-time']) <= strtotime($slotData['start-time'])) {
            return back()->withErrors([
                'slots.0.end-time' => 'La hora de fin debe ser posterior a la de inicio.'
            ])->withInput();
        }

        $slot->update([
            'user_id' => Auth::id(),
            'date' => $validated['date'],
            'start_time' => $slotData['start-time'],
            'end_time' => $slotData['end-time'],
            'max_bookings' => $slotData['max-bookings'],
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
        $date = $request->input('date');

        $slots = AvailableSlot::where('date', $date)->get()->map(function ($slot) {
            $used = $slot->appointments()->count();

            return [
                'slot_id' => $slot->id,
                'start_time' => $slot->start_time,
                'end_time' => $slot->end_time,
                'available' => $used < $slot->max_bookings,
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
