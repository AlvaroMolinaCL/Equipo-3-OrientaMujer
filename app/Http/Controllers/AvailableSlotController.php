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
}
