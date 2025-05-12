@extends('layouts.app')

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
    <div class="container">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h2 class="h3 mb-0 fw-bold" style="color: #8C2D18;">
                <i class="bi bi-building me-2"></i>{{ __('Configuración de Páginas para ') }} {{ $tenant->name }}
            </h2>
            <a href="{{ route('tenants.index') }}" class="btn btn-sm" style="background-color: #F5E8D0; color: #8C2D18;">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>

        {{-- Formulario --}}
        <div class="card shadow border-0" style="background-color: #FDF5E5;">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('tenants.pages.update', $tenant) }}"
                    class="bg-white p-4 rounded-3 shadow-sm">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <h5 class="fw-medium mb-3" style="color: #8C2D18;">
                            <i class="bi bi-list-check me-2"></i>Configurar y Personalizar Páginas
                        </h5>

                        <div class="d-flex flex-column gap-3">
                            @foreach ($pages as $pageKey => $label)
                                @php
                                    $page = $tenantPages[$pageKey] ?? null;
                                    $isEnabled = $page?->is_enabled ?? false;
                                    $isVisible = $page?->is_visible ?? false;
                                @endphp
                                <div class="p-3 bg-light rounded d-flex flex-column">
                                    <div class="mb-2">
                                        <label for="title-{{ $pageKey }}" class="form-label fw-bold">Nombre de Página
                                            "{{ ucwords($pageKey) }}"</label>
                                        <input type="text" class="form-control" name="titles[{{ $pageKey }}]"
                                            id="title-{{ $pageKey }}" value="{{ $label }}">
                                    </div>
                                    <div class="d-flex flex-row gap-4 align-items-center">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input enabled-toggle" type="checkbox" name="enabled[]"
                                                value="{{ $pageKey }}" id="enabled-{{ $pageKey }}"
                                                data-key="{{ $pageKey }}" {{ $isEnabled ? 'checked' : '' }}>
                                            <label class="form-check-label" for="enabled-{{ $pageKey }}">
                                                Habilitado
                                            </label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input visible-toggle" type="checkbox" name="visible[]"
                                                value="{{ $pageKey }}" id="visible-{{ $pageKey }}"
                                                data-key="{{ $pageKey }}" {{ $isVisible ? 'checked' : '' }}
                                                {{ !$isEnabled ? 'disabled' : '' }}>
                                            <label class="form-check-label" for="visible-{{ $pageKey }}">
                                                Visible en Barra de Navegación
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top text-center">
                        <button type="submit" class="btn fw-medium py-1"
                            style="background-color: #8C2D18; color: white; width: 250px;">
                            <i class="bi bi-save me-2"></i>Guardar Configuración
                        </button>
                    </div>
                </form>
            </div>
        </div>
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const enabledToggles = document.querySelectorAll('.enabled-toggle');

            enabledToggles.forEach(toggle => {
                toggle.addEventListener('change', function() {
                    const key = this.dataset.key;
                    const visibleCheckbox = document.querySelector(`#visible-${key}`);
                    if (this.checked) {
                        visibleCheckbox.disabled = false;
                    } else {
                        visibleCheckbox.disabled = true;
                        visibleCheckbox.checked = false;
                    }
                });
            });
        });
    </script>
@endsection
