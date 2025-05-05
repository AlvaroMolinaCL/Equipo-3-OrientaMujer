<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ tenantSetting('name', 'Tenant') }}</title>

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Courier+Prime&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous" rel="stylesheet">
    <link href="{{ asset(tenantSetting('favicon_path', '/favicon.ico')) }}" type="image/ico" rel="shortcut icon">
    <link href="{{ asset(tenantSetting('favicon_path', '/favicon.ico')) }}" sizes="192x192" rel="shortcut icon">

    <!-- Styles and Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @php
        $tenant = tenant();
        $bannerUrl = asset(tenantSetting('banner_path', '/images/banner/Banner_Principal_OrientaMujer.png'));
    @endphp

    @if ($tenant)
        <style>
            /* Tipo de letra para la página en general */
            body {
                font-family: {{ tenantSetting('body_font', '') }}, serif;
                margin: 0;
                padding: 0;
            }

            /* Navbar */
            .navbar-light-mode {
                background-color: {{ tenantSetting('navbar_color_1', '#ffffff') }} !important;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
            }

            .navbar-dark-mode {
                background-color: {{ tenantSetting('navbar_color_2', '#000000') }} !important;
                box-shadow: 0 2px 4px rgba(35, 35, 35);
            }

            .navbar-light-mode .nav-link {
                color: {{ tenantSetting('navbar_text_color_1', '#000000') }} !important;
            }

            .navbar-dark-mode .nav-link {
                color: {{ tenantSetting('navbar_text_color_2', '#ffffff') }} !important;
            }

            /* Fondo de la página en general */
            .theme-light {
                background-color: {{ tenantSetting('background_color_1', '#ffffff') }} !important;
                color: {{ tenantSetting('text_color_1', '#000000') }};
            }

            .theme-dark {
                background-color: {{ tenantSetting('background_color_2', '#000000') }} !important;
                color: {{ tenantSetting('text_color_2', '#ffffff') }};
            }

            /* Imagen de banner de la página de Inicio */
            .hero-section {
                background: url("{{ $bannerUrl }}") no-repeat center center;
                background-size: cover;
                height: 100vh;
                position: relative;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 3rem 2rem;
                color: black;
                overflow: hidden;
            }

            /* Color de fondo y de texto del botón de la página de Inicio */
            .btn-consulta {
                background-color: {{ tenantSetting('button_banner_color', '#222222') }};
                color: {{ tenantSetting('button_banner_text_color', '#ffffff') }};
                padding: 0.75rem 2rem;
                border: none;
                font-weight: bold;
                border-radius: 30px;
                margin-bottom: 1rem;
            }
        </style>
    @endif
</head>

<body class="@yield('body-class', 'theme-light')">
    <div class="min-h-screen">

        {{-- Aquí insertamos la navbar si la vista desea incluirla --}}
        @hasSection('navbar')
            @yield('navbar')
        @endif

        {{-- Page Content --}}
        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>
