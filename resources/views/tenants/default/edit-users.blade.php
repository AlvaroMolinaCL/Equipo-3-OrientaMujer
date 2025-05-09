@extends('tenants.default.layouts.panel')

@section('title', 'Dashboard')

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    <div class="container">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h2 class="h3 mb-0 fw-bold" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-person-gear me-2"></i>{{ __('Editar Usuario') }}
            </h2>
            <a href="{{ route('users.index') }}" class="btn btn-sm"
               style="background-color: {{ tenantSetting('button_banner_text_color', '#F5E8D0') }};
                      color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>

        {{-- Formulario --}}
        <form action="{{ route('users.update', $user) }}" method="POST" class="bg-white p-4 rounded-3 shadow-sm">
            @csrf
            @method('PUT')

            {{-- Nombre --}}
            <div class="mb-4">
                <label for="name" class="form-label fw-medium" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                    <i class="bi bi-person me-1"></i>Nombre Completo
                </label>
                <div class="input-group">
                    <span class="input-group-text"
                          style="background-color: {{ tenantSetting('button_banner_text_color', '#F5E8D0') }};
                                 color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                        <i class="bi bi-fonts"></i>
                    </span>
                    <input type="text" class="form-control border-start-0"
                           style="background-color: {{ tenantSetting('background_color', '#FDF5E5') }};"
                           id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus>
                </div>
                @error('name')
                    <div class="text-danger small mt-2">
                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="form-label fw-medium" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                    <i class="bi bi-envelope me-1"></i>Correo Electrónico
                </label>
                <div class="input-group">
                    <span class="input-group-text"
                          style="background-color: {{ tenantSetting('button_banner_text_color', '#F5E8D0') }};
                                 color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                        <i class="bi bi-at"></i>
                    </span>
                    <input type="email" class="form-control border-start-0"
                           style="background-color: {{ tenantSetting('background_color', '#FDF5E5') }};"
                           id="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>
                @error('email')
                    <div class="text-danger small mt-2">
                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Contraseña --}}
            <div class="mb-4">
                <label for="password" class="form-label fw-medium" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                    <i class="bi bi-lock me-1"></i>Contraseña (opcional)
                </label>
                <div class="input-group">
                    <span class="input-group-text"
                          style="background-color: {{ tenantSetting('button_banner_text_color', '#F5E8D0') }};
                                 color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                        <i class="bi bi-key"></i>
                    </span>
                    <input type="password" class="form-control border-start-0"
                           style="background-color: {{ tenantSetting('background_color', '#FDF5E5') }};"
                           id="password" name="password">
                    <button class="btn" type="button"
                            style="background-color: {{ tenantSetting('button_banner_text_color', '#F5E8D0') }};
                                   color: {{ tenantSetting('text_color_1', '#8C2D18') }};"
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

            {{-- Confirmar contraseña --}}
            <div class="mb-4">
                <label for="password_confirmation" class="form-label fw-medium" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                    <i class="bi bi-lock me-1"></i>Confirmar Contraseña
                </label>
                <div class="input-group">
                    <span class="input-group-text"
                          style="background-color: {{ tenantSetting('button_banner_text_color', '#F5E8D0') }};
                                 color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                        <i class="bi bi-key-fill"></i>
                    </span>
                    <input type="password" class="form-control border-start-0"
                           style="background-color: {{ tenantSetting('background_color', '#FDF5E5') }};"
                           id="password_confirmation" name="password_confirmation">
                    <button class="btn" type="button"
                            style="background-color: {{ tenantSetting('button_banner_text_color', '#F5E8D0') }};
                                   color: {{ tenantSetting('text_color_1', '#8C2D18') }};"
                            onclick="togglePassword('password_confirmation')">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            {{-- Roles --}}
            <div class="mb-4">
                <label for="roles" class="form-label fw-medium" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                    <i class="bi bi-person-gear me-1"></i>Roles
                </label>
                <div class="input-group">
                    <span class="input-group-text"
                          style="background-color: {{ tenantSetting('button_banner_text_color', '#F5E8D0') }};
                                 color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                        <i class="bi bi-shield-check"></i>
                    </span>
                    <select name="roles[]" id="roles" class="form-select border-start-0"
                            style="background-color: {{ tenantSetting('background_color', '#FDF5E5') }};">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @if(in_array($role->id, $user->roles->pluck('id')->toArray())) selected @endif>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Botón de envío --}}
            <div class="mt-4 pt-3 border-top text-center">
                <button type="submit" class="btn fw-medium py-1"
                        style="background-color: {{ tenantSetting('button_banner_color', '#8C2D18') }};
                               color: white; width: 200px;">
                    <i class="bi bi-save me-2"></i>Actualizar Usuario
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
