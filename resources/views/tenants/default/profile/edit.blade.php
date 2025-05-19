@php
    $isUser = auth()->user()->hasRole('Usuario');
@endphp

@extends($isUser ? 'tenants.default.layouts.app' : 'tenants.default.layouts.panel')

@if($isUser)
@section('navbar')
@section('navbar-class', 'navbar-dark-mode')
    @include('tenants.default.layouts.navigation')
@endsection

@section('body-class', 'theme-dark')
@endif

@section('content')
    <div class="container pb-5" style="padding-top: {{ $isUser ? '100px' : '0' }};">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h3 class="fw-bold mb-0" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-person me-2"></i>{{ __('Perfil') }}
            </h3>
            @unless(auth()->user()->hasRole('Usuario'))
                <a href="{{ route('dashboard') }}" class="btn btn-sm"
                    style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                    <i class="bi bi-arrow-left me-2"></i>Volver
                </a>
            @endunless
        </div>
        {{-- Formulario: Información de perfil --}}
        <div class="card shadow border-0 mb-4"
            style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};">
            <div class="card-body p-4">
                @include('tenants.default.profile.partials.update-profile-information-form')
            </div>
        </div>

        {{-- Formulario: Cambiar contraseña --}}
        <div class="card shadow border-0 mb-4"
            style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};">
            <div class="card-body p-4">
                @include('tenants.default.profile.partials.update-password-form')
            </div>
        </div>

        {{-- Formulario: Eliminar cuenta --}}
        <div class="card shadow border-0" style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};">
            <div class="card-body p-4">
                @include('tenants.default.profile.partials.delete-user-form')
            </div>
        </div>
    </div>

    @if($isUser)
        @include('tenants.default.layouts.footer')
    @endif
@endsection