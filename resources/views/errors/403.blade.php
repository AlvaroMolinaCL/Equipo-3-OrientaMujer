@extends('layouts.guest')

@section('content')
<div class="container d-flex flex-column justify-content-center align-items-center min-vh-100 text-center">
    <div class="mb-4">
        <i class="bi bi-shield-lock-fill" style="font-size: 4rem; color: #8C2D18;"></i>
    </div>
    <h1 class="display-4 fw-bold mb-3" style="color: #8C2D18;">403 - Acceso Denegado</h1>
    <p class="lead mb-4" style="color: #4A1D0B;">No tienes permisos para acceder a esta sección del sistema.</p>

    @php
        $route = tenant() ? route('tenants.default.index') : route('dashboard');
    @endphp

    <a href="{{ $route }}" class="btn text-white fw-medium px-4 py-2" style="background-color: #8C2D18;">
        <i class="bi bi-arrow-left-circle me-2"></i>Volver atrás
    </a>
</div>
@endsection
