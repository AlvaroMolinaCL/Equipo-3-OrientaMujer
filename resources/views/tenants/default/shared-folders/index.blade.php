@extends('tenants.default.layouts.panel')

@section('title', 'Dashboard')

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    <div class="container-fluid py-4">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 fw-bold mb-0" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-share-fill fs-4"></i>
                Archivos Compartidos
            </h2>
            <a href="{{ route('dashboard') }}" class="btn btn-sm" style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                                      color: {{ tenantSetting('text_color_1', '#8C2D18') }};
                                      border: 2px solid {{ tenantSetting('color_tables', '#8C2D18') }};">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>

        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-center">
                <form method="GET" action="{{ route('files.shared.folders') }}" style="max-width: 400px; width: 100%;">
                    <div class="input-group">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                            placeholder="Buscar por nombre de usuario o correo electrónico">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>


        {{-- Listado de usuarios --}}
        @if($users->isNotEmpty())
            <div class="row g-4">
                @foreach($users as $user)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="card border-0 h-100 shadow-sm user-card">
                            <a href="{{ route('files.shared.byUser', $user) }}" class="text-decoration-none">
                                <div class="card-body p-4"
                                    style="background-color: {{ tenantSetting('background_color_2', '#F5E8D0') }};">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar-container me-3">
                                            <div class="avatar-initials"
                                                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 fw-semibold"
                                                style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">{{ $user->name }}
                                            </h5>
                                            <small class="text-muted">Compartió {{ $user->sharedFilesCount }} archivos</small>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-light text-dark rounded-pill">
                                            <i class="bi bi-person-check me-1"></i> {{ $user->email }}
                                        </span>
                                        <span class="badge rounded-pill"
                                            style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                            <i class="bi bi-folder2-open me-1"></i> Ver archivos
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Estado vacío --}}
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 bg-light">
                        <div class="card-body text-center p-5">
                            <div class="empty-state-icon mb-4">
                                <i class="bi bi-share fs-1" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};"></i>
                            </div>
                            <h4 class="mb-3" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">No tienes archivos
                                compartidos</h4>
                            <p class="text-muted mb-4">Cuando otros usuarios compartan archivos contigo, aparecerán aquí.</p>
                            <a href="{{ route('dashboard') }}" class="btn btn-sm"
                                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                <i class="bi bi-arrow-left me-1"></i> Volver al inicio
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <style>
        .icon-container {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .avatar-container {
            width: 56px;
            height: 56px;
        }

        .avatar-initials {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.25rem;
        }

        .user-card {
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .user-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1) !important;
            border-color:
                {{ tenantSetting('color_tables', '#8C2D18') }}
            ;
        }

        .empty-state-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba({{ tenantSetting('background_color_1', '#F5E8D0') }}, 0.3);
            border-radius: 50%;
        }
    </style>
@endpush