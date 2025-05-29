@extends('layouts.app')

@section('title', 'Panel de Control - ' . config('app.name', 'Laravel'))

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0" style="color: #8C2D18;">
                <i class="bi bi-speedometer2 me-2"></i>{{ __('Panel de Control') }}
            </h3>
        </div>

        {{-- Métricas --}}
        <div class="row mb-4 justify-content-center">
            {{-- Usuarios Registrados --}}
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card text-white h-100" style="background-color: #BF8A49;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="card-subtitle mb-2 text-light">Usuarios Registrados</h6>
                                <h3 class="card-title">{{ $user_count }}</h3>
                            </div>
                            <i class="bi bi-people fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Usuarios Nuevos Hoy --}}
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card text-white h-100" style="background-color: #BF8A49;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="card-subtitle mb-2 text-light">Nuevos Hoy</h6>
                                <h3 class="card-title">{{ $user_today }}</h3>
                            </div>
                            <i class="bi bi-person-add fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tenants Activos --}}
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card text-white h-100" style="background-color: #BF8A49;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="card-subtitle mb-2 text-light">Tenants Activos</h6>
                                <h3 class="card-title">{{ $tenant_count }}</h3>
                            </div>
                            <i class="bi bi-building fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tenants Nuevos Hoy --}}
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card text-white h-100" style="background-color: #BF8A49;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="card-subtitle mb-2 text-light">Nuevos Hoy</h6>
                                <h3 class="card-title">{{ $tenant_today }}</h3>
                            </div>
                            <i class="bi bi-building-add fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabla de Usuarios --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center"
                style="background-color: #8C2D18; color: white;">
                <h5 class="mb-0">Últimos Usuarios</h5>
                <a href="{{ route('users.index') }}" class="btn btn-sm" style="background-color: #FDF5E5; color: #8C2D18;">
                    <i class="bi bi-eye"></i> Ver Usuarios
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: #FDF5E5;">
                            <tr>
                                <th style="color: #8C2D18;">Nombre</th>
                                <th style="color: #8C2D18;">Email</th>
                                <th style="color: #8C2D18;">Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($last_users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-muted">No hay usuarios registrados en los últimos 5 días.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Tabla de Tenants --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center"
                style="background-color: #8C2D18; color: white;">
                <h5 class="mb-0">Últimos Tenants</h5>
                <a href="{{ route('tenants.index') }}" class="btn btn-sm"
                    style="background-color: #FDF5E5; color: #8C2D18;">
                    <i class="bi bi-eye"></i> Ver Tenants
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: #FDF5E5;">
                            <tr>
                                <th style="color: #8C2D18;">Nombre</th>
                                <th style="color: #8C2D18;">Email</th>
                                <th style="color: #8C2D18;">Dominio(s)</th>
                                <th style="color: #8C2D18;">Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($last_tenants as $tenant)
                                <tr>
                                    <td>{{ $tenant->name }}</td>
                                    <td>{{ $tenant->email }}</td>
                                    <td>
                                        @foreach ($tenant->domains as $domain)
                                            {{ $domain->domain }}{{ !$loop->last ? ',' : '' }}
                                        @endforeach
                                    </td>
                                    <td>{{ $tenant->created_at }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-muted">No hay tenants creados en los últimos 5 días.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
