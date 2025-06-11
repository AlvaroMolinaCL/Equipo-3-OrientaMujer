@extends('tenants.default.layouts.app')

@section('title', tenantPageName('forgot-password', 'Recuperar contraseña') . ' - ' . tenantSetting('name', 'Tenant'))

@section('body-class', 'theme-light')

@section('content')
    <div class="container py-3 d-flex align-items-center justify-content-center" style="min-height: 100vh; margin-top: 40px;">
        <div class="col-md-8 col-10 col-lg-6">
            <div class="shadow-lg rounded-4 overflow-hidden"
                style="background-color: {{ tenantSetting('background_color_1', '#fdf5e5') }}; border-left: 10px solid {{ tenantSetting('navbar_color_1', '#6B3A2C') }};">

                <!-- Logo -->
                <div class="text-center py-3" style="background-color: {{ tenantSetting('background_color_1', '#fdf5e5') }};">
                    <img src="{{ asset(tenantSetting('logo_path_1', 'logo/default1.png')) }}" alt="Logo del despacho"
                        style="height: 100px;" class="img-fluid">
                </div>

                <!-- Contenido -->
                <div class="p-3 bg-white">
                    <div class="text-center mb-4">
                        <h3 style="color: {{ tenantSetting('navbar_color_1', '#4A1D0B') }}; font-family: {{ tenantSetting('heading_font', 'serif') }};">
                            <i class="bi bi-key-fill me-2"></i> Recuperar contraseña
                        </h3>
                        <p class="text-muted">Ingresa tu correo electrónico para enviarte un enlace de restablecimiento.</p>
                    </div>

                    <!-- Estado de sesión -->
                    @if (session('status'))
                        <div class="alert alert-success text-center">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Correo electrónico -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="ejemplo@correo.com" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Botón -->
                        <div class="d-grid">
                            <button type="submit" class="btn text-white"
                                style="background-color: {{ tenantSetting('navbar_color_1', '#4A1D0B') }};">
                                <i class="bi bi-envelope-paper-fill me-1"></i> Enviar enlace de recuperación
                            </button>
                        </div>

                        <!-- Volver al login -->
                        <div class="mt-4 text-center">
                            <p class="text-muted">¿Recordaste tu contraseña?
                                <a href="{{ route('login') }}" class="text-decoration-none"
                                    style="color: {{ tenantSetting('navbar_color_1', '#4A1D0B') }};">
                                    Iniciar sesión
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Link para volver -->
            <div class="mt-3 text-center">
                <a href="/" class="text-decoration-none"
                    style="color: {{ tenantSetting('navbar_color_1', '#4A1D0B') }};">Volver a {{ tenantSetting('name', 'AbogaSense') }}</a>
            </div>
        </div>
    </div>
@endsection
