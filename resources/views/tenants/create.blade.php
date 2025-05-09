@extends('layouts.app')

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
    <div class="container">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h2 class="h3 mb-0 fw-bold" style="color: #8C2D18;">
                <i class="bi bi-building me-2"></i>{{ __('Nuevo Tenant') }}
            </h2>
            <a href="{{ route('tenants.index') }}" class="btn btn-sm" style="background-color: #F5E8D0; color: #8C2D18;">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>

        {{-- Formulario --}}
        <div class="card shadow border-0" style="background-color: #FDF5E5;">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('tenants.store') }}" enctype="multipart/form-data"
                    class="bg-white p-4 rounded-3 shadow-sm">
                    @csrf

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
                            <input id="name" type="text" class="form-control border-start-0"
                                style="background-color: #FDF5E5;" name="name" value="{{ old('name') }}" required
                                autofocus>
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
                            <input id="email" type="email" class="form-control border-start-0"
                                style="background-color: #FDF5E5;" name="email" value="{{ old('email') }}" required>
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
                            <input id="domain_name" type="text" class="form-control border-start-0"
                                style="background-color: #FDF5E5;" name="domain_name" value="{{ old('domain_name') }}"
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
                            <i class="bi bi-lock me-1"></i>Contraseña
                        </label>
                        <div class="input-group">
                            <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                <i class="bi bi-key"></i>
                            </span>
                            <input id="password" type="password" class="form-control border-start-0"
                                style="background-color: #FDF5E5;" name="password" required>
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
                            <input id="password_confirmation" type="password" class="form-control border-start-0"
                                style="background-color: #FDF5E5;" name="password_confirmation" required>
                            <button class="btn" type="button" style="background-color: #F5E8D0; color: #8C2D18;"
                                onclick="togglePassword('password_confirmation')">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Sección de Personalización --}}
                    <div class="mb-4 border-top pt-3">
                        <h5 class="fw-medium mb-3" style="color: #8C2D18;">
                            <i class="bi bi-palette me-2"></i>Personalización
                        </h5>

                        {{-- Logo 1 --}}
                        <div class="mb-4">
                            <label for="logo_1" class="form-label fw-medium" style="color: #8C2D18;">
                                <i class="bi bi-image me-1"></i>Logo Principal
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                    <i class="bi bi-upload"></i>
                                </span>
                                <input id="logo_1" type="file" class="form-control border-start-0"
                                    style="background-color: #FDF5E5;" name="logo_1" accept="image/*">
                            </div>
                            @error('logo_1')
                                <div class="text-danger small mt-2">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Logo 2 --}}
                        <div class="mb-4">
                            <label for="logo_2" class="form-label fw-medium" style="color: #8C2D18;">
                                <i class="bi bi-images me-1"></i>Logo Secundario
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                    <i class="bi bi-upload"></i>
                                </span>
                                <input id="logo_2" type="file" class="form-control border-start-0"
                                    style="background-color: #FDF5E5;" name="logo_2" accept="image/*">
                            </div>
                            @error('logo_2')
                                <div class="text-danger small mt-2">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Color de Fondo 1 --}}
                        <div class="mb-4">
                            <label for="background_color_1" class="form-label fw-medium" style="color: #8C2D18;">
                                <i class="bi bi-droplet me-1"></i>Color de Fondo Principal
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                    <i class="bi bi-palette"></i>
                                </span>
                                <input id="background_color_1" type="color"
                                    class="form-control form-control-color border-start-0"
                                    style="background-color: #FDF5E5; height: 38px;" name="background_color_1"
                                    value="{{ old('background_color_1', '#ffffff') }}">
                            </div>
                            @error('background_color_1')
                                <div class="text-danger small mt-2">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Color de Texto 1 --}}
                        <div class="mb-4">
                            <label for="text_color_1" class="form-label fw-medium" style="color: #8C2D18;">
                                <i class="bi bi-fonts me-1"></i>Color de Texto Principal
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                    <i class="bi bi-palette"></i>
                                </span>
                                <input id="text_color_1" type="color"
                                    class="form-control form-control-color border-start-0"
                                    style="background-color: #FDF5E5; height: 38px;" name="text_color_1"
                                    value="{{ old('text_color_1', '#ffffff') }}">
                            </div>
                            @error('text_color_1')
                                <div class="text-danger small mt-2">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Color de Fondo 2 --}}
                        <div class="mb-4">
                            <label for="background_color_2" class="form-label fw-medium" style="color: #8C2D18;">
                                <i class="bi bi-droplet me-1"></i>Color de Fondo Secundario
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                    <i class="bi bi-palette"></i>
                                </span>
                                <input id="background_color_2" type="color"
                                    class="form-control form-control-color border-start-0"
                                    style="background-color: #FDF5E5; height: 38px;" name="background_color_2"
                                    value="{{ old('background_color_2', '#ffffff') }}">
                            </div>
                            @error('background_color_2')
                                <div class="text-danger small mt-2">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Color de Texto 2 --}}
                        <div class="mb-4">
                            <label for="text_color_2" class="form-label fw-medium" style="color: #8C2D18;">
                                <i class="bi bi-fonts me-1"></i>Color de Texto Secundario
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                    <i class="bi bi-palette"></i>
                                </span>
                                <input id="text_color_2" type="color"
                                    class="form-control form-control-color border-start-0"
                                    style="background-color: #FDF5E5; height: 38px;" name="text_color_2"
                                    value="{{ old('text_color_2', '#ffffff') }}">
                            </div>
                            @error('text_color_2')
                                <div class="text-danger small mt-2">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Color de Navbar 1 --}}
                        <div class="mb-4">
                            <label for="navbar_color_1" class="form-label fw-medium" style="color: #8C2D18;">
                                <i class="bi bi-border-width me-1"></i>Color Principal de la Barra de Navegación
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                    <i class="bi bi-palette2"></i>
                                </span>
                                <input id="navbar_color_1" type="color"
                                    class="form-control form-control-color border-start-0"
                                    style="background-color: #FDF5E5; height: 38px;" name="navbar_color_1"
                                    value="{{ old('navbar_color_1', '#343a40') }}">
                            </div>
                            @error('navbar_color_1')
                                <div class="text-danger small mt-2">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Color de Texto de Navbar 1 --}}
                        <div class="mb-4">
                            <label for="navbar_text_color_1" class="form-label fw-medium" style="color: #8C2D18;">
                                <i class="bi bi-fonts me-1"></i>Color de Texto Principal de la Barra de Navegación
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                    <i class="bi bi-palette2"></i>
                                </span>
                                <input id="navbar_text_color_1" type="color"
                                    class="form-control form-control-color border-start-0"
                                    style="background-color: #FDF5E5; height: 38px;" name="navbar_text_color_1"
                                    value="{{ old('navbar_text_color_1', '#343a40') }}">
                            </div>
                            @error('navbar_text_color_1')
                                <div class="text-danger small mt-2">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Color de Navbar 2 --}}
                        <div class="mb-4">
                            <label for="navbar_color_2" class="form-label fw-medium" style="color: #8C2D18;">
                                <i class="bi bi-border-width me-1"></i>Color Secundario de la Barra de Navegación
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                    <i class="bi bi-palette2"></i>
                                </span>
                                <input id="navbar_color_2" type="color"
                                    class="form-control form-control-color border-start-0"
                                    style="background-color: #FDF5E5; height: 38px;" name="navbar_color_2"
                                    value="{{ old('navbar_color_2', '#343a40') }}">
                            </div>
                            @error('navbar_color_2')
                                <div class="text-danger small mt-2">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Color de Texto de Navbar 2 --}}
                        <div class="mb-4">
                            <label for="navbar_text_color_2" class="form-label fw-medium" style="color: #8C2D18;">
                                <i class="bi bi-fonts me-1"></i>Color de Texto Secundario de la Barra de Navegación
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                    <i class="bi bi-palette2"></i>
                                </span>
                                <input id="navbar_text_color_2" type="color"
                                    class="form-control form-control-color border-start-0"
                                    style="background-color: #FDF5E5; height: 38px;" name="navbar_text_color_2"
                                    value="{{ old('navbar_text_color_2', '#343a40') }}">
                            </div>
                            @error('navbar_text_color_2')
                                <div class="text-danger small mt-2">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Tipografía de Navbar --}}
                        <div class="mb-4">
                            <label for="navbar_font" class="form-label fw-medium" style="color: #8C2D18;">
                                <i class="bi bi-fonts me-1"></i>Tipografía de Barra de Navegación
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                    <i class="bi bi-type"></i>
                                </span>
                                <select id="navbar_font" class="form-select border-start-0"
                                    style="background-color: #FDF5E5;" name="navbar_font">
                                    <option value="Arial" {{ old('navbar_font') == 'Arial' ? 'selected' : '' }}>Arial
                                    </option>
                                    <option value="Roboto" {{ old('navbar_font') == 'Roboto' ? 'selected' : '' }}>Roboto
                                    </option>
                                    <option value="Open Sans" {{ old('navbar_font') == 'Open Sans' ? 'selected' : '' }}>
                                        Open
                                        Sans</option>
                                    <option value="Montserrat" {{ old('navbar_font') == 'Montserrat' ? 'selected' : '' }}>
                                        Montserrat</option>
                                </select>
                            </div>
                            @error('navbar_font')
                                <div class="text-danger small mt-2">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Tipografía de Títulos de Página --}}
                        <div class="mb-4">
                            <label for="heading_font" class="form-label fw-medium" style="color: #8C2D18;">
                                <i class="bi bi-fonts me-1"></i>Tipografía de Títulos de Página
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                    <i class="bi bi-type"></i>
                                </span>
                                <select id="heading_font" class="form-select border-start-0"
                                    style="background-color: #FDF5E5;" name="heading_font">
                                    <option value="Arial" {{ old('heading_font') == 'Arial' ? 'selected' : '' }}>Arial
                                    </option>
                                    <option value="Roboto" {{ old('heading_font') == 'Roboto' ? 'selected' : '' }}>Roboto
                                    </option>
                                    <option value="Open Sans" {{ old('heading_font') == 'Open Sans' ? 'selected' : '' }}>
                                        Open
                                        Sans</option>
                                    <option value="Montserrat"
                                        {{ old('heading_font') == 'Montserrat' ? 'selected' : '' }}>
                                        Montserrat</option>
                                </select>
                            </div>
                            @error('heading_font')
                                <div class="text-danger small mt-2">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Tipografía del Cuerpo --}}
                        <div class="mb-4">
                            <label for="body_font" class="form-label fw-medium" style="color: #8C2D18;">
                                <i class="bi bi-fonts me-1"></i>Tipografía del Cuerpo
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                    <i class="bi bi-type"></i>
                                </span>
                                <select id="body_font" class="form-select border-start-0"
                                    style="background-color: #FDF5E5;" name="body_font">
                                    <option value="Arial" {{ old('body_font') == 'Arial' ? 'selected' : '' }}>Arial
                                    </option>
                                    <option value="Roboto" {{ old('body_font') == 'Roboto' ? 'selected' : '' }}>Roboto
                                    </option>
                                    <option value="Open Sans" {{ old('body_font') == 'Open Sans' ? 'selected' : '' }}>Open
                                        Sans</option>
                                    <option value="Montserrat" {{ old('body_font') == 'Montserrat' ? 'selected' : '' }}>
                                        Montserrat</option>
                                </select>
                            </div>
                            @error('body_font')
                                <div class="text-danger small mt-2">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- Botón Guardar --}}
                    <div class="mt-4 pt-3 border-top text-center">
                        <button type="submit" class="btn fw-medium py-1"
                            style="background-color: #8C2D18; color: white; width: 200px;">
                            <i class="bi bi-save me-2"></i>Guardar Tenant
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script para mostrar/ocultar contraseña --}}
    <script>
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
    </script>
@endsection
