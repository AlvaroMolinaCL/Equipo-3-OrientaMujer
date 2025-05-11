@extends('tenants.default.layouts.app')

@section('body-class', 'theme-light')

@section('content')
    <div class="container py-3 d-flex align-items-center justify-content-center" style="min-height: 100vh; margin-top: 40px;">
        <div class="col-md-8 col-10 col-lg-6">
            <div class="shadow-lg rounded-4 overflow-hidden"
                style="background-color: {{ tenantSetting('background_color_1', '#fdf5e5') }}; border-left: 10px solid {{ tenantSetting('navbar_color_1', '#6B3A2C') }};">

                <!-- Logo arriba del formulario -->
                <div class="text-center py-3" style="background-color: {{ tenantSetting('background_color_1', '#fdf5e5') }};">
                    <img src="{{ asset(tenantSetting('logo_path_1', 'logo/default1.png')) }}" alt="Logo del despacho"
                        style="height: 100px;" class="img-fluid">
                </div>

                <div class="p-3 bg-white">

                    <!-- Encabezado -->
                    <div class="text-center mb-4">
                        <h3
                            style="color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }}; ; font-family: {{ tenantSetting('heading_font', 'serif') }}">
                            <i class="bi bi-person-plus-fill me-2"></i> Crear nueva cuenta
                        </h3>
                        <p class="text-muted">Regístrate para crear una nueva cuenta</p>
                    </div>

                    @php
                        $hayUsuarios = \App\Models\User::count() > 0;
                    @endphp

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Contraseña -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" required>
                        </div>

                        <!-- Botón -->
                        <div class="d-grid">
                            <button type="submit" class="btn text-white"
                                style="background-color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                                <i class="bi bi-check2-circle me-1"></i> Registrarse
                            </button>
                        </div>

                        <!-- Link a login -->
                        <div class="mt-4 text-center">
                            <p class="text-muted">¿Ya tienes una cuenta?
                                <a href="{{ route('login') }}" class="text-decoration-none"
                                    style="color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                                    Iniciar sesión
                                </a>
                            </p>
                        </div>
                    </form>

                </div>
            </div>
            <div class="mt-3 text-center">
                <a href="/" class="text-decoration-none"
                    style="color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">Volver a
                    {{ tenantSetting('name', 'AbogaRed') }}</a>
            </div>
        </div>
    </div>

    @include('tenants.default.layouts.footer')
@endsection
