@extends('layouts.app')

@section('title', 'Editar Tenant - ' . config('app.name', 'Laravel'))

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h3 class="fw-bold mb-0" style="color: #8C2D18;">
                <i class="bi bi-building-gear me-2"></i>{{ __('Editar Tenant') }}
            </h3>
            <a href="{{ route('tenants.index') }}" class="btn btn-sm" style="background-color: #F5E8D0; color: #8C2D18;">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        {{-- Formulario --}}
        <div class="card shadow border-0" style="background-color: #FDF5E5;">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('tenants.update', $tenant) }}" enctype="multipart/form-data"
                    class="bg-white p-4 rounded-3 shadow-sm">
                    @csrf
                    @method('PUT')

                    <h5 class="fw-medium mb-3" style="color: #8C2D18;">
                        <i class="bi bi-info-circle me-2"></i>Información Principal
                    </h5>

                    {{-- Nombre --}}
                    <div class="mb-4">
                        <label for="name" class="form-label fw-medium" style="color: #8C2D18;">
                            <i class="bi bi-fonts me-1"></i>Nombre del Tenant
                        </label>
                        <div class="input-group">
                            <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                <i class="bi bi-building"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" style="background-color: #FDF5E5;"
                                placeholder="Por ejemplo: Mi Buffet de Abogados" id="name" name="name"
                                value="{{ old('name', $tenant->name) }}" required autofocus>
                        </div>
                        @error('name')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="form-label fw-medium" style="color: #8C2D18;">
                            <i class="bi bi-envelope me-1"></i>Correo Electrónico
                        </label>
                        <div class="input-group">
                            <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                <i class="bi bi-at"></i>
                            </span>
                            <input type="email" class="form-control border-start-0" style="background-color: #FDF5E5;"
                                placeholder="Por ejemplo: mibuffet@abogados.cl" id="email" name="email"
                                value="{{ old('email', $tenant->email) }}" required>
                        </div>
                        @error('email')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Dominio --}}
                    <div class="mb-4">
                        <label for="domain_name" class="form-label fw-medium" style="color: #8C2D18;">
                            <i class="bi bi-globe me-1"></i>Dominio
                        </label>
                        <div class="input-group">
                            <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                <i class="bi bi-link-45deg"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" style="background-color: #FDF5E5;"
                                id="domain_name" name="domain_name"
                                placeholder="Por ejemplo: mibuffet (quedará como mibuffet.{{ config('app.domain') }})"
                                value="{{ Str::remove('.' . config('app.domain'), old('domain_name', $tenant->domains->first()->domain ?? '')) }}"
                                required>
                            <span class="input-group-text" id="basic-addon2"
                                style="background-color: #F5E8D0; color: #8C2D18;">.{{ config('app.domain') }}</span>
                        </div>
                        @error('domain_name')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Contraseña --}}
                    <div class="mb-4">
                        <label for="password" class="form-label fw-medium" style="color: #8C2D18;">
                            <i class="bi bi-lock me-1"></i>Contraseña (opcional)
                        </label>
                        <div class="input-group">
                            <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                <i class="bi bi-key"></i>
                            </span>
                            <input type="password" class="form-control border-start-0" style="background-color: #FDF5E5;"
                                placeholder="Ingrese una contraseña segura" id="password" name="password">
                            <button class="btn" type="button" style="background-color: #F5E8D0; color: #8C2D18;"
                                onclick="togglePassword('password')">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Confirmar Contraseña --}}
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-medium" style="color: #8C2D18;">
                            <i class="bi bi-lock me-1"></i>Confirmar Contraseña
                        </label>
                        <div class="input-group">
                            <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                <i class="bi bi-key-fill"></i>
                            </span>
                            <input type="password" class="form-control border-start-0" style="background-color: #FDF5E5;"
                                placeholder="Confirme la contraseña ingresada anteriormente" id="password_confirmation"
                                name="password_confirmation">
                            <button class="btn" type="button" style="background-color: #F5E8D0; color: #8C2D18;"
                                onclick="togglePassword('password_confirmation')">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Estilos Predeterminados --}}
                    <h5 class="fw-medium mb-3 mt-5" style="color: #8C2D18;">
                        <i class="bi bi-brush me-2"></i>Estilos Predeterminados
                    </h5>

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

                    {{-- Campo oculto para la paleta seleccionada --}}
                    <input type="hidden" id="selected_palette" name="selected_palette" value="">

                    {{-- Sección de Personalización Avanzada --}}
                    <div class="mt-5 pt-4 border-top">
                        <h5 class="fw-medium mb-3 border-bottom pb-2" style="color: #8C2D18;">
                            <i class="bi bi-sliders me-2"></i>Personalización Avanzada
                        </h5>
                        <p class="text-muted mb-4">Ajusta cada aspecto de tu diseño manualmente</p>

                        {{-- Logos --}}
                        <div class="mb-4">
                            <h6 class="fw-medium mb-3" style="color: #8C2D18;">
                                <i class="bi bi-images me-2"></i>Logos
                            </h6>

                            <div class="row g-3">
                                {{-- Logo Principal --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-medium" style="color: #8C2D18;">Logo Principal
                                        Actual</label>
                                    @if ($tenant->logo_path_1)
                                        <div class="text-center mb-2">
                                            <img src="{{ $tenant->logo_path_1 }}" alt="Logo Principal"
                                                class="img-fluid rounded border"
                                                style="max-height: 80px; background-color: {{ $tenant->background_color_1 }};">
                                        </div>
                                    @else
                                        <p class="text-muted">No hay logo principal cargado</p>
                                    @endif

                                    <label for="logo_1" class="form-label fw-medium" style="color: #8C2D18;">Actualizar
                                        Logo Principal</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                            <i class="bi bi-upload"></i>
                                        </span>
                                        <input type="file" class="form-control border-start-0"
                                            style="background-color: #FDF5E5;" id="logo_1" name="logo_1"
                                            accept="image/*">
                                    </div>
                                    @error('logo_1')
                                        <div class="text-danger small mt-2">
                                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Logo Secundario --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-medium" style="color: #8C2D18;">Logo Secundario
                                        Actual</label>
                                    @if ($tenant->logo_path_2)
                                        <div class="text-center mb-2">
                                            <img src="{{ $tenant->logo_path_2 }}" alt="Logo Secundario"
                                                class="img-fluid rounded border"
                                                style="max-height: 80px; background-color: {{ $tenant->background_color_2 }};">
                                        </div>
                                    @else
                                        <p class="text-muted">No hay logo secundario cargado</p>
                                    @endif

                                    <label for="logo_2" class="form-label fw-medium" style="color: #8C2D18;">Actualizar
                                        Logo Secundario</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                            <i class="bi bi-upload"></i>
                                        </span>
                                        <input type="file" class="form-control border-start-0"
                                            style="background-color: #FDF5E5;" id="logo_2" name="logo_2"
                                            accept="image/*">
                                    </div>
                                    @error('logo_2')
                                        <div class="text-danger small mt-2">
                                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Colores --}}
                        <div class="mb-4">
                            <h6 class="fw-medium mb-3" style="color: #8C2D18;">
                                <i class="bi bi-palette me-2"></i>Colores
                            </h6>

                            <div class="row g-3">
                                {{-- Fondo 1 --}}
                                <div class="col-md-6 col-lg-4">
                                    <label for="background_color_1" class="form-label fw-medium"
                                        style="color: #8C2D18;">Fondo Principal</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                            <i class="bi bi-droplet"></i>
                                        </span>
                                        <input type="color" class="form-control form-control-color border-start-0"
                                            style="background-color: #FDF5E5; height: 38px;" id="background_color_1"
                                            name="background_color_1"
                                            value="{{ old('background_color_1', $tenant->background_color_1) }}">
                                    </div>
                                    @error('background_color_1')
                                        <div class="text-danger small mt-2">
                                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Texto 1 --}}
                                <div class="col-md-6 col-lg-4">
                                    <label for="text_color_1" class="form-label fw-medium" style="color: #8C2D18;">Texto
                                        Principal</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                            <i class="bi bi-fonts"></i>
                                        </span>
                                        <input type="color" class="form-control form-control-color border-start-0"
                                            style="background-color: #FDF5E5; height: 38px;" id="text_color_1"
                                            name="text_color_1" value="{{ old('text_color_1', $tenant->text_color_1) }}">
                                    </div>
                                    @error('text_color_1')
                                        <div class="text-danger small mt-2">
                                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Fondo 2 --}}
                                <div class="col-md-6 col-lg-4">
                                    <label for="background_color_2" class="form-label fw-medium"
                                        style="color: #8C2D18;">Fondo Secundario</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                            <i class="bi bi-droplet"></i>
                                        </span>
                                        <input type="color" class="form-control form-control-color border-start-0"
                                            style="background-color: #FDF5E5; height: 38px;" id="background_color_2"
                                            name="background_color_2"
                                            value="{{ old('background_color_2', $tenant->background_color_2) }}">
                                    </div>
                                    @error('background_color_2')
                                        <div class="text-danger small mt-2">
                                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Texto 2 --}}
                                <div class="col-md-6 col-lg-4">
                                    <label for="text_color_2" class="form-label fw-medium" style="color: #8C2D18;">Texto
                                        Secundario</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                            <i class="bi bi-fonts"></i>
                                        </span>
                                        <input type="color" class="form-control form-control-color border-start-0"
                                            style="background-color: #FDF5E5; height: 38px;" id="text_color_2"
                                            name="text_color_2" value="{{ old('text_color_2', $tenant->text_color_2) }}">
                                    </div>
                                    @error('text_color_2')
                                        <div class="text-danger small mt-2">
                                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Navbar --}}
                                <div class="col-md-6 col-lg-4">
                                    <label for="navbar_color_1" class="form-label fw-medium"
                                        style="color: #8C2D18;">Color de Navbar</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                            <i class="bi bi-border-width"></i>
                                        </span>
                                        <input type="color" class="form-control form-control-color border-start-0"
                                            style="background-color: #FDF5E5; height: 38px;" id="navbar_color_1"
                                            name="navbar_color_1"
                                            value="{{ old('navbar_color_1', $tenant->navbar_color_1) }}">
                                    </div>
                                    @error('navbar_color_1')
                                        <div class="text-danger small mt-2">
                                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Texto Navbar --}}
                                <div class="col-md-6 col-lg-4">
                                    <label for="navbar_text_color_1" class="form-label fw-medium"
                                        style="color: #8C2D18;">Texto de Navbar</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                            <i class="bi bi-type"></i>
                                        </span>
                                        <input type="color" class="form-control form-control-color border-start-0"
                                            style="background-color: #FDF5E5; height: 38px;" id="navbar_text_color_1"
                                            name="navbar_text_color_1"
                                            value="{{ old('navbar_text_color_1', $tenant->navbar_text_color_1) }}">
                                    </div>
                                    @error('navbar_text_color_1')
                                        <div class="text-danger small mt-2">
                                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Botón Sidebar --}}
                                <div class="col-md-6 col-lg-4">
                                    <label for="button_color_sidebar" class="form-label fw-medium"
                                        style="color: #8C2D18;">Botón Sidebar</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                            <i class="bi bi-toggle-on"></i>
                                        </span>
                                        <input type="color" class="form-control form-control-color border-start-0"
                                            style="background-color: #FDF5E5; height: 38px;" id="button_color_sidebar"
                                            name="button_color_sidebar"
                                            value="{{ old('button_color_sidebar', $tenant->button_color_sidebar) }}">
                                    </div>
                                    @error('button_color_sidebar')
                                        <div class="text-danger small mt-2">
                                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Color Métricas --}}
                                <div class="col-md-6 col-lg-4">
                                    <label for="color_metrics" class="form-label fw-medium" style="color: #8C2D18;">Color
                                        Métricas</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                            <i class="bi bi-graph-up"></i>
                                        </span>
                                        <input type="color" class="form-control form-control-color border-start-0"
                                            style="background-color: #FDF5E5; height: 38px;" id="color_metrics"
                                            name="color_metrics"
                                            value="{{ old('color_metrics', $tenant->color_metrics) }}">
                                    </div>
                                    @error('color_metrics')
                                        <div class="text-danger small mt-2">
                                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Color Tablas --}}
                                <div class="col-md-6 col-lg-4">
                                    <label for="color_tables" class="form-label fw-medium" style="color: #8C2D18;">Color
                                        Tablas</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                            <i class="bi bi-table"></i>
                                        </span>
                                        <input type="color" class="form-control form-control-color border-start-0"
                                            style="background-color: #FDF5E5; height: 38px;" id="color_tables"
                                            name="color_tables" value="{{ old('color_tables', $tenant->color_tables) }}">
                                    </div>
                                    @error('color_tables')
                                        <div class="text-danger small mt-2">
                                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Tipografías --}}
                        <div class="mb-4">
                            <h6 class="fw-medium mb-3" style="color: #8C2D18;">
                                <i class="bi bi-fonts me-2"></i>Tipografías
                            </h6>

                            <div class="row g-3">
                                {{-- Navbar --}}
                                <div class="col-md-4">
                                    <label for="navbar_font" class="form-label fw-medium"
                                        style="color: #8C2D18;">Navbar</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                            <i class="bi bi-type"></i>
                                        </span>
                                        <select id="navbar_font" class="form-select border-start-0"
                                            style="background-color: #FDF5E5;" name="navbar_font">
                                            <option value="Arial"
                                                {{ old('navbar_font', $tenant->navbar_font) == 'Arial' ? 'selected' : '' }}>
                                                Arial
                                            </option>
                                            <option value="Roboto"
                                                {{ old('navbar_font', $tenant->navbar_font) == 'Roboto' ? 'selected' : '' }}>
                                                Roboto
                                            </option>
                                            <option value="Open Sans"
                                                {{ old('navbar_font', $tenant->navbar_font) == 'Open Sans' ? 'selected' : '' }}>
                                                Open Sans</option>
                                            <option value="Montserrat"
                                                {{ old('navbar_font', $tenant->navbar_font) == 'Montserrat' ? 'selected' : '' }}>
                                                Montserrat</option>
                                            <option value="Courier Prime"
                                                {{ old('navbar_font', $tenant->navbar_font) == 'Courier Prime' ? 'selected' : '' }}>
                                                Courier Prime</option>
                                        </select>
                                    </div>
                                    @error('navbar_font')
                                        <div class="text-danger small mt-2">
                                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Títulos --}}
                                <div class="col-md-4">
                                    <label for="heading_font" class="form-label fw-medium"
                                        style="color: #8C2D18;">Títulos</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                            <i class="bi bi-type-h1"></i>
                                        </span>
                                        <select id="heading_font" class="form-select border-start-0"
                                            style="background-color: #FDF5E5;" name="heading_font">
                                            <option value="Arial"
                                                {{ old('heading_font', $tenant->heading_font) == 'Arial' ? 'selected' : '' }}>
                                                Arial
                                            </option>
                                            <option value="Roboto"
                                                {{ old('heading_font', $tenant->heading_font) == 'Roboto' ? 'selected' : '' }}>
                                                Roboto
                                            </option>
                                            <option value="Open Sans"
                                                {{ old('heading_font', $tenant->heading_font) == 'Open Sans' ? 'selected' : '' }}>
                                                Open Sans</option>
                                            <option value="Montserrat"
                                                {{ old('heading_font', $tenant->heading_font) == 'Montserrat' ? 'selected' : '' }}>
                                                Montserrat</option>
                                            <option value="Courier Prime"
                                                {{ old('heading_font', $tenant->heading_font) == 'Courier Prime' ? 'selected' : '' }}>
                                                Courier Prime</option>
                                        </select>
                                    </div>
                                    @error('heading_font')
                                        <div class="text-danger small mt-2">
                                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Cuerpo --}}
                                <div class="col-md-4">
                                    <label for="body_font" class="form-label fw-medium"
                                        style="color: #8C2D18;">Cuerpo</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                            <i class="bi bi-text-paragraph"></i>
                                        </span>
                                        <select id="body_font" class="form-select border-start-0"
                                            style="background-color: #FDF5E5;" name="body_font">
                                            <option value="Arial"
                                                {{ old('body_font', $tenant->body_font) == 'Arial' ? 'selected' : '' }}>
                                                Arial
                                            </option>
                                            <option value="Roboto"
                                                {{ old('body_font', $tenant->body_font) == 'Roboto' ? 'selected' : '' }}>
                                                Roboto
                                            </option>
                                            <option value="Open Sans"
                                                {{ old('body_font', $tenant->body_font) == 'Open Sans' ? 'selected' : '' }}>
                                                Open Sans</option>
                                            <option value="Montserrat"
                                                {{ old('body_font', $tenant->body_font) == 'Montserrat' ? 'selected' : '' }}>
                                                Montserrat</option>
                                            <option value="Courier Prime"
                                                {{ old('body_font', $tenant->body_font) == 'Courier Prime' ? 'selected' : '' }}>
                                                Courier Prime</option>
                                        </select>
                                    </div>
                                    @error('body_font')
                                        <div class="text-danger small mt-2">
                                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Botón Guardar --}}
                    <div class="mt-4 pt-3 border-top text-center">
                        <button type="submit" class="btn fw-medium py-1"
                            style="background-color: #8C2D18; color: white; width: 200px;">
                            <i class="bi bi-save me-2"></i>Actualizar Tenant
                        </button>
                    </div>
                </form>
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
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const palettesContainer = document.getElementById('palettes-container');
            const selectedPaletteInput = document.getElementById('selected_palette');
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

                const paletteKey = card.getAttribute('data-key');
                selectedPaletteInput.value = paletteKey;

                try {
                    selectedPaletteData = JSON.parse(card.getAttribute('data-palette'));
                    console.log('Paleta seleccionada:', selectedPaletteData);
                    updateCustomizationForm(selectedPaletteData);
                } catch (error) {
                    console.error('Error al parsear JSON:', error);
                    showAlert('error', 'Error al seleccionar la paleta');
                }
            });

            function updateCustomizationForm(palette) {
                const fields = [
                    'background_color_1', 'text_color_1', 'background_color_2',
                    'text_color_2', 'navbar_color_1', 'navbar_text_color_1',
                    'navbar_color_2', 'navbar_text_color_2', 'button_color_sidebar',
                    'color_metrics', 'color_tables'
                ];

                fields.forEach(field => {
                    const input = document.getElementById(field);
                    if (input) {
                        input.value = palette[field];
                        input.dataset.paletteUpdate = 'true';
                    }
                });
            }

            document.querySelectorAll('input[type="color"], select').forEach(input => {
                input.addEventListener('change', function() {
                    if (this.dataset.paletteUpdate === 'true') {
                        delete this.dataset.paletteUpdate;
                    } else {
                        selectedPaletteInput.value = '';
                        clearSelection();
                    }
                });
            });

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

            function togglePassword(fieldId) {
                const field = document.getElementById(fieldId);
                const icon = field.nextElementSibling.querySelector('i');
                if (field.type === 'password') {
                    field.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    field.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            }
        });
    </script>
@endsection
