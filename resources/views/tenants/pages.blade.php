@extends('layouts.app')

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
    <div class="container">
        {{-- Encabezado mejorado --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h2 class="h3 mb-0 fw-bold" style="color: #8C2D18;">
                <i class="bi bi-shield-lock me-2"></i>{{ __('Permisos para ') }} {{ $tenant->name }}
            </h2>
            <a href="{{ route('tenants.index') }}" class="btn btn-sm" style="background-color: #F5E8D0; color: #8C2D18;">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>

        {{-- Formulario vertical --}}
        <form method="POST" action="{{ route('tenants.pages.update', $tenant) }}"
            class="bg-white p-4 rounded-3 shadow-sm">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <h5 class="fw-medium mb-3" style="color: #8C2D18;">
                    <i class="bi bi-list-check me-2"></i>Seleccione los permisos
                </h5>

                <div class="d-flex flex-column gap-3">
                    @foreach ($pages as $pageKey => $label)
                        @php
                            $page = $tenantPages[$pageKey] ?? null;
                        @endphp
                        <div class="p-3 bg-light rounded d-flex flex-column">
                            <h6 class="fw-bold mb-2">{{ $label }}</h6>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="enabled[]" value="{{ $pageKey }}"
                                    id="enabled-{{ $pageKey }}" {{ $page?->is_enabled ? 'checked' : '' }}>
                                <label class="form-check-label" for="enabled-{{ $pageKey }}">Habilitado</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="visible[]" value="{{ $pageKey }}"
                                    id="visible-{{ $pageKey }}" {{ $page?->is_visible ? 'checked' : '' }}>
                                <label class="form-check-label" for="visible-{{ $pageKey }}">Visible
                                    públicamente</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-4 pt-3 border-top text-center">
                <button type="submit" class="btn fw-medium py-1"
                    style="background-color: #8C2D18; color: white; width: 210px;">
                    <i class="bi bi-save me-2"></i>Guardar páginas
                </button>
            </div>
        </form>
    </div>

    <style>
        /* Estilo personalizado para los switches */
        .form-check-input:checked {
            background-color: #8C2D18;
            border-color: #8C2D18;
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 0.25rem rgba(140, 45, 24, 0.25);
            border-color: #8C2D18;
        }

        .form-switch .form-check-input {
            cursor: pointer;
        }

        .form-check-label {
            cursor: pointer;
            user-select: none;
        }
    </style>
@endsection
