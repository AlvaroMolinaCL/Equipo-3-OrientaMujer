@extends('tenants.default.layouts.panel')

@section('title', 'Dashboard')

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    <div class="container">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h2 class="h2 mb-0" style="color: {{ tenantSetting('primary_text_color', '#8C2D18') }};">
                <i class="bi bi-person me-2"></i>{{ __('Perfil') }}
            </h2>
            <a href="{{ route('dashboard') }}" class="btn btn-sm" style="background-color: {{ tenantSetting('input_bg_color', '#F5E8D0') }}; color: {{ tenantSetting('primary_text_color', '#8C2D18') }};">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>

        <div class="card shadow border-0 mb-4" style="background-color: {{ tenantSetting('alert_bg_color', '#FDF5E5') }};">
            <div class="card-body p-4">
                @include('tenants.default.profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="card shadow border-0 mb-4" style="background-color: {{ tenantSetting('alert_bg_color', '#FDF5E5') }};">
            <div class="card-body p-4">
                @include('tenants.default.profile.partials.update-password-form')
            </div>
        </div>

        <div class="card shadow border-0 mb-4" style="background-color: {{ tenantSetting('alert_bg_color', '#FDF5E5') }};">
            <div class="card-body p-4">
                @include('tenants.default.profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
