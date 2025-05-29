<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AvailableSlot;
use App\Models\TenantPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\QuestionnaireResponse;



class AgendaController extends Controller
{
    public function showQuestionnaire()
    {
        return view('tenants.default.agenda.questionnaire');
    }



    public function processQuestionnaire(Request $request)
    {
        $validated = $request->validate([
            'q1' => 'required|string',
            'q2' => 'required|string',
            'q3' => 'required|string',
            'q4' => 'nullable|string',
            'q5' => 'nullable|string',
            'q6' => 'nullable|string',
            'q7' => 'nullable|string',
            'q7_detail' => 'nullable|string',
            'q8' => 'nullable|string',
        ]);

        QuestionnaireResponse::create([
            'user_id' => Auth::id(),
            'q1' => $validated['q1'],
            'q2' => $validated['q2'],
            'q3' => $validated['q3'],
            'q4' => $validated['q4'] ?? null,
            'q5' => $validated['q5'] ?? null,
            'q6' => $validated['q6'] ?? null,
            'q7' => $validated['q7'] ?? null,
            'q7_detail' => $validated['q7_detail'] ?? null,
            'q8' => $validated['q8'] ?? null,
        ]);

        return redirect()->route('tenant.agenda.index')->with('success', 'Gracias por completar el cuestionario.');
    }



    public function index()
    {
        $tenantId = tenant('id');
        $cuestionarioHabilitado = TenantPage::where('tenant_id', $tenantId)
            ->where('page_key', 'questionnaire')
            ->where('is_enabled', true)
            ->exists();

        if ($cuestionarioHabilitado && !session('cuestionario_aprobado')) {
            return redirect()->route('tenant.agenda.questionnaire');
        }

        return view('tenants.default.agenda.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'available_slot_id' => 'required|exists:available_slots,id',
            'description' => 'required|string|max:500',
        ]);

        $slot = AvailableSlot::findOrFail($validated['available_slot_id']);

        if ($slot->date < now()->toDateString()) {
            return back()->withErrors(['available_slot_id' => 'La hora seleccionada ya no es válida.']);
        }

        if ($slot->appointments()->count() >= $slot->max_bookings) {
            return back()->withErrors(['available_slot_id' => 'Esta hora ya no tiene cupo disponible.']);
        }

        Appointment::create([
            'user_id' => Auth::id(),
            'available_slot_id' => $slot->id,
            'description' => $validated['description'],
        ]);

        return redirect()->route('tenant.agenda.index')->with('success', 'Cita agendada con éxito.');
    }

    // 🔹 NUEVO MÉTODO: Confirmación de Cita
    public function confirm(Request $request)
    {
        $slotId = $request->query('slot_id');

        $slot = AvailableSlot::where('id', $slotId)->first();

        if (!$slot) {
            abort(404, 'Horario no válido o no disponible.');
        }

        return view('tenants.default.agenda.confirm', compact('slot'));
    }
}