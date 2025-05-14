@extends('tenants.default.layouts.panel')

@section('title', 'Dashboard')

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    <div class="container">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h2 class="h2 mb-0 fw-bold" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-person me-2"></i>{{ __('Perfil') }}
            </h2>
            <a href="{{ route('users.index') }}" class="btn btn-sm" style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                      color: {{ tenantSetting('text_color_1', '#8C2D18') }};
                      border: 2px solid {{ tenantSetting('color_tables', '#8C2D18') }};">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>

        <div class="card-body p-4">
            @include('tenants.default.profile.partials.update-profile-information-form')
        </div>

        <div class="card-body p-4">
            @include('tenants.default.profile.partials.update-password-form')
        </div>

        <div class="card-body p-4">
            @include('tenants.default.profile.partials.delete-user-form')
        </div>
    </div>
@endsection