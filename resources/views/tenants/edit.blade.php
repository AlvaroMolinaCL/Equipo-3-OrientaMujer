@extends('layouts.app')

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
    <div class="container">
        {{-- Encabezado mejorado --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h2 class="h3 mb-0 fw-bold" style="color: #8C2D18;">
                <i class="bi bi-building me-2"></i>{{ __('Editar Tenant') }}
            </h2>
            <a href="{{ route('tenants.index') }}" class="btn btn-sm" style="background-color: #F5E8D0; color: #8C2D18;">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>

        {{-- Formulario vertical --}}
        <div class="card shadow border-0" style="background-color: #FDF5E5;">
            <div class="card-body p-4">
                <form action="{{ route('tenants.update', $tenant) }}" method="POST"
                    class="bg-white p-4 rounded-3 shadow-sm">
                    @csrf
                    @method('PUT')

                    {{-- Campo Nombre --}}
                    <div class="mb-4">
                        <label for="name" class="form-label fw-medium" style="color: #8C2D18;">
                            <i class="bi bi-fonts me-1"></i>Nombre del Tenant
                        </label>
                        <div class="input-group">
                            <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                <i class="bi bi-building"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" style="background-color: #FDF5E5;"
                                id="name" name="name" value="{{ old('name', $tenant->name) }}" required autofocus>
                        </div>
                        @error('name')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Campo Email --}}
                    <div class="mb-4">
                        <label for="email" class="form-label fw-medium" style="color: #8C2D18;">
                            <i class="bi bi-envelope me-1"></i>Correo Electrónico
                        </label>
                        <div class="input-group">
                            <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                <i class="bi bi-at"></i>
                            </span>
                            <input type="email" class="form-control border-start-0" style="background-color: #FDF5E5;"
                                id="email" name="email" value="{{ old('email', $tenant->email) }}" required>
                        </div>
                        @error('email')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Campo Dominio --}}
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
                                value="{{ old('domain_name', $tenant->domains->first()->domain ?? '') }}" required>
                        </div>
                        @error('domain_name')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Campo Contraseña --}}
                    <div class="mb-4">
                        <label for="password" class="form-label fw-medium" style="color: #8C2D18;">
                            <i class="bi bi-lock me-1"></i>Contraseña (opcional)
                        </label>
                        <div class="input-group">
                            <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                <i class="bi bi-key"></i>
                            </span>
                            <input type="password" class="form-control border-start-0" style="background-color: #FDF5E5;"
                                id="password" name="password">
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

                    {{-- Campo Confirmar Contraseña --}}
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-medium" style="color: #8C2D18;">
                            <i class="bi bi-lock me-1"></i>Confirmar Contraseña
                        </label>
                        <div class="input-group">
                            <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                <i class="bi bi-key-fill"></i>
                            </span>
                            <input type="password" class="form-control border-start-0" style="background-color: #FDF5E5;"
                                id="password_confirmation" name="password_confirmation">
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

                        {{-- Color de fondo --}}
                        <div class="mb-4">
                            <label for="background_color" class="form-label fw-medium" style="color: #8C2D18;">
                                <i class="bi bi-droplet me-1"></i>Color de Fondo
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                    <i class="bi bi-palette"></i>
                                </span>
                                <input id="background_color" type="color"
                                    class="form-control form-control-color border-start-0"
                                    style="background-color: #FDF5E5; height: 38px;" name="background_color"
                                    value="{{ old('background_color', '#ffffff') }}">
                            </div>
                            @error('background_color')
                                <div class="text-danger small mt-2">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Color de navbar --}}
                        <div class="mb-4">
                            <label for="navbar_color" class="form-label fw-medium" style="color: #8C2D18;">
                                <i class="bi bi-border-width me-1"></i>Color de la Barra de Navegación
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                    <i class="bi bi-palette2"></i>
                                </span>
                                <input id="navbar_color" type="color"
                                    class="form-control form-control-color border-start-0"
                                    style="background-color: #FDF5E5; height: 38px;" name="navbar_color"
                                    value="{{ old('navbar_color', '#343a40') }}">
                            </div>
                            @error('navbar_color')
                                <div class="text-danger small mt-2">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Tipografía --}}
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

                    {{-- Botón de submit --}}
                    <div class="mt-4 pt-3 border-top text-center">
                        <button type="submit" class="btn fw-medium py-1"
                            style="background-color: #8C2D18; color: white; width: 200px;">
                            <i class="bi bi-save me-2"></i>Actualizar Tenant
                        </button>
                    </div>
                </form>
            </div>

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
