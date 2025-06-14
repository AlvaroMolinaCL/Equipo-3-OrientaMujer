@php
    $isUser = auth()->user()->hasRole('Usuario');
@endphp

@extends($isUser ? 'tenants.default.layouts.app' : 'tenants.default.layouts.panel')

@if ($isUser)
    @section('navbar')
    @section('navbar-class', 'navbar-light-mode')
        @include('tenants.default.layouts.navigation')
    @endsection

    @section('body-class', 'theme-light')
@endif

@section('content')
    <div class="container" style="padding-top: {{ $isUser ? '100px' : '0' }};">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 fw-bold mb-0" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-share-fill fs-4"></i>
                Archivos Compartidos
            </h2>
            @php
                $redirectRoute = auth()->user()->hasRole('Admin') ? route('dashboard') : route('files.index');
            @endphp
            <a href="{{ $redirectRoute }}" class="btn btn-sm"
                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                           color: {{ tenantSetting('text_color_1', '#8C2D18') }};
                           border: 2px solid {{ tenantSetting('color_tables', '#8C2D18') }};">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-center">
                <form method="GET" action="{{ route('files.shared.files') }}" style="max-width: 400px; width: 100%;">
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


        {{-- Listado de Usuarios --}}
        @if ($users->isNotEmpty())
            <div class="row g-4">
                @foreach ($users as $user)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="card border-0 h-100 shadow-sm user-card">
                            <a href="{{ route('files.shared.byUser', $user) }}" class="text-decoration-none">
                                @php
                                    $bgColor = $isUser
                                        ? tenantSetting('background_color_1', '#FDF5E5')
                                        : tenantSetting('background_color_2', '#F5E8D0');
                                @endphp
                                <div class="card-body p-4" style="background-color: {{ $bgColor }};">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar-container me-3">
                                            <div class="avatar-initials"
                                                style="background-color: {{ $isUser ? tenantSetting('background_color_2', '#FDF5E5') : tenantSetting('background_color_1', '#F5E8D0') }};
                                        color: {{ tenantSetting('text_color_1', '#8C2D18') }};">

                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 fw-semibold"
                                                style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                                {{ $user->name }}
                                            </h5>
                                            <small class="text-muted">Compartió {{ $user->sharedFilesCount }}
                                                archivos</small>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge rounded-pill"
                                            style="background-color: {{ $isUser ? tenantSetting('background_color_2', '#FDF5E5') : tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                            <i class="bi bi-person-check me-1"></i> {{ $user->email }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Estado Vacío --}}
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 bg-light">
                        <div class="card-body text-center p-5">
                            <div class="empty-state-icon mb-4">
                                <i class="bi bi-share fs-1"
                                    style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};"></i>
                            </div>
                            <h4 class="mb-3" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                No tienes archivos compartidos</h4>
                            <p class="text-muted mb-4">Cuando otros usuarios compartan archivos contigo, aparecerán aquí.
                            </p>
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
                {{ tenantSetting('color_tables', '#8C2D18') }};
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
