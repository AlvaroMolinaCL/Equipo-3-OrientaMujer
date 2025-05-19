@extends('tenants.default.layouts.panel')

@section('title', 'Dashboard')

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    @php
        $presetStyles = [
            'clásico' => [
                'label' => 'Clásico',
                'background_color_1' => '#f8f9fa',
                'background_color_2' => '#e9ecef',
                'text_color_1' => '#212529',
                'text_color_2' => '#495057',
                'navbar_color_1' => '#343a40',
                'navbar_color_2' => '#343a40',
                'navbar_text_color_1' => '#ffffff',
                'navbar_text_color_2' => '#ffffff',
                'button_color_sidebar' => '#6c757d',
                'color_metrics' => '#495057',
                'color_tables' => '#343a40',
            ],
            'notarial' => [
                'label' => 'Notarial',
                'background_color_1' => '#fefcf9',
                'background_color_2' => '#f5f2ec',
                'text_color_1' => '#3e3e3e',
                'text_color_2' => '#5c5c5c',
                'navbar_color_1' => '#8c2d18',
                'navbar_color_2' => '#8c2d18',
                'navbar_text_color_1' => '#ffffff',
                'navbar_text_color_2' => '#ffffff',
                'button_color_sidebar' => '#BF8A49',
                'color_metrics' => '#8C2D18',
                'color_tables' => '#5f1e10',
            ],
            'corporativo' => [
                'label' => 'Corporativo',
                'background_color_1' => '#edf2f7',
                'background_color_2' => '#e2e8f0',
                'text_color_1' => '#1a202c',
                'text_color_2' => '#2d3748',
                'navbar_color_1' => '#2c5282',
                'navbar_color_2' => '#2c5282',
                'navbar_text_color_1' => '#ffffff',
                'navbar_text_color_2' => '#ffffff',
                'button_color_sidebar' => '#2b6cb0',
                'color_metrics' => '#2c5282',
                'color_tables' => '#1a365d',
            ],
            'jurídico azul' => [
                'label' => 'Jurídico Azul',
                'background_color_1' => '#f1f5f9',
                'background_color_2' => '#dbeafe',
                'text_color_1' => '#1e3a8a',
                'text_color_2' => '#1e40af',
                'navbar_color_1' => '#1e3a8a',
                'navbar_color_2' => '#1e3a8a',
                'navbar_text_color_1' => '#ffffff',
                'navbar_text_color_2' => '#ffffff',
                'button_color_sidebar' => '#1e40af',
                'color_metrics' => '#1e3a8a',
                'color_tables' => '#1c2f75',
            ],
            'moderno' => [
                'label' => 'Moderno',
                'background_color_1' => '#ffffff',
                'background_color_2' => '#f0f0f0',
                'text_color_1' => '#111827',
                'text_color_2' => '#374151',
                'navbar_color_1' => '#111827',
                'navbar_color_2' => '#111827',
                'navbar_text_color_1' => '#f3f4f6',
                'navbar_text_color_2' => '#f3f4f6',
                'button_color_sidebar' => '#374151',
                'color_metrics' => '#1f2937',
                'color_tables' => '#111827',
            ],
            'elegante' => [
                'label' => 'Elegante',
                'background_color_1' => '#f6f5f3',
                'background_color_2' => '#e0dad1',
                'text_color_1' => '#2b2b2b',
                'text_color_2' => '#4b4b4b',
                'navbar_color_1' => '#5c4033',
                'navbar_color_2' => '#5c4033',
                'navbar_text_color_1' => '#ffffff',
                'navbar_text_color_2' => '#ffffff',
                'button_color_sidebar' => '#5c4033',
                'color_metrics' => '#3e2c22',
                'color_tables' => '#2b1d17',
            ],
        ];
    @endphp
    <div class="d-flex justify-content-between align-items-center mb-1">
        <h3 class="fw-bold mb-0" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
            <i class="bi bi-palette me-2"></i>{{ __('Editar Apariencia') }}
        </h3>
        <a href="{{ route('dashboard') }}" class="btn btn-sm"
            style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
              color: {{ tenantSetting('text_color_1', '#8C2D18') }};
              border: 2px solid {{ tenantSetting('color_tables', '#8C2D18') }};">
            <i class="bi bi-arrow-left me-2"></i>Volver
        </a>
    </div>
    <div class="container-fluid py-4">
        <div class="card shadow-sm">
            <div class="card-body">
                {{-- Sección de Paletas Predefinidas --}}
                <div class="mb-5">
                    <h3 class="h5 mb-3 border-bottom pb-2"><i class="bi bi-palette-fill me-2"></i>Paletas de Colores
                        Predefinidas</h3>
                    <p class="text-muted mb-4">Selecciona una de nuestras paletas preconfiguradas o personaliza manualmente
                        más abajo</p>

                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-4" id="palettes-container">
                        @foreach ($presetStyles as $key => $palette)
                            <div class="col">
                                <div class="palette-card card h-100 border-0 shadow-sm hover-shadow transition-all"
                                    style="cursor: pointer;" data-key="{{ $key }}"
                                    data-palette='@json($palette)'
                                    title="Seleccionar paleta {{ $palette['label'] }}">
                                    <div class="card-header py-2"
                                        style="background-color: {{ $palette['navbar_color_1'] }}; color: {{ $palette['navbar_text_color_1'] }};">
                                        <h5 class="mb-0 text-center">{{ $palette['label'] }}</h5>
                                    </div>
                                    <div class="card-body p-3"
                                        style="background-color: {{ $palette['background_color_1'] }}; color: {{ $palette['text_color_1'] }};">
                                        <div class="d-flex flex-wrap gap-1 mb-2">
                                            @foreach (['navbar_color_1', 'button_color_sidebar', 'color_metrics', 'color_tables'] as $colorKey)
                                                <div style="width: 40px; height: 40px; background-color: {{ $palette[$colorKey] }}; border: 1px solid rgba(0,0,0,0.1); border-radius: 4px;"
                                                    class="shadow-sm"
                                                    title="{{ $colorKey }}: {{ $palette[$colorKey] }}"></div>
                                            @endforeach
                                        </div>
                                        <div class="d-flex justify-content-between small">
                                            <span>Texto: <span
                                                    style="color: {{ $palette['text_color_1'] }}">Aa</span></span>
                                            <span>Fondo: <span class="badge"
                                                    style="background-color: {{ $palette['background_color_1'] }}; color: {{ $palette['text_color_1'] }}">Ejemplo</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center">
                        <button id="savePaletteBtn" class="btn"
                            style="background-color: {{ tenantSetting('button_color_sidebar', '#F5E8D0') }}; 
                                       color: {{ tenantSetting('button_banner_text_color', 'white') }};
                                       transition: all 0.3s ease;">
                            <i class="fas fa-save me-2"></i>Aplicar Paleta Seleccionada
                        </button>
                    </div>
                </div>

                {{-- Sección de Personalización Avanzada --}}
                <div class="mt-5 pt-4 border-top">
                    <h3 class="h5 mb-3 border-bottom pb-2"><i class="bi bi-sliders me-2"></i>Personalización Avanzada</h3>
                    <p class="text-muted mb-4">Ajusta cada aspecto de tu diseño manualmente</p>

                    <form id="customizationForm" enctype="multipart/form-data">
                        @csrf

                        {{-- Logos --}}
                        <div class="mb-4">
                            <h4 class="h6 mb-3"><i class="bi bi-images me-2"></i>Logos</h4>

                            <div class="row g-3">
                                {{-- Logo Principal --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Logo Principal Actual</label>
                                    @if ($tenant->logo_path_1)
                                        <div class="text-center mb-2">
                                            <img src="{{ $tenant->logo_path_1 }}" alt="Logo Principal"
                                                class="img-fluid rounded border"
                                                style="max-height: 80px; background-color: {{ $tenant->background_color_1 }};">
                                        </div>
                                    @else
                                        <p class="text-muted">No hay logo principal cargado</p>
                                    @endif

                                    <label for="logo_1" class="form-label">Actualizar Logo Principal</label>
                                    <input type="file" class="form-control" id="logo_1" name="logo_1"
                                        accept="image/*">
                                </div>

                                {{-- Logo Secundario --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Logo Secundario Actual</label>
                                    @if ($tenant->logo_path_2)
                                        <div class="text-center mb-2">
                                            <img src="{{ $tenant->logo_path_2 }}" alt="Logo Secundario"
                                                class="img-fluid rounded border"
                                                style="max-height: 80px; background-color: {{ $tenant->background_color_2 }};">
                                        </div>
                                    @else
                                        <p class="text-muted">No hay logo secundario cargado</p>
                                    @endif

                                    <label for="logo_2" class="form-label">Actualizar Logo Secundario</label>
                                    <input type="file" class="form-control" id="logo_2" name="logo_2"
                                        accept="image/*">
                                </div>
                            </div>
                        </div>

                        {{-- Colores --}}
                        <div class="mb-4">
                            <h4 class="h6 mb-3"><i class="bi bi-palette me-2"></i>Colores</h4>

                            <div class="row g-3">
                                {{-- Fondo 1 --}}
                                <div class="col-md-6 col-lg-4">
                                    <label for="background_color_1" class="form-label">Fondo Principal</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-droplet"></i></span>
                                        <input type="color" class="form-control form-control-color"
                                            id="background_color_1" name="background_color_1"
                                            value="{{ old('background_color_1', $tenant->background_color_1) }}">
                                    </div>
                                </div>

                                {{-- Texto 1 --}}
                                <div class="col-md-6 col-lg-4">
                                    <label for="text_color_1" class="form-label">Texto Principal</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-fonts"></i></span>
                                        <input type="color" class="form-control form-control-color" id="text_color_1"
                                            name="text_color_1" value="{{ old('text_color_1', $tenant->text_color_1) }}">
                                    </div>
                                </div>

                                {{-- Fondo 2 --}}
                                <div class="col-md-6 col-lg-4">
                                    <label for="background_color_2" class="form-label">Fondo Secundario</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-droplet"></i></span>
                                        <input type="color" class="form-control form-control-color"
                                            id="background_color_2" name="background_color_2"
                                            value="{{ old('background_color_2', $tenant->background_color_2) }}">
                                    </div>
                                </div>

                                {{-- Texto 2 --}}
                                <div class="col-md-6 col-lg-4">
                                    <label for="text_color_2" class="form-label">Texto Secundario</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-fonts"></i></span>
                                        <input type="color" class="form-control form-control-color" id="text_color_2"
                                            name="text_color_2" value="{{ old('text_color_2', $tenant->text_color_2) }}">
                                    </div>
                                </div>

                                {{-- Navbar --}}
                                <div class="col-md-6 col-lg-4">
                                    <label for="navbar_color_1" class="form-label">Color de Navbar</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-border-width"></i></span>
                                        <input type="color" class="form-control form-control-color" id="navbar_color_1"
                                            name="navbar_color_1"
                                            value="{{ old('navbar_color_1', $tenant->navbar_color_1) }}">
                                    </div>
                                </div>

                                {{-- Texto Navbar --}}
                                <div class="col-md-6 col-lg-4">
                                    <label for="navbar_text_color_1" class="form-label">Texto de Navbar</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-type"></i></span>
                                        <input type="color" class="form-control form-control-color"
                                            id="navbar_text_color_1" name="navbar_text_color_1"
                                            value="{{ old('navbar_text_color_1', $tenant->navbar_text_color_1) }}">
                                    </div>
                                </div>
                                {{-- Botón Sidebar --}}
                                <div class="col-md-6 col-lg-4">
                                    <label for="button_color_sidebar" class="form-label">Botón Sidebar</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-toggle-on"></i></span>
                                        <input type="color" class="form-control form-control-color"
                                            id="button_color_sidebar" name="button_color_sidebar"
                                            value="{{ old('button_color_sidebar', $tenant->button_color_sidebar) }}">
                                    </div>
                                </div>

                                {{-- Color Métricas --}}
                                <div class="col-md-6 col-lg-4">
                                    <label for="color_metrics" class="form-label">Color Métricas</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-toggle-on"></i></span>
                                        <input type="color" class="form-control form-control-color" id="color_metrics"
                                            name="color_metrics"
                                            value="{{ old('color_metrics', $tenant->color_metrics) }}">
                                    </div>
                                </div>

                                {{-- Color Tablas --}}
                                <div class="col-md-6 col-lg-4">
                                    <label for="color_tables" class="form-label">Color Tablas</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-toggle-on"></i></span>
                                        <input type="color" class="form-control form-control-color" id="color_tables"
                                            name="color_tables" value="{{ old('color_tables', $tenant->color_tables) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tipografías --}}
                        <div class="mb-4">
                            <h4 class="h6 mb-3"><i class="bi bi-fonts me-2"></i>Tipografías</h4>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="navbar_font" class="form-label">Navbar</label>
                                    <select class="form-select" id="navbar_font" name="navbar_font">
                                        <option value="Arial" {{ $tenant->navbar_font == 'Arial' ? 'selected' : '' }}>
                                            Arial</option>
                                        <option value="Roboto" {{ $tenant->navbar_font == 'Roboto' ? 'selected' : '' }}>
                                            Roboto</option>
                                        <option value="Open Sans"
                                            {{ $tenant->navbar_font == 'Open Sans' ? 'selected' : '' }}>Open Sans</option>
                                        <option value="Montserrat"
                                            {{ $tenant->navbar_font == 'Montserrat' ? 'selected' : '' }}>Montserrat
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="heading_font" class="form-label">Títulos</label>
                                    <select class="form-select" id="heading_font" name="heading_font">
                                        <option value="Arial" {{ $tenant->heading_font == 'Arial' ? 'selected' : '' }}>
                                            Arial</option>
                                        <option value="Roboto" {{ $tenant->heading_font == 'Roboto' ? 'selected' : '' }}>
                                            Roboto</option>
                                        <option value="Open Sans"
                                            {{ $tenant->heading_font == 'Open Sans' ? 'selected' : '' }}>Open Sans</option>
                                        <option value="Montserrat"
                                            {{ $tenant->heading_font == 'Montserrat' ? 'selected' : '' }}>Montserrat
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="body_font" class="form-label">Cuerpo</label>
                                    <select class="form-select" id="body_font" name="body_font">
                                        <option value="Arial" {{ $tenant->body_font == 'Arial' ? 'selected' : '' }}>Arial
                                        </option>
                                        <option value="Roboto" {{ $tenant->body_font == 'Roboto' ? 'selected' : '' }}>
                                            Roboto</option>
                                        <option value="Open Sans"
                                            {{ $tenant->body_font == 'Open Sans' ? 'selected' : '' }}>Open Sans</option>
                                        <option value="Montserrat"
                                            {{ $tenant->body_font == 'Montserrat' ? 'selected' : '' }}>Montserrat</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn"
                                style="background-color: {{ tenantSetting('button_color_sidebar', '#F5E8D0') }}; 
                                       color: {{ tenantSetting('button_banner_text_color', 'white') }};
                                       transition: all 0.3s ease;">
                                <i class="fas fa-save me-2"></i>Guardar Personalización
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .palette-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .palette-card:hover {
            transform: translateY(-5px);
        }

        .palette-card.selected {
            border: 2px solid var(--bs-primary) !important;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.25) !important;
        }

        .form-control-color {
            height: 2.5rem;
            width: 100%;
        }

        .border-section {
            border-top: 1px solid #dee2e6;
            padding-top: 2rem;
            margin-top: 2rem;
        }

        @media (max-width: 768px) {
            .palette-card .card-body {
                padding: 1rem !important;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Manejo de paletas de colores
            const palettesContainer = document.getElementById('palettes-container');
            const saveBtn = document.getElementById('savePaletteBtn');
            let selectedPaletteKey = null;
            let selectedPaletteData = null;

            function clearSelection() {
                document.querySelectorAll('.palette-card').forEach(card => {
                    card.classList.remove('selected');
                });
            }

            palettesContainer.addEventListener('click', (e) => {
                let card = e.target.closest('.palette-card');
                if (!card) return;

                clearSelection();
                card.classList.add('selected');

                selectedPaletteKey = card.getAttribute('data-key');
                try {
                    selectedPaletteData = JSON.parse(card.getAttribute('data-palette'));
                    console.log('Paleta seleccionada:', selectedPaletteData);

                    // Actualizar el botón con los colores de la paleta seleccionada
                    saveBtn.style.backgroundColor = selectedPaletteData.button_color_sidebar;
                    saveBtn.style.color = selectedPaletteData.navbar_text_color_1;

                    // Actualizar los campos de personalización
                    updateCustomizationForm(selectedPaletteData);
                } catch (error) {
                    console.error('Error al parsear JSON:', error);
                    showAlert('error', 'Error al seleccionar la paleta');
                }
            });

            function updateCustomizationForm(palette) {
                document.getElementById('background_color_1').value = palette.background_color_1;
                document.getElementById('text_color_1').value = palette.text_color_1;
                document.getElementById('background_color_2').value = palette.background_color_2;
                document.getElementById('text_color_2').value = palette.text_color_2;
                document.getElementById('navbar_color_1').value = palette.navbar_color_1;
                document.getElementById('navbar_text_color_1').value = palette.navbar_text_color_1;
                document.getElementById('button_color_sidebar').value = palette.button_color_sidebar;
                document.getElementById('color_metrics').value = palette.color_metrics;
                document.getElementById('color_tables').value = palette.color_tables;
            }

            function showAlert(type, message) {
                const alertBox = document.createElement('div');
                alertBox.className =
                    `alert alert-${type} alert-dismissible fade show position-fixed top-0 end-0 m-3`;
                alertBox.style.zIndex = '9999';
                alertBox.innerHTML = `
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                document.body.appendChild(alertBox);

                setTimeout(() => {
                    alertBox.classList.remove('show');
                    setTimeout(() => alertBox.remove(), 150);
                }, 5000);
            }

            async function savePalette() {
                if (!selectedPaletteData) {
                    showAlert('warning', 'Por favor selecciona una paleta primero');
                    return false;
                }

                const paletteToSend = {
                    ...selectedPaletteData
                };
                delete paletteToSend.label;

                try {
                    const response = await fetch("{{ route('appearance.update') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json",
                            "X-Requested-With": "XMLHttpRequest"
                        },
                        body: JSON.stringify(paletteToSend)
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.message || 'Error en la respuesta del servidor');
                    }

                    if (data.success || data.status === "success") {
                        showAlert('success', 'Paleta guardada correctamente');
                        return true;
                    } else {
                        throw new Error(data.message || 'Error al procesar la respuesta');
                    }
                } catch (error) {
                    console.error('Error al guardar:', error);
                    showAlert('danger', `Error al guardar: ${error.message}`);
                    return false;
                }
            }

            saveBtn.addEventListener('click', async () => {
                saveBtn.disabled = true;
                saveBtn.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Guardando...';

                const saved = await savePalette();

                saveBtn.disabled = false;
                saveBtn.innerHTML = '<i class="fas fa-save me-2"></i>Aplicar Paleta Seleccionada';

                if (saved) {
                    setTimeout(() => location.reload(), 1500);
                }
            });

            // Manejo del formulario de personalización
            const customizationForm = document.getElementById('customizationForm');

            customizationForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.disabled = true;
                submitBtn.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Guardando...';

                try {
                    const formData = new FormData(this);

                    const response = await fetch("{{ route('appearance.update') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json",
                            "X-Requested-With": "XMLHttpRequest"
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.message || 'Error en la respuesta del servidor');
                    }

                    if (data.success || data.status === "success") {
                        showAlert('success', 'Personalización guardada correctamente');
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        throw new Error(data.message || 'Error al procesar la respuesta');
                    }
                } catch (error) {
                    console.error('Error al guardar:', error);
                    showAlert('danger', `Error al guardar: ${error.message}`);
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-save me-2"></i>Guardar Personalización';
                }
            });
        });
    </script>
@endsection
