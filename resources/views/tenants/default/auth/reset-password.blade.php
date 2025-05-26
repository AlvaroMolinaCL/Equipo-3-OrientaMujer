@extends('tenants.default.layouts.app')

@section('title', tenantPageName('reset-password', 'Restablecer contraseña') . ' - ' . tenantSetting('name', 'Tenant'))

@section('body-class', 'theme-light')

@section('content')
    <div class="container py-3 d-flex align-items-center justify-content-center"
        style="min-height: 100vh; margin-top: 40px;">
        <div class="col-md-8 col-10 col-lg-6">
            <div class="shadow-lg rounded-4 overflow-hidden"
                style="background-color: {{ tenantSetting('background_color_1', '#fdf5e5') }}; border-left: 10px solid {{ tenantSetting('navbar_color_1', '#6B3A2C') }};">

                <!-- Logo -->
                <div class="text-center py-3"
                    style="background-color: {{ tenantSetting('background_color_1', '#fdf5e5') }};">
                    <img src="{{ asset(tenantSetting('logo_path_1', 'logo/default1.png')) }}" alt="Logo del despacho"
                        style="height: 100px;" class="img-fluid">
                </div>

                <!-- Contenido -->
                <div class="p-3 bg-white">
                    <div class="text-center mb-4">
                        <h3
                            style="color: {{ tenantSetting('navbar_color_1', '#4A1D0B') }}; font-family: {{ tenantSetting('heading_font', 'serif') }};">
                            <i class="bi bi-shield-lock-fill me-2"></i> Restablecer contraseña
                        </h3>
                        <p class="text-muted">Por favor, ingresa tu correo y la nueva contraseña.</p>
                    </div>

                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Correo -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input id="email" type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $request->email) }}" readonly>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nueva contraseña -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Nueva contraseña</label>
                            <input type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" required
                                autocomplete="new-password" />
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirmar contraseña -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror" required
                                autocomplete="new-password" />
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Botón -->
                        <div class="d-grid">
                            <button type="submit" class="btn text-white"
                                style="background-color: {{ tenantSetting('navbar_color_1', '#4A1D0B') }};">
                                <i class="bi bi-arrow-repeat me-1"></i> Restablecer contraseña
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            <!-- Link para volver -->
            <div class="mt-3 text-center">
                <a href="{{ route('login') }}" class="text-decoration-none"
                    style="color: {{ tenantSetting('navbar_color_1', '#4A1D0B') }};">Volver a iniciar sesión</a>
            </div>
        </div>
    </div>

    @include('tenants.default.layouts.footer')
@endsection