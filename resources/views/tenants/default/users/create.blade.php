@extends('tenants.default.layouts.panel')

@section('title', 'Dashboard')

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    <div class="container">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h3 class="h3 mb-0 fw-bold" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-person-plus me-2"></i>{{ __('Nuevo Usuario') }}
            </h3>
            <a href="{{ route('users.index') }}" class="btn btn-sm"
                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                  color: {{ tenantSetting('text_color_1', '#8C2D18') }};
                  border: 2px solid {{ tenantSetting('color_tables', '#8C2D18') }};">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>

        {{-- Formulario --}}
        <div class="card shadow border-0" style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('users.store') }}" class="bg-white p-4 rounded-3 shadow-sm">
                    @csrf

                    <h5 class="fw-medium mb-3"
                        style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};">
                        <i class="bi bi-info-circle me-2"></i>Información del Usuario
                    </h5>

                    {{-- Nombre --}}
                    <div class="mb-4">
                        <label for="name" class="form-label fw-medium"
                            style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                            <i class="bi bi-person me-1"></i>Nombre Completo
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"
                                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                <i class="bi bi-fonts"></i>
                            </span>
                            <input id="name" type="text" class="form-control border-start-0"
                                style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};"
                                placeholder="Por ejemplo: Alejandra Pereira" name="name" value="{{ old('name') }}"
                                required autofocus>
                        </div>
                        @error('name')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="form-label fw-medium"
                            style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                            <i class="bi bi-envelope me-1"></i>Correo Electrónico
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"
                                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                <i class="bi bi-at"></i>
                            </span>
                            <input id="email" type="email" class="form-control border-start-0"
                                style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};"
                                placeholder="Por ejemplo: miemail@gmail.com" name="email" value="{{ old('email') }}"
                                required>
                        </div>
                        @error('email')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Contraseña --}}
                    <div class="mb-4">
                        <label for="password" class="form-label fw-medium"
                            style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                            <i class="bi bi-lock me-1"></i>Contraseña
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"
                                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                <i class="bi bi-key"></i>
                            </span>
                            <input id="password" type="password" class="form-control border-start-0"
                                style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};"
                                placeholder="Ingrese una contraseña segura" name="password" required>
                            <button class="btn" type="button"
                                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};"
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
                        <label for="password_confirmation" class="form-label fw-medium"
                            style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                            <i class="bi bi-lock me-1"></i>Confirmar Contraseña
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"
                                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                <i class="bi bi-key-fill"></i>
                            </span>
                            <input id="password_confirmation" type="password" class="form-control border-start-0"
                                style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};"
                                placeholder="Confirme la contraseña ingresada anteriormente" name="password_confirmation"
                                required>
                            <button class="btn" type="button"
                                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};"
                                onclick="togglePassword('password_confirmation')">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Roles --}}
                    <div class="mb-4">
                        <label for="roles" class="form-label fw-medium"
                            style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                            <i class="bi bi-person-gear me-1"></i>Rol
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"
                                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                <i class="bi bi-shield-check"></i>
                            </span>
                            <select name="roles[]" id="roles" class="form-select border-start-0"
                                style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};">
                                <option value="role_default" selected disabled>
                                    Seleccione un rol
                                </option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('roles')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Botón de Guardar --}}
                    <div class="mt-4 pt-3 border-top text-center">
                        <button type="submit" class="btn fw-medium py-1"
                            style="background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }}; color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }}; width: 200px;">
                            <i class="bi bi-save me-2"></i>Guardar Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
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
