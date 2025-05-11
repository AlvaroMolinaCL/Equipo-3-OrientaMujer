@extends('tenants.default.layouts.app')

@section('body-class', 'theme-light')

@section('content')
    <section class="py-3" style="margin-top: 80px;">
        <!--
                    <div class="container">
                        <h1 class="mb-4" style="font-family: {{ tenantSetting('heading_font', 'serif') }}">
                            {{ tenantPageName('login', 'Iniciar Sesión') }}
                        </h1>
                    </div>
                -->

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="d-flex flex-column flex-md-row shadow-lg rounded-4 overflow-hidden"
                        style="min-height: 500px; border-left: 10px solid {{ tenantSetting('navbar_color_1', '#6B3A2C') }};">

                        <!-- Imagen para pantallas grandes -->
                        <div class="col-md-6 d-none d-md-block p-0"
                            style="background-color: {{ tenantSetting('background_color_1', '#fdf5e5') }};">
                            <div class="h-100 w-100 d-flex align-items-center justify-content-center">
                                <img src="{{ asset(tenantSetting('logo_path_1', 'logo/default1.png')) }}"
                                    alt="Logo del despacho" class="img-fluid logo-img">
                            </div>
                        </div>

                        <!-- Formulario -->
                        <div class="col-md-6 d-flex align-items-center bg-white py-4 px-3">
                            <div class="w-100">

                                <!-- Logo para móviles -->
                                <div class="d-block d-md-none" style="border-radius: 12px;">
                                    <div class="text-center"
                                        style="background-color: {{ tenantSetting('background_color_1', '#fdf5e5') }}; border-radius: 12px;">
                                        <img class="py-3"
                                            src="{{ asset(tenantSetting('logo_path_1', 'logo/default2.png')) }}"
                                            alt="Logo móvil" style="height: 100px;" class="img-fluid mb-2">
                                    </div>
                                    <div class="p-3 text-center">
                                        <h3
                                            style="color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }}; font-family: {{ tenantSetting('heading_font', 'serif') }}">
                                            <i class="bi bi-person-circle me-2"></i>
                                            {{ tenantPageName('login', 'Iniciar Sesión') }}
                                        </h3>
                                        <p class="text-muted">Accede con tu cuenta registrada</p>
                                    </div>
                                </div>

                                <!-- Título para pantallas grandes -->
                                <div class="text-center mb-4 d-none d-md-block">
                                    <h3
                                        style="color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }}; font-family: {{ tenantSetting('heading_font', 'serif') }}">
                                        <i class="bi bi-person-circle me-2"></i>
                                        {{ tenantPageName('login', 'Iniciar Sesión') }}
                                    </h3>
                                    <p class="text-muted">Accede con tu cuenta registrada</p>
                                </div>

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Correo electrónico</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autofocus>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Contraseña</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">Recordarme</label>
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" class="btn text-white"
                                            style="background-color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                                            <i class="bi bi-box-arrow-in-right me-1"></i> Ingresar
                                        </button>
                                    </div>

                                    @if (Route::has('password.request'))
                                        <div class="mt-3 text-center">
                                            <a href="{{ route('password.request') }}" class="text-decoration-none"
                                                style="color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">¿Olvidaste
                                                tu contraseña?</a>
                                        </div>
                                    @endif
                                    @if (Route::has('register'))
                                        <div class="mt-3 text-center">
                                            <p class="text-muted">¿No tienes una cuenta?
                                                <a href="{{ route('register') }}" class="text-decoration-none"
                                                    style="color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">Registrate
                                                    aquí</a>
                                            </p>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <a href="/" class="text-decoration-none"
                        style="color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">Volver a
                        {{ tenantSetting('name', 'AbogaRed') }}</a>
                </div>
            </div>
        </div>
    </section>

    @include('tenants.default.layouts.footer')
@endsection

@section('styles')
    <style>
        .logo-img {
            max-width: 100%;
            max-height: 100%;
            height: auto;
            width: auto;
        }

        @media (max-width: 768px) {
            .logo-img {
                max-width: 100%;
                max-height: 200px;
            }
        }
    </style>
@endsection
