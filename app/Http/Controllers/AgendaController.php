<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AvailableSlot;
use App\Models\Commune;
use App\Models\TenantPage;
use App\Models\QuestionnaireQuestion;
use App\Models\QuestionnaireResponse;
use App\Models\QuestionnaireSection;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
{
    public function showQuestionnaire()
    {
        $sections = QuestionnaireSection::with('questions')->orderBy('order')->get();
        $questions = QuestionnaireQuestion::orderBy('order')->get();

        return view('tenants.default.agenda.questionnaire', compact('sections', 'questions'));
    }

    public function processQuestionnaire(Request $request)
    {
        $questions = QuestionnaireQuestion::orderBy('order')->get();
        $rules = [];

        foreach ($questions as $question) {
            $rule = [];
            if ($question->is_required) {
                $rule[] = 'required';
            } else {
                $rule[] = 'nullable';
            }
            if ($question->type === 'text' || $question->type === 'textarea') {
                $rule[] = 'string';
            }
            $rules[$question->name] = implode('|', $rule);
        }

        $validated = $request->validate($rules);

        $response = QuestionnaireResponse::create([
            'user_id' => Auth::id(),
            ...$validated,
        ]);

        if (tenantAgendaFlow() === 'solo_cuestionario') {
            return redirect()->route('tenant.agenda.questionnaire.thanks');
        } else {
            return redirect()->route('tenant.agenda.index')->with('success', 'Gracias por completar el cuestionario.');
        }
    }

    public function index()
    {
        $tenantId = tenant('id');
        $cuestionarioHabilitado = TenantPage::where('tenant_id', $tenantId)
            ->where('page_key', 'questionnaire')
            ->where('is_enabled', true)
            ->exists();

        return view('tenants.default.agenda.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'available_slot_id' => 'required|exists:available_slots,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'second_last_name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:30',
            'residence_region_id' => 'required|exists:regions,id',
            'residence_commune_id' => 'required|exists:communes,id',
            'incident_region_id' => 'required|exists:regions,id',
            'incident_commune_id' => 'required|exists:communes,id',
            'questionnaire_response_id' => 'required|exists:questionnaire_responses,id',
        ]);

        $slot = AvailableSlot::findOrFail($validated['available_slot_id']);

        if ($slot->date < now()->toDateString()) {
            return back()->withErrors(['available_slot_id' => 'La hora seleccionada ya no es válida.']);
        }

        session([
            'appointment_slot_id' => $validated['available_slot_id'],
            'appointment_first_name' => $validated['first_name'],
            'appointment_last_name' => $validated['last_name'],
            'appointment_second_last_name' => $validated['second_last_name'],
            'appointment_email' => $validated['email'],
            'appointment_phone_number' => $validated['phone_number'],
            'appointment_residence_region_id' => $validated['residence_region_id'],
            'appointment_residence_commune_id' => $validated['residence_commune_id'],
            'appointment_incident_region_id' => $validated['incident_region_id'],
            'appointment_incident_commune_id' => $validated['incident_commune_id'],
            'appointment_questionnaire_response_id' => $validated['questionnaire_response_id'],
        ]);

        return redirect()->route('checkout')->with('success', 'Cita agendada con éxito.');
    }

    public function confirm(Request $request)
    {
        $slotId = $request->query('slot_id');
        $questionnaireResponseId = $request->query('questionnaire_response_id'); // pásalo en la URL

        $slot = AvailableSlot::where('id', $slotId)->first();
        if (!$slot) {
            abort(404, 'Horario no válido o no disponible.');
        }

        $regions = Region::orderBy('name')->get();
        $communes = Commune::orderBy('name')->get();

        $user = Auth::user();

        // Busca el último cuestionario respondido por el usuario
        $questionnaireResponse = QuestionnaireResponse::where('user_id', $user->id)
            ->latest()
            ->first();

        $questionnaireResponseId = $questionnaireResponse ? $questionnaireResponse->id : null;

        return view('tenants.default.agenda.confirm', compact('slot', 'regions', 'communes', 'user', 'questionnaireResponseId'));
    }
}
