@extends('tenants.default.layouts.app')

@section('title', tenantPageName('questionnaire', 'Cuestionario Pre-Agendamiento') . ' - ' . tenantSetting('name',
    'Tenant'))

@section('navbar')
    @section('navbar-class', 'navbar-light-mode')
    @include('tenants.default.layouts.navigation')
@endsection

@section('body-class', 'theme-light')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <div class="mb-5">
                <h1 class="mb-3"
                    style="font-family: {{ tenantSetting('heading_font', '') }}; color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                    <i
                        class="bi bi-file-earmark-text me-2"></i>{{ tenantPageName('questionnaire', 'Cuestionario Pre-Agendamiento') }}
                </h1>
                @php
                    $navbarColor = tenantSetting('navbar_color_2', '#4A1D0B');
                    $text = <<<HTML
                    <p class="lead" style="color: {$navbarColor};">
                        Para brindarte una asesoría adecuada, necesitamos que respondas las siguientes preguntas. Marca la(s)
                        opción(es) que mejor describan tu situación. Las preguntas marcadas con <span class="text-danger">*</span> son obligatorias.
                    </p>
                    HTML;
                @endphp
                {!! tenantText('questionnaire_lead', $text) !!}
                <div class="alert alert-light border" role="alert">
                    <i class="bi bi-lock me-2"></i>{!! tenantText(
                        'questionnaire_confidential_notice',
                        'Este formulario es confidencial y tiene por objetivo ofrecerte una atención más empática, clara y efectiva.',
                    ) !!}
                </div>
            </div>
        
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <form method="POST" action="{{ route('tenant.agenda.questionnaire.process') }}" class="needs-validation"
                novalidate>
                @csrf
            
                @php
                    $step = 1;
                @endphp
            
                @foreach ($sections as $section)
                    @foreach ($section->questions as $question)
                        <div class="question-step {{ $step > 1 ? 'd-none' : '' }}" data-step="{{ $step }}">
                            <h4 class="mb-4" style="color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                                @if ($section->icon)
                                    <i class="bi {{ $section->icon }} me-2"></i>
                                @endif
                                {{ $section->title }}
                            </h4>
                            <div class="mb-4">
                                <label class="form-label fw-bold">
                                    {{ $question->question }}
                                    @if ($question->is_required)
                                        <span class="text-danger">*</span>
                                    @endif
                                </label>
                                @if ($question->type === 'radio')
                                    <div class="d-flex flex-column gap-2">
                                        @foreach ($question->options ?? [] as $val => $text)
                                            <div class="form-check py-2 px-1 rounded" style="background-color: #f8f9fa;">
                                                <input class="form-check-input" type="radio" name="{{ $question->name }}"
                                                    id="{{ $question->name }}_{{ $val }}"
                                                    value="{{ $val }}"
                                                    {{ old($question->name) == $val ? 'checked' : '' }}
                                                    {{ $question->is_required ? 'required' : '' }}
                                                    style="transform: scale(1.2);">
                                                <label class="form-check-label ms-2"
                                                    for="{{ $question->name }}_{{ $val }}">{{ $text }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                @elseif($question->type === 'text')
                                    <input type="text" name="{{ $question->name }}" class="form-control py-2"
                                        placeholder="{{ $question->placeholder }}" value="{{ old($question->name) }}"
                                        {{ $question->is_required ? 'required' : '' }}>
                                @elseif($question->type === 'textarea')
                                    <textarea name="{{ $question->name }}" class="form-control py-2" placeholder="{{ $question->placeholder }}"
                                        {{ $question->is_required ? 'required' : '' }}>{{ old($question->name) }}</textarea>
                                @endif
                                    
                                @if ($question->help_text)
                                    <div class="alert alert-danger mt-3" role="alert"
                                        style="border-left: 3px solid {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                                        {!! $question->help_text !!}
                                    </div>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between">
                                @if ($step > 1)
                                    <button type="button" class="btn prev-step"
                                        style="background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }}; color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }};">Anterior</button>
                                @endif
                                @if ($step < $questions->count())
                                    <button type="button" class="btn next-step"
                                        style="background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }}; color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }};">Siguiente</button>
                                @else
                                    <button type="submit" class="btn"
                                        style="background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }}; color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }};"><i
                                            class="bi bi-send-check me-2"></i>Enviar Cuestionario</button>
                                @endif
                            </div>
                        </div>
                        @php $step++; @endphp
                    @endforeach
                @endforeach
            </form>
        </div>
    </section>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentStep = 1;
            const steps = document.querySelectorAll('.question-step');
            const totalSteps = steps.length;
        
            function showStep(step) {
                steps.forEach((el, idx) => {
                    el.classList.toggle('d-none', idx !== (step - 1));
                });
            }
        
            document.querySelectorAll('.next-step').forEach(btn => {
                btn.addEventListener('click', function() {
                    if (currentStep < totalSteps) {
                        currentStep++;
                        showStep(currentStep);
                    }
                });
            });
        
            document.querySelectorAll('.prev-step').forEach(btn => {
                btn.addEventListener('click', function() {
                    if (currentStep > 1) {
                        currentStep--;
                        showStep(currentStep);
                    }
                });
            });
        
            showStep(currentStep);
        });
    
        (function() {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
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
