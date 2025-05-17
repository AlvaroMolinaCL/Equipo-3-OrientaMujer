<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
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
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
        ]);

        Appointment::create([
            'user_id' => Auth::id(),
            'date' => $validated['date'],
            'time' => $validated['time'],
        ]);

        return back()->with('success', 'Cita agendada con éxito.');
    }
}
