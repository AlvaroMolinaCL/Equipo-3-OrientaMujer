@extends('layouts.app')

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
    <div class="container">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h2 mb-0">{{ __('Panel de Control') }}</h2>
            <a href="{{ route('tenants.index') }}" class="btn btn-outline-primary">Ver Tenants</a>
        </div>

        {{-- Métricas --}}
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-light">Usuarios Registrados</h6>
                        <h3 class="card-title">245</h3>
                        {{-- Reemplazar con: {{ $userCount }} --}}
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-light">Nuevos Ingresos Hoy</h6>
                        <h3 class="card-title">12</h3>
                        {{-- Reemplazar con: {{ $newUsersToday }} --}}
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-light">Suscripciones Activas</h6>
                        <h3 class="card-title">83</h3>
                        {{-- Reemplazar con: {{ $activeSubscriptions }} --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabla de usuarios --}}
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Últimos Usuarios Registrados</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Fecha Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Repetir dinámicamente con @foreach --}}
                            <tr>
                                <td>Juan Pérez</td>
                                <td>juan@example.com</td>
                                <td>01/05/2025</td>
                            </tr>
                            <tr>
                                <td>María Gómez</td>
                                <td>maria@example.com</td>
                                <td>01/05/2025</td>
                            </tr>
                            {{-- Fin loop --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
