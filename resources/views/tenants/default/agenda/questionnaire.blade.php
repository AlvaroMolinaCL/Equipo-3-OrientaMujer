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
            <h2 class="mb-4" style="font-family: {{ tenantSetting('heading_font', '') }}">
                Cuestionario previo a la agenda
            </h2>   

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif  

            <form method="POST" action="{{ route('tenant.agenda.questionnaire.process') }}">
                @csrf   

                <div class="mb-3">
                    <label>Pregunta 1</label>
                    <select name="q1" class="form-control" required>
                        <option value="">Seleccione</option>
                        <option value="yes">Sí</option>
                        <option value="no">No</option>
                    </select>
                </div>  

                <div class="mb-3">
                    <label>Pregunta 2</label>
                    <select name="q2" class="form-control" required>
                        <option value="">Seleccione</option>
                        <option value="yes">Sí</option>
                        <option value="no">No</option>
                    </select>
                </div>  

                <div class="mb-3">
                    <label>Pregunta 3</label>
                    <select name="q3" class="form-control" required>
                        <option value="">Seleccione</option>
                        <option value="yes">Sí</option>
                        <option value="no">No</option>
                    </select>
                </div>  

                <button type="submit" type="submit" class="btn text-white"
                    style="background-color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                    <i class="bi bi-box-arrow-in-right me-1"></i>Enviar Cuestionario</button>
            </form>
        </div>
    </section>
@endsection