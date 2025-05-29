@extends('tenants.default.layouts.app')

@section('title', 'Confirmar Cita - ' . tenantSetting('name', 'Tenant'))

@section('navbar')
    @section('navbar-class', 'navbar-light-mode')
    @include('tenants.default.layouts.navigation')
@endsection

@section('body-class', 'theme-light')

@section('content')
<section class="py-5" style="margin-top: 80px;">
    <div class="container">
        <h1 class="mb-4" style="font-family: {{ tenantSetting('heading_font', '') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
            Confirmar Cita
        </h1>

        <div class="mb-4">
            <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($slot->date)->format('d/m/Y') }}</p>
            <p><strong>Hora:</strong> {{ substr($slot->start_time, 0, 5) }} - {{ substr($slot->end_time, 0, 5) }}</p>
        </div>

            <form action="{{ route('tenant.agenda.store') }}" method="POST">
            @csrf
            <input type="hidden" name="available_slot_id" value="{{ $slot->id }}">

            <div class="mb-3">
                <label class="form-label">Nombre:</label>
                <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Apellido Paterno:</label>
                <input type="text" class="form-control" value="{{ Auth::user()->last_name }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Apellido Materno:</label>
                <input type="text" class="form-control" value="{{ Auth::user()->second_last_name }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Correo Electrónico:</label>
                <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Teléfono:</label>
                <input type="text" class="form-control" value="{{ Auth::user()->phone_number }}" readonly>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descripción del Problema:</label>
                <textarea name="description" class="form-control" maxlength="500" required></textarea>
            </div>

            <a href="/checkout" class="btn text-white" style="background-color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                <i class="bi bi-credit-card me-1"></i> Proceder al Pago
            </a>
        </form>
    </div>
</section>

@include('tenants.default.layouts.footer')
@endsection