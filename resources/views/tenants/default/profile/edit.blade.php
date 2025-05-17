@extends('tenants.default.layouts.panel')

@section('title', 'Dashboard')

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    <div class="container">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h3 class="h3 mb-0 fw-bold" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};"><i class="bi bi-person me-2"></i>{{ __('Perfil') }}</h3>
            <a href="{{ route('dashboard') }}" class="btn btn-sm" style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>

        <div class="card shadow border-0 mb-4"
            style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};">
            <div class="card-body p-4">
                @include('tenants.default.profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="card shadow border-0 mb-4"
            style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};">
            <div class="card-body p-4">
                @include('tenants.default.profile.partials.update-password-form')
            </div>
        </div>

        <div class="card shadow border-0" style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};">
            <div class="card-body p-4">
                @include('tenants.default.profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
