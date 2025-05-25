@extends('tenants.default.layouts.panel')

@section('title', 'Editar Apariencia - ' . tenantSetting('name', 'Tenant'))

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
                <div class="accordion" id="mainAccordion">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsePalettes" aria-expanded="true" aria-controls="collapsePalettes">
                            <i class="bi bi-palette-fill me-2"></i>Paletas de Colores Predefinidas
                        </button>
                    </h2>
                    <div id="collapsePalettes" class="accordion-collapse collapse show" data-bs-parent="#mainAccordion">
                        <div class="accordion-body">
                            <p class="text-muted mb-4">Selecciona una de nuestras paletas preconfiguradas o personaliza
                                manualmente más abajo.</p>

                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-4" id="palettes-container">

                                @foreach ($presetStyles as $key => $palette)
                                    <div class="col">
                                        <div class="palette-card card h-100 border-0 shadow-sm hover-shadow transition-all"
                                            style="cursor: pointer;" data-key="{{ $key }}" data-palette='@json($palette)'
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
                                                            class="shadow-sm" title="{{ $colorKey }}: {{ $palette[$colorKey] }}">
                                                        </div>
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
                    </div>
                    {{-- Sección de Personalización Avanzada --}}
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseAdvanced" aria-expanded="false" aria-controls="collapseAdvanced">
                                <i class="bi bi-sliders me-2"></i>Personalización Avanzada
                            </button>
                        </h2>
                        <div id="collapseAdvanced" class="accordion-collapse collapse" data-bs-parent="#mainAccordion">
                            <div class="accordion-body">
                                <p class="text-muted mb-4">Ajusta cada aspecto de tu diseño manualmente.</p>

                                <form id="customizationForm" enctype="multipart/form-data">
                                    @csrf

                                    {{-- Dropdown para Logos --}}
                                    <div class="accordion mb-3" id="accordionLogos">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseLogos" aria-expanded="true"
                                                    aria-controls="collapseLogos">
                                                    <i class="bi bi-images me-2"></i> Configuración de Logos
                                                </button>
                                            </h2>
                                            <div id="collapseLogos" class="accordion-collapse collapse show"
                                                data-bs-parent="#accordionLogos">
                                                <div class="accordion-body">
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

                                                            <label for="logo_1" class="form-label">Actualizar Logo
                                                                Principal</label>
                                                            <input type="file" class="form-control" id="logo_1"
                                                                name="logo_1" accept="image/*">
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

                                                            <label for="logo_2" class="form-label">Actualizar Logo
                                                                Secundario</label>
                                                            <input type="file" class="form-control" id="logo_2"
                                                                name="logo_2" accept="image/*">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Dropdown para Colores --}}
                                    <div class="accordion mb-3" id="accordionColors">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseColors"
                                                    aria-expanded="false" aria-controls="collapseColors">
                                                    <i class="bi bi-palette me-2"></i> Configuración de Colores
                                                </button>
                                            </h2>
                                            <div id="collapseColors" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionColors">
                                                <div class="accordion-body">
                                                    <div class="row g-3">
                                                        {{-- Fondo 1 --}}
                                                        <div class="col-md-6 col-lg-4">
                                                            <label for="background_color_1" class="form-label">Fondo
                                                                Principal</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="bi bi-droplet"></i></span>
                                                                <input type="color" class="form-control form-control-color"
                                                                    id="background_color_1" name="background_color_1"
                                                                    value="{{ old('background_color_1', $tenant->background_color_1) }}">
                                                            </div>
                                                        </div>

                                                        {{-- Texto 1 --}}
                                                        <div class="col-md-6 col-lg-4">
                                                            <label for="text_color_1" class="form-label">Texto
                                                                Principal</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="bi bi-fonts"></i></span>
                                                                <input type="color" class="form-control form-control-color"
                                                                    id="text_color_1" name="text_color_1"
                                                                    value="{{ old('text_color_1', $tenant->text_color_1) }}">
                                                            </div>
                                                        </div>

                                                        {{-- Fondo 2 --}}
                                                        <div class="col-md-6 col-lg-4">
                                                            <label for="background_color_2" class="form-label">Fondo
                                                                Secundario</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="bi bi-droplet"></i></span>
                                                                <input type="color" class="form-control form-control-color"
                                                                    id="background_color_2" name="background_color_2"
                                                                    value="{{ old('background_color_2', $tenant->background_color_2) }}">
                                                            </div>
                                                        </div>

                                                        {{-- Texto 2 --}}
                                                        <div class="col-md-6 col-lg-4">
                                                            <label for="text_color_2" class="form-label">Texto
                                                                Secundario</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="bi bi-fonts"></i></span>
                                                                <input type="color" class="form-control form-control-color"
                                                                    id="text_color_2" name="text_color_2"
                                                                    value="{{ old('text_color_2', $tenant->text_color_2) }}">
                                                            </div>
                                                        </div>

                                                        {{-- Navbar --}}
                                                        <div class="col-md-6 col-lg-4">
                                                            <label for="navbar_color_1" class="form-label">Color de
                                                                Navbar</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="bi bi-border-width"></i></span>
                                                                <input type="color" class="form-control form-control-color"
                                                                    id="navbar_color_1" name="navbar_color_1"
                                                                    value="{{ old('navbar_color_1', $tenant->navbar_color_1) }}">
                                                            </div>
                                                        </div>

                                                        {{-- Texto Navbar --}}
                                                        <div class="col-md-6 col-lg-4">
                                                            <label for="navbar_text_color_1" class="form-label">Texto de
                                                                Navbar</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="bi bi-type"></i></span>
                                                                <input type="color" class="form-control form-control-color"
                                                                    id="navbar_text_color_1" name="navbar_text_color_1"
                                                                    value="{{ old('navbar_text_color_1', $tenant->navbar_text_color_1) }}">
                                                            </div>
                                                        </div>
                                                        {{-- Botón Sidebar --}}
                                                        <div class="col-md-6 col-lg-4">
                                                            <label for="button_color_sidebar" class="form-label">Botón
                                                                Sidebar</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="bi bi-toggle-on"></i></span>
                                                                <input type="color" class="form-control form-control-color"
                                                                    id="button_color_sidebar" name="button_color_sidebar"
                                                                    value="{{ old('button_color_sidebar', $tenant->button_color_sidebar) }}">
                                                            </div>
                                                        </div>

                                                        {{-- Color Métricas --}}
                                                        <div class="col-md-6 col-lg-4">
                                                            <label for="color_metrics" class="form-label">Color
                                                                Métricas</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="bi bi-toggle-on"></i></span>
                                                                <input type="color" class="form-control form-control-color"
                                                                    id="color_metrics" name="color_metrics"
                                                                    value="{{ old('color_metrics', $tenant->color_metrics) }}">
                                                            </div>
                                                        </div>

                                                        {{-- Color Tablas --}}
                                                        <div class="col-md-6 col-lg-4">
                                                            <label for="color_tables" class="form-label">Color
                                                                Tablas</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="bi bi-toggle-on"></i></span>
                                                                <input type="color" class="form-control form-control-color"
                                                                    id="color_tables" name="color_tables"
                                                                    value="{{ old('color_tables', $tenant->color_tables) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Dropdown para Tipografías --}}
                                    <div class="accordion mb-3" id="accordionFonts">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseFonts"
                                                    aria-expanded="false" aria-controls="collapseFonts">
                                                    <i class="bi bi-fonts me-2"></i> Configuración de Tipografías
                                                </button>
                                            </h2>
                                            <div id="collapseFonts" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionFonts">
                                                <div class="accordion-body">
                                                    <div class="row g-3">
                                                        <div class="col-md-4">
                                                            <label for="navbar_font" class="form-label">Navbar</label>
                                                            <select class="form-select" id="navbar_font" name="navbar_font">
                                                                <option value="Arial" {{ $tenant->navbar_font == 'Arial' ? 'selected' : '' }}>
                                                                    Arial</option>
                                                                <option value="Roboto" {{ $tenant->navbar_font == 'Roboto' ? 'selected' : '' }}>
                                                                    Roboto</option>
                                                                <option value="Open Sans" {{ $tenant->navbar_font == 'Open Sans' ? 'selected' : '' }}>Open Sans</option>
                                                                <option value="Montserrat" {{ $tenant->navbar_font == 'Montserrat' ? 'selected' : '' }}>
                                                                    Montserrat
                                                                </option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="heading_font" class="form-label">Títulos</label>
                                                            <select class="form-select" id="heading_font"
                                                                name="heading_font">
                                                                <option value="Arial" {{ $tenant->heading_font == 'Arial' ? 'selected' : '' }}>
                                                                    Arial</option>
                                                                <option value="Roboto" {{ $tenant->heading_font == 'Roboto' ? 'selected' : '' }}>
                                                                    Roboto</option>
                                                                <option value="Open Sans" {{ $tenant->heading_font == 'Open Sans' ? 'selected' : '' }}>Open Sans</option>
                                                                <option value="Montserrat" {{ $tenant->heading_font == 'Montserrat' ? 'selected' : '' }}>
                                                                    Montserrat
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
                                                                <option value="Open Sans" {{ $tenant->body_font == 'Open Sans' ? 'selected' : '' }}>Open Sans</option>
                                                                <option value="Montserrat" {{ $tenant->body_font == 'Montserrat' ? 'selected' : '' }}>
                                                                    Montserrat</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
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

                    {{-- Sección de Textos Personalizados --}}
                    {{-- Sección de Textos Personalizados --}}
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTexts" aria-expanded="false" aria-controls="collapseTexts">
                                <i class="bi bi-text-paragraph me-2"></i>Textos Personalizados
                            </button>
                        </h2>
                        <div id="collapseTexts" class="accordion-collapse collapse" data-bs-parent="#mainAccordion">
                            <div class="accordion-body">
                                <form method="POST" action="{{ route('tenant.texts.update') }}" class="mt-3">
                                    @csrf
                                    @method('PUT')

                                    <h4 class="h6 mb-3"><i class="bi bi-card-heading me-2"></i>Textos Principales</h4>

                                    <!-- Nav Tabs -->
                                    <ul class="nav nav-tabs mb-4" id="homeTextsTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="inicio-tab" data-bs-toggle="tab"
                                                data-bs-target="#inicio" type="button" role="tab">Inicio</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="servicios-tab" data-bs-toggle="tab"
                                                data-bs-target="#servicios" type="button" role="tab">Servicios</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="contacto-tab" data-bs-toggle="tab"
                                                data-bs-target="#contacto" type="button" role="tab">Contacto</button>
                                        </li>
                                    </ul>

                                    <!-- Tab Content -->
                                    <div class="tab-content" id="homeTextsTabContent">

                                        <!-- INICIO -->
                                        <div class="tab-pane fade show active" id="inicio" role="tabpanel">
                                            <!-- Slogan -->
                                            <div class="mb-3">
                                                <label for="slogan_text" class="form-label"><strong>Slogan</strong></label>
                                                <textarea class="form-control summernote" name="slogan_text"
                                                    id="slogan_text" rows="2"
                                                    placeholder="Ej: Innovación y calidad">{!! old('slogan_text', tenantText('slogan_text', 'La información es poder, <strong>¡empodérate!</strong>')) !!}</textarea>
                                            </div>

                                            <!-- Cuerpo del slogan -->
                                            <div class="mb-3">
                                                <label for="slogan_body" class="form-label"><strong>Cuerpo del
                                                        slogan</strong></label>
                                                <textarea class="form-control summernote" name="slogan_body"
                                                    id="slogan_body" rows="2"
                                                    placeholder="Ej: Más de 20 años brindando soluciones">{{ old('slogan_body', tenantText('slogan_body', 'Una representación judicial con perspectiva de género, exige un acompañamiento empático e informado para alivianar las cargas del proceso.')) }}</textarea>
                                            </div>

                                            <!-- Sobre Nosotros -->
                                            <div class="mb-3">
                                                <label for="about_text" class="form-label"><strong>Sobre
                                                        Nosotros</strong></label>
                                                <textarea class="form-control summernote" name="about_text" id="about_text"
                                                    rows="6" placeholder="Escribe tu contenido aquí...">{{ old('about_text', tenantText('about_text', '
                                <p style="text-align: justify;">
                                    Soy Omara Muñoz Navarro, abogada especializada en derecho penal, derecho de familia, derechos humanos y litigación con perspectiva de género.
                                </p>
                                <p style="text-align: justify;">
                                    Mi propósito es acompañarte en procesos legales complejos, entregándote herramientas claras, asesoría accesible y representación comprometida.
                                </p>
                                <p style="text-align: justify;">
                                    Conozco el sistema desde adentro, a lo largo de mi desarrollo académico y profesional me desempeñé en las distintas instituciones que componen nuestro sistema judicial. Saber cómo desarrollan su quehacer Tribunales de Justicia; Ministerio Público; Defensoría Penal Pública; programas de apoyo a mujeres, niños, niñas y adolescentes, entre otras, me permite orientarte de forma certera y buscar soluciones dentro de las reales posibilidades que brinda el sistema.
                                </p>
                                ')) }}</textarea>
                                            </div>

                                            <!-- Servicios -->
                                            <!-- Servicio 1 -->
                                            <div class="mb-3">
                                                <label for="service1_title" class="form-label">
                                                    <strong>Título Servicio 1</strong>
                                                </label>
                                                <input type="text" class="form-control" name="service1_title"
                                                    id="service1_title"
                                                    value="{{ old('service1_title', tenantText('service1_title', 'Asesoría jurídica integral')) }}"
                                                    placeholder="Título del servicio 1">
                                            </div>
                                            <div class="mb-4">
                                                <label for="service1_body" class="form-label">
                                                    <strong>Descripción Servicio 1</strong>
                                                </label>
                                                <textarea class="form-control summernote" name="service1_body"
                                                    id="service1_body" rows="4"
                                                    placeholder="Descripción del servicio 1">{!! old('service1_body', tenantText('service1_body', '<p style="text-align: justify;">Te ofrezco un servicio de orientación legal para identificar el escenario jurídico que enfrentas.</p>')) !!}</textarea>
                                            </div>

                                            <!-- Servicio 2 -->
                                            <div class="mb-3">
                                                <label for="service2_title" class="form-label">
                                                    <strong>Título Servicio 2</strong>
                                                </label>
                                                <input type="text" class="form-control" name="service2_title"
                                                    id="service2_title"
                                                    value="{{ old('service2_title', tenantText('service2_title', 'Representación judicial')) }}"
                                                    placeholder="Título del servicio 2">
                                            </div>
                                            <div class="mb-4">
                                                <label for="service2_body" class="form-label">
                                                    <strong>Descripción Servicio 2</strong>
                                                </label>
                                                <textarea class="form-control summernote" name="service2_body"
                                                    id="service2_body" rows="4"
                                                    placeholder="Descripción del servicio 2">{!! old('service2_body', tenantText('service2_body', '<p style="text-align: justify;">Te represento en procesos judiciales penales, de familia u otras materias.</p>')) !!}</textarea>
                                            </div>

                                            <!-- Servicio 3 -->
                                            <div class="mb-3">
                                                <label for="service3_title" class="form-label">
                                                    <strong>Título Servicio 3</strong>
                                                </label>
                                                <input type="text" class="form-control" name="service3_title"
                                                    id="service3_title"
                                                    value="{{ old('service3_title', tenantText('service3_title', 'Capacitaciones y charlas')) }}"
                                                    placeholder="Título del servicio 3">
                                            </div>
                                            <div class="mb-4">
                                                <label for="service3_body" class="form-label">
                                                    <strong>Descripción Servicio 3</strong>
                                                </label>
                                                <textarea class="form-control summernote" name="service3_body"
                                                    id="service3_body" rows="4"
                                                    placeholder="Descripción del servicio 3">{!! old('service3_body', tenantText('service3_body', '<p style="text-align: justify;">Realizo talleres, charlas y capacitaciones para grupos en contextos académicos, laborales o comunitarios.</p>')) !!}</textarea>
                                            </div>

                                        </div>

                                        <!-- SERVICIOS -->
                                        <div class="tab-pane fade" id="servicios" role="tabpanel">
                                        </div>

                                        <!-- CONTACTO -->
                                        <div class="tab-pane fade" id="contacto" role="tabpanel">
                                        </div>

                                    </div>


                                    <!-- Botón Guardar -->
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn"
                                            style="background-color: {{ tenantSetting('button_color_sidebar', '#F5E8D0') }};
                                                                                                                    color: {{ tenantSetting('button_banner_text_color', 'white') }};
                                                                                                                    transition: all 0.3s ease;">
                                            <i class="fas fa-save me-2"></i>Guardar Textos
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

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
        document.addEventListener('DOMContentLoaded', function () {
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

            customizationForm.addEventListener('submit', async function (e) {
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
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.summernote').summernote({
                height: 150,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol']],
                    ['view', ['codeview']]
                ]
            });
        });
    </script>


@endsection