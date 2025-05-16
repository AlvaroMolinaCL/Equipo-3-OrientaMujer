@extends('tenants.default.layouts.panel')

@section('title', 'Dashboard')

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    <div class="container">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h2 class="h3 mb-0 fw-bold" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-folder-symlink me-2"></i>{{ __('Archivos Compartidos Conmigo') }}
            </h2>
            <a href="{{ route('dashboard') }}" class="btn btn-sm" style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                  color: {{ tenantSetting('text_color_1', '#8C2D18') }};
                  border: 2px solid {{ tenantSetting('color_tables', '#8C2D18') }};">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>
        <div class="container">
            <div class="row">
                @forelse($users as $user)
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('files.shared.byUser', $user) }}" class="text-decoration-none">
                            <div class="card shadow-sm h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-folder-fill" style="font-size: 2rem; color: #BF8A49;"></i>
                                    <h5 class="mt-2" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                        {{ $user->name }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <p>No hay archivos compartidos aún.</p>
                @endforelse
            </div>
        </div>
@endsection