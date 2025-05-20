@extends('layouts.app')

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0" style="color: #8C2D18;">
                <i class="bi bi-key me-2"></i>Token de Acceso
            </h3>
            <a href="{{ route('dashboard') }}" class="btn btn-sm" style="background-color: #F5E8D0; color: #8C2D18;">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        {{-- Tarjeta de Token --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header d-flex align-items-center" style="background-color: #8C2D18; color: white;">
                <i class="bi bi-key-fill me-2"></i>
                <h5 class="mb-0">Token de Acceso Diario</h5>
            </div>
            <div class="card-body" style="background-color: #fff;">
                <p class="text-muted">El token de acceso para el registro de hoy es:</p>
                <div class="alert text-center"
                    style="background-color: #FDF5E5; border: 2px dashed #BF8A49; font-size: 24px; color: #8C2D18;">
                    {{ $token }}
                </div>
                <p class="text-muted">Este token será válido solo por hoy. Puedes compartirlo con los usuarios autorizados.
                </p>
            </div>
        </div>

        {{-- Lista de Solicitudes Pendientes --}}
        @if ($solicitudes->count())
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header d-flex align-items-center" style="background-color: #8C2D18; color: white;">
                    <i class="bi bi-person-check-fill me-2"></i>
                    <h5 class="mb-0">Solicitudes de Super Admin Pendientes</h5>
                </div>
                <div class="card-body" style="background-color: #fff;">
                    @foreach ($solicitudes as $solicitud)
                        <div class="border rounded p-3 mb-3" style="background-color: #FDF5E5;">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1" style="color: #8C2D18;">
                                        <i class="bi bi-person-fill me-1"></i>{{ $solicitud->name }}
                                        <span class="text-muted fs-6">({{ $solicitud->email }})</span>
                                    </h6>
                                    @if ($solicitud->reason)
                                        <p class="mb-2 text-muted"><i class="bi bi-chat-left-text me-1"></i>{{ $solicitud->reason }}</p>
                                    @endif
                                </div>
                                <form method="POST" action="{{ route('admin.solicitudes.aprobar', $solicitud->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm" style="background-color: #28a745; color: white;">
                                        <i class="bi bi-send-check me-1"></i>Aprobar y Enviar Invitación
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="alert alert-secondary text-center">
                No hay solicitudes pendientes por aprobar.
            </div>
        @endif

    </div>
@endsection