@extends('tenants.default.layouts.app')

@section('title', tenantPageName('appointment_questionnaire', 'Cuestionario Pre-Agendamiento') . ' - ' . tenantSetting('name', 'Tenant'))

@section('navbar')
    @section('navbar-class', 'navbar-light-mode')
    @include('tenants.default.layouts.navigation')
@endsection

@section('body-class', 'theme-light')

@section('content')
<section class="py-5" style="margin-top: 80px;">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="mb-3" style="font-family: {{ tenantSetting('heading_font', '') }}; color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                <i class="bi bi-file-earmark-text me-2"></i>Cuestionario Previo a la Asesoría
            </h1>
            <p class="lead" style="color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                Nos ayudará a preparar mejor tu asesoría jurídica
            </p>
            <div class="alert alert-light border" role="alert">
                <i class="bi bi-lock me-2"></i>Todas tus respuestas son confidenciales y seguras
            </div>
        </div>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('tenant.agenda.questionnaire.process') }}" class="needs-validation" novalidate>
            @csrf

            {{-- Sección 1 --}}
            <div class="mb-5 p-4 rounded" style="background-color: rgba({{ tenantSetting('navbar_color_2_rgb', '74,29,11') }}, 0.05); border-left: 4px solid {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                <h4 class="mb-4" style="color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                    <i class="bi bi-exclamation-circle me-2"></i>Tu situación actual
                </h4>

                <div class="mb-4">
                    <label class="form-label fw-bold">¿Te encuentras en una situación de riesgo o peligro? <span class="text-danger">*</span></label>
                    @php
                        $q1_options = [
                            'riesgo_seguridad' => 'Sí, temo por mi seguridad o la de mis hijos/as.',
                            'compleja' => 'No, pero la situación es compleja o tensa.',
                            'urgente' => 'No, pero necesito orientación urgente.',
                            'no_segura' => 'No estoy segura / Prefiero comentarlo en la sesión.'
                        ];
                    @endphp
                    <div class="d-flex flex-column gap-2">
                        @foreach($q1_options as $val => $text)
                            <div class="form-check py-2 px-1 rounded" style="background-color: #f8f9fa;">
                                <input class="form-check-input" type="radio" name="q1" id="q1_{{ $val }}" value="{{ $val }}" required style="transform: scale(1.2);">
                                <label class="form-check-label ms-2" for="q1_{{ $val }}">{{ $text }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="alert alert-warning mt-3" role="alert" style="border-left: 3px solid {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Importante:</strong> Si estás en riesgo, acude a Carabineros, PDI, Fiscalía o Tribunales.
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">¿Qué tan pronto necesitas la asesoría? <span class="text-danger">*</span></label>
                    <select name="q2" class="form-select py-2" required style="border-left: 3px solid {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                        <option value="" disabled selected>Selecciona una opción</option>
                        <option value="lo_antes_posible">Lo antes posible</option>
                        <option value="esta_semana">Esta semana</option>
                        <option value="proxima_semana">La próxima semana</option>
                        <option value="este_mes">Dentro de este mes</option>
                    </select>
                </div>
            </div>

            {{-- Sección 2 --}}
            <div class="mb-5 p-4 rounded" style="background-color: rgba({{ tenantSetting('navbar_color_2_rgb', '74,29,11') }}, 0.05); border-left: 4px solid {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                <h4 class="mb-4" style="color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                    <i class="bi bi-file-earmark-text me-2"></i>Información legal
                </h4>

                <div class="mb-4">
                    <label class="form-label fw-bold">¿Tienes actualmente una causa judicial en curso? <span class="text-danger">*</span></label>
                    <select name="q3" class="form-select py-2" required style="border-left: 3px solid {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                        <option value="" disabled selected>Selecciona una opción</option>
                        <option value="si_orientacion">Sí, y necesito orientación específica</option>
                        <option value="no_quiero_iniciar">No, pero quiero iniciar una acción legal</option>
                        <option value="no_segura">No estoy segura</option>
                        <option value="no_aplica">No aplica a mi caso</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">¿Cuál es la materia principal de tu consulta?</label>
                    <select name="q4" class="form-select py-2" style="border-left: 3px solid {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                        <option value="" disabled selected>Selecciona una opción</option>
                        <option value="familia">Derecho de familia</option>
                        <option value="penal">Derecho penal</option>
                        <option value="genero">Violencia de género</option>
                        <option value="laboral">Derecho laboral</option>
                        <option value="civil">Derecho civil</option>
                        <option value="comercial">Derecho comercial</option>
                        <option value="no_se">No lo sé</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Si sabes el trámite o procedimiento que necesitas, indícalo:</label>
                    <div class="input-group">
                        <span class="input-group-text" style="background-color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }}; color: white;">
                            <i class="bi bi-pencil-square"></i>
                        </span>
                        <input type="text" name="q5" class="form-control py-2" placeholder="Ej: Demanda por VIF, Ley Karin, etc.">
                    </div>
                </div>
            </div>

            {{-- Sección 3 --}}
            <div class="mb-5 p-4 rounded" style="background-color: rgba({{ tenantSetting('navbar_color_2_rgb', '74,29,11') }}, 0.05); border-left: 4px solid {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                <h4 class="mb-4" style="color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                    <i class="bi bi-chat-square-text me-2"></i>Contexto de tu situación
                </h4>

                <div class="mb-4">
                    <label class="form-label fw-bold">¿La situación ocurre actualmente?</label>
                    <select name="q6" class="form-select py-2" style="border-left: 3px solid {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                        <option value="" disabled selected>Selecciona una opción</option>
                        <option value="actual">Sí, está ocurriendo ahora</option>
                        <option value="reciente">Ocurrió recientemente (últimos 6 meses)</option>
                        <option value="mas_6_meses">Hace más de 6 meses</option>
                        <option value="solo_info">Solo quiero información general</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">¿Has recibido asesoría legal anteriormente por esta situación?</label>
                    <select name="q7" class="form-select py-2 mb-3" style="border-left: 3px solid {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                        <option value="" disabled selected>Selecciona una opción</option>
                        <option value="si_cual">Sí, con otra abogada o institución</option>
                        <option value="no_primera">No, esta es mi primera vez</option>
                        <option value="busque_info">Solo he buscado información por mi cuenta</option>
                    </select>
                    <div class="input-group">
                        <span class="input-group-text" style="background-color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }}; color: white;">
                            <i class="bi bi-building"></i>
                        </span>
                        <input type="text" name="q7_detail" class="form-control py-2" placeholder="¿Cuál institución o profesional? (opcional)">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">¿Qué tipo de asesoría prefieres?</label>
                    <select name="q8" class="form-select py-2" style="border-left: 3px solid {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                        <option value="" disabled selected>Selecciona una opción</option>
                        <option value="informativa">Informativa (conocer derechos y opciones)</option>
                        <option value="especifica">Específica (actuar legalmente)</option>
                        <option value="acompanamiento">Acompañamiento y seguimiento</option>
                        <option value="no_se">No lo sé / necesito orientación</option>
                    </select>
                </div>
            </div>

            {{-- Botón de envío --}}
            <div class="text-center">
                <button type="submit" class="btn btn text-white py-2 px-5 rounded-pill" 
                    style="background-color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                    <i class="bi bi-send-check me-2"></i> Enviar cuestionario
                </button>
                <p class="text-muted mt-3">
                    <small><i class="bi bi-shield-lock me-1"></i>Tus datos están protegidos</small>
                </p>
            </div>
        </form>
    </div>
</section>

<script>
// Validación básica con Bootstrap
(function () {
  'use strict'

  var forms = document.querySelectorAll('.needs-validation')

  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>
@endsection