@extends('layouts.app')

@section('title', 'Configurar Páginas de ' . $tenant->name . ' - ' . config('app.name', 'Laravel'))

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h3 class="fw-bold mb-0" style="color: #8C2D18;">
                <i class="bi bi-building-gear me-2"></i>{{ __('Configurar Páginas para ') }} {{ $tenant->name }}
            </h3>
            <a href="{{ route('tenants.index') }}" class="btn btn-sm" style="background-color: #F5E8D0; color: #8C2D18;">
                <i class="bi bi-arrow-left me-2"></i>Volver
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
                            <i class="bi bi-list-check me-2"></i>Gestionar Páginas
                        </h5>
                        <div class="sortable-pages mb-4" id="sortable-all">
                            @foreach ($pages as $pageKey => $label)
                                @php
                                    $page = $tenantPages[$pageKey] ?? null;
                                    $isEnabled = $page?->is_enabled ?? false;
                                    $isVisible = $page?->is_visible ?? false;
                                    $agendaEnabled = $tenantPages['agenda']->is_enabled ?? false;
                                    // Buscar la categoría del pageKey
                                    $category = collect($pagesByCategory)->filter(fn($arr) => in_array($pageKey, $arr))->keys()->first();
                                @endphp

                                <div class="accordion mb-2 page-item" data-key="{{ $pageKey }}" style="cursor:move;">
                                    <input type="hidden" name="orders[{{ $pageKey }}]" value="{{ $page->order ?? 0 }}" class="order-input">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading-{{ $pageKey }}">
                                            <button class="accordion-button collapsed fw-semibold" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse-{{ $pageKey }}"
                                                aria-expanded="false" aria-controls="collapse-{{ $pageKey }}">
                                                {{ $label }} (<i>{{ $pageKey }}</i>)
                                                @if($category)
                                                    <span class="badge bg-secondary ms-2">{{ $category }}</span>
                                                @endif
                                            </button>
                                        </h2>
                                        <div id="collapse-{{ $pageKey }}" class="accordion-collapse collapse"
                                            aria-labelledby="heading-{{ $pageKey }}" data-bs-parent="#accordionPages">
                                            <div class="accordion-body">
                                                <div class="mb-3">
                                                    <label for="title-{{ $pageKey }}" class="form-label fw-bold">
                                                        Nombre Personalizado
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        name="titles[{{ $pageKey }}]" id="title-{{ $pageKey }}"
                                                        value="{{ $label }}"
                                                        placeholder="Escribe un nombre personalizado para esta página">
                                                </div>
                                                <div class="d-flex flex-row gap-4 align-items-center">
                                                    <div class="form-check form-switch">
                                                        @if ($pageKey == 'login')
                                                            <input type="hidden" name="enabled[]" value="{{ $pageKey }}">
                                                            <input class="form-check-input enabled-toggle" type="checkbox"
                                                                value="{{ $pageKey }}"
                                                                id="enabled-{{ $pageKey }}"
                                                                data-key="{{ $pageKey }}"
                                                                {{ $isEnabled ? 'checked' : '' }} disabled>
                                                            <label class="form-check-label" for="enabled-{{ $pageKey }}">
                                                                Habilitado
                                                            </label>
                                                        @elseif ($pageKey == 'questionnaire' && !$agendaEnabled)
                                                            <input class="form-check-input enabled-toggle" type="checkbox"
                                                                name="enabled[]" value="{{ $pageKey }}"
                                                                id="enabled-{{ $pageKey }}"
                                                                data-key="{{ $pageKey }}"
                                                                {{ $isEnabled ? 'checked' : '' }} disabled>
                                                            <label class="form-check-label" for="enabled-{{ $pageKey }}">
                                                                Habilitado
                                                            </label>
                                                            <div class="text-muted small mt-1 ms-1">
                                                                Debes habilitar primero la página <strong>Agenda</strong>.
                                                            </div>
                                                        @else
                                                            <input class="form-check-input enabled-toggle" type="checkbox"
                                                                name="enabled[]" value="{{ $pageKey }}"
                                                                id="enabled-{{ $pageKey }}"
                                                                data-key="{{ $pageKey }}"
                                                                {{ $isEnabled ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="enabled-{{ $pageKey }}">
                                                                Habilitado
                                                            </label>
                                                        @endif
                                                    </div>
                                                    @if ($pageKey != 'forgot-password' && $pageKey != 'questionnaire')
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input visible-toggle" type="checkbox"
                                                                name="visible[]" value="{{ $pageKey }}"
                                                                id="visible-{{ $pageKey }}"
                                                                data-key="{{ $pageKey }}"
                                                                {{ $isVisible ? 'checked' : '' }}
                                                                {{ !$isEnabled ? 'disabled' : '' }}>
                                                            <label class="form-check-label" for="visible-{{ $pageKey }}">
                                                                Visible en Barra de Navegación
                                                            </label>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
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

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const list = document.getElementById('sortable-all');
            new Sortable(list, {
                animation: 150,
                onEnd: function () {
                    list.querySelectorAll('.page-item').forEach(function(item, idx) {
                        item.querySelector('.order-input').value = idx;
                    });
                }
            });

            list.querySelectorAll('.page-item').forEach(function(item, idx) {
                item.querySelector('.order-input').value = idx;
            });

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

    <style>
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
