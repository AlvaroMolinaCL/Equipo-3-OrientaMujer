@extends('layouts.app')

@section('content')
<div class="container-fluid">
    {{-- Encabezado --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 fw-bold mb-0" style="color: #8C2D18;">Token de acceso</h2>
        <a href="{{ route('dashboard') }}" class="btn btn-sm" style="background-color: #F5E8D0; color: #8C2D18;">
            <i class="bi bi-arrow-left me-1"></i> Volver
        </a>
    </div>

    {{-- Tarjeta de Token --}}
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header d-flex align-items-center" style="background-color: #8C2D18; color: white;">
            <i class="bi bi-key-fill me-2"></i>
            <h5 class="mb-0">Token de acceso diario</h5>
        </div>
        <div class="card-body" style="background-color: #fff;">
            <p class="text-muted">El token de acceso para el registro de hoy es:</p>
            <div class="alert text-center" style="background-color: #FDF5E5; border: 2px dashed #BF8A49; font-size: 24px; color: #8C2D18;">
                {{ $token }}
            </div>
            <p class="text-muted">Este token será válido solo por hoy. Puedes compartirlo con los usuarios autorizados.</p>
        </div>
    </div>
</div>
@endsection
