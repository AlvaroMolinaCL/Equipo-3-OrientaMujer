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
            <a href="{{ route('tenants.index') }}" class="btn btn-sm" 
               style="background-color: #F5E8D0; color: #8C2D18;">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>

        <form method="POST" action="{{ route('tenants.store') }}" class="bg-white p-4 rounded-3 shadow-sm">
            @csrf

            {{-- Campo Nombre --}}
            <div class="mb-4">
                <label for="name" class="form-label fw-medium" style="color: #8C2D18;">
                    <i class="bi bi-fonts me-1"></i>Nombre del Tenant
                </label>
                <div class="input-group">
                    <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                        <i class="bi bi-building"></i>
                    </span>
                    <input id="name" type="text" class="form-control border-start-0" 
                           style="background-color: #FDF5E5;" name="name" 
                           value="{{ old('name') }}" required autofocus>
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
                    <input id="email" type="email" class="form-control border-start-0" 
                           style="background-color: #FDF5E5;" name="email" 
                           value="{{ old('email') }}" required>
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
                    <input id="domain_name" type="text" class="form-control border-start-0" 
                           style="background-color: #FDF5E5;" name="domain_name" 
                           value="{{ old('domain_name') }}" required>
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

            {{-- Campo Confirmar Contraseña --}}
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

            {{-- Botón de submit --}}
            <div class="mt-4 pt-3 border-top text-center">
                <button type="submit" class="btn fw-medium py-1" 
                        style="background-color: #8C2D18; color: white; width: 200px;">
                    <i class="bi bi-save me-2"></i>Guardar Tenant
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