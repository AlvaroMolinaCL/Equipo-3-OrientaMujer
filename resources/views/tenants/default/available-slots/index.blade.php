@extends('tenants.default.layouts.panel')

@section('title', 'Disponibilidad')

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 fw-bold mb-0" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">{{ __('Disponibilidad') }}
            </h2>
            <a href="{{ route('dashboard') }}" class="btn btn-sm"
                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
              color: {{ tenantSetting('text_color_1', '#8C2D18') }};
              border: 2px solid {{ tenantSetting('color_tables', '#8C2D18') }};">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>

        {{-- Tabla de Disponibilidad --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center"
                style="background-color: {{ tenantSetting('color_tables', '#8C2D18') }};
                               color: {{ tenantSetting('button_banner_text_color', 'white') }};">
                <h5 class="mb-0">Listado de Bloques Horarios</h5>
                <a href="{{ route('available-slots.create') }}" class="btn btn-sm"
                    style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};
                                   color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                    <i class="bi bi-plus-circle"></i> Nueva Disponibilidad
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: {{ tenantSetting('button_banner_text_color', '#FDF5E5') }};">
                            <tr>
                                <th class="text-center" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                    Fecha</th>
                                <th class="text-center" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                    Horario</th>
                                <th class="text-center" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                    Máx. Reservas</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse ($slots as $slot)
                                <tr>
                                    <td>{{ $slot->date }}</td>
                                    <td>{{ substr($slot->start_time, 0, 5) }} - {{ substr($slot->end_time, 0, 5) }}</td>
                                    <td>{{ $slot->max_bookings }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No has definido horarios aún.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
