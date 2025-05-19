@extends('tenants.default.layouts.panel')

@section('title', 'Disponibilidad')

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    <div class="container">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h3 class="fw-bold mb-0" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-calendar-event me-2"></i>{{ __('Editar Disponibilidad') }}
            </h3>
            <a href="{{ route('available-slots.index') }}" class="btn btn-sm"
                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                  color: {{ tenantSetting('text_color_1', '#8C2D18') }};
                  border: 2px solid {{ tenantSetting('color_tables', '#8C2D18') }};">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        {{-- Formulario --}}
        <div class="card shadow border-0" style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('available-slots.update', $slot) }}"
                    class="bg-white p-4 rounded-3 shadow-sm">
                    @csrf
                    @method('PUT')

                    <h5 class="fw-medium mb-3"
                        style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};">
                        <i class="bi bi-info-circle me-2"></i>Información de la Disponibilidad
                    </h5>

                    {{-- Fecha --}}
                    <div class="mb-4">
                        <label for="date" class="form-label fw-medium"
                            style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                            <i class="bi bi-calendar-date me-1"></i>Fecha
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"
                                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                <i class="bi bi-calendar3"></i>
                            </span>
                            <input id="date" type="date" class="form-control border-start-0"
                                style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};"
                                name="date" value="{{ old('date', $slot->date) }}" required>
                        </div>
                        @error('date')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div id="slots-container">
                        <div class="slot-row row align-items-end g-2 mb-3">
                            {{-- Hora Inicio --}}
                            <div class="col-md-4">
                                <label for="start-time" class="form-label fw-medium"
                                    style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                    <i class="bi bi-clock me-1"></i>Hora Inicio
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"
                                        style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                        <i class="bi bi-clock-history"></i>
                                    </span>
                                    <input id="start-time" type="time" class="form-control border-start-0"
                                        style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};"
                                        name="slots[0][start-time]"
                                        value="{{ old('slots.0.start-time', $slot->start_time) }}" required>
                                </div>
                                @error('slots[0][start-time]')
                                    <div class="text-danger small mt-2">
                                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Hora Fin --}}
                            <div class="col-md-4">
                                <label for="end-time" class="form-label fw-medium"
                                    style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                    <i class="bi bi-clock-fill me-1"></i>Hora Fin
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"
                                        style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                        <i class="bi bi-clock-history"></i>
                                    </span>
                                    <input id="end-time" type="time" class="form-control border-start-0"
                                        style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};"
                                        name="slots[0][end-time]" value="{{ old('slots.0.end-time', $slot->end_time) }}"
                                        required>
                                </div>
                                @error('slots[0][end-time]')
                                    <div class="text-danger small mt-2">
                                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Máx. Reservas --}}
                            <div class="col-md-3">
                                <label for="max-bookings" class="form-label fw-medium"
                                    style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                    <i class="bi bi-calendar-check me-1"></i>Máx. Reservas
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"
                                        style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                        <i class="bi bi-123"></i>
                                    </span>
                                    <input id="max-bookings" type="number" class="form-control border-start-0"
                                        style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};"
                                        placeholder="Ejemplo: 1" name="slots[0][max-bookings]"
                                        value="{{ old('slots.0.max-bookings', $slot->max_bookings) }}" min="1"
                                        required>
                                </div>
                                @error('slots[0][max-bookings]')
                                    <div class="text-danger small mt-2">
                                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger btn-sm remove-slot d-none"
                                    style="background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }}; color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }};">✖</button>
                            </div>
                        </div>
                    </div>

                    {{-- Botón de Guardar --}}
                    <div class="mt-4 pt-3 border-top text-center">
                        <button type="submit" class="btn fw-medium py-1"
                            style="background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }}; color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }}; width: 250px;">
                            <i class="bi bi-save me-2"></i>Guardar Disponibilidad
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
