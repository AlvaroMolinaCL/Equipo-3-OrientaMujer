<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AvailableSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
{
    public function showQuestionnaire()
    {
        return view('tenants.default.agenda.questionnaire');
    }

    public function processQuestionnaire(Request $request)
    {
        $validated = $request->validate([
            'q1' => 'required|in:yes,no',
            'q2' => 'required|in:yes,no',
            'q3' => 'required|in:yes,no',
        ]);

        if ($validated['q1'] === 'yes' && $validated['q2'] === 'yes' && $validated['q3'] === 'no') {
            session(['cuestionario_aprobado' => true]);
            return redirect()->route('tenant.agenda.index');
        }

        return back()->with('error', 'No cumples con los requisitos para agendar una cita en este momento.');
    }

    public function index()
    {
        if (!session('cuestionario_aprobado')) {
            return redirect()->route('tenant.agenda.questionnaire');
        }

        return view('tenants.default.agenda.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'available_slot_id' => 'required|exists:available_slots,id',
        ]);

        $slot = AvailableSlot::findOrFail($validated['available_slot_id']);

        if ($slot->date < now()->toDateString()) {
            return back()->withErrors(['available_slot_id' => 'La hora seleccionada ya no es válida.'])->withInput();
        }

        if ($slot->appointments()->count() >= $slot->max_bookings) {
            return back()->withErrors(['available_slot_id' => 'Esta hora ya no tiene cupo disponible.'])->withInput();
        }

        Appointment::create([
            'user_id' => Auth::id(),
            'available_slot_id' => $slot->id,
            'date' => $slot->date,
            'time' => $slot->start_time,
        ]);

        return back()->with('success', 'Cita agendada con éxito.');
    }
}
