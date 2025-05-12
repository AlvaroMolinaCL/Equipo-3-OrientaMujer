<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ tenantSetting('name', 'Tenant') }} - @yield('title', 'Panel')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Courier+Prime&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">

    @stack('styles')

    <style>
        :root {
            --color-primary:
                {{ tenantSetting('navbar_color_1', '#BF8A49') }}
            ;
            --color-secondary:
                {{ tenantSetting('navbar_color_2', '#BF8A49') }}
            ;
            --color-light:
                {{ tenantSetting('background_color_1', '#FDF5E5') }}
            ;
            --color-sidebar:
                {{ tenantSetting('navbar_color_1', 'rgb(68, 30, 8)') }}
            ;
            --text-color:
                {{ tenantSetting('text_color_1', '#000') }}
            ;
        }

        .sidebar {
            width: 250px;
            transition: transform 0.3s ease;
            z-index: 1040;
            background-color: var(--color-sidebar);
        }

        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .mobile-navbar {
                position: sticky;
                top: 0;
                z-index: 1030;
                background-color: var(--color-sidebar) !important;
            }

            .mobile-navbar .navbar-brand,
            .mobile-navbar .navbar-toggler-icon {
                color: white !important;
            }
        }

        .main-content {
            margin-left: 0;
            transition: margin-left 0.3s ease;
            width: 100%;
        }

        @media (min-width: 992px) {
            .main-content {
                margin-left: 250px;
                width: calc(100% - 250px);
            }

            .sidebar {
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
            }
        }

        .sidebar-header {
            height: 56px;
            background-color: var(--color-secondary);
            color: white;
        }

        .sidebar-header .btn-close {
            filter: invert(1);
        }

        .btn-primary {
            background-color: var(--color-primary);
            border-color: var(--color-primary);
        }

        .btn-outline-primary {
            color: var(--color-primary);
            border-color: var(--color-primary);
        }

        .btn-outline-primary:hover {
            background-color: var(--color-primary);
            color: white;
        }

        /* Navbar */
        .navbar-light .navbar-nav .nav-link {
            color: var(--color-secondary);
        }

        .navbar-light .navbar-nav .nav-link.active {
            background-color: rgba(191, 138, 73, 0.2);
            color: var(--color-secondary);
            font-weight: 500;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 30 30'%3e%3cpath stroke='white' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .navbar-toggler {
            border: 2px solid white;
            border-radius: 8px;
            padding: 6px 10px;
        }

        .navbar-toggler:focus {
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.5);
        }
    </style>
</head>

<body class="@yield('body-class', 'theme-light')" style="background: linear-gradient(to right, {{ tenantSetting('background_color_1', '#FFF') }} 0%, {{ tenantSetting('background_color_2', '#FFF') }} 100%);
             color: {{ tenantSetting('text_color_1', '#000') }}; 
             font-family: {{ tenantSetting('body_font', 'Arial') }};">


    <div class="d-flex flex-column min-vh-100">
        <!-- Navbar para móviles -->
        <nav class="navbar navbar-expand-lg navbar-light mobile-navbar d-lg-none"
            style="background-color: {{ tenantSetting('navbar_color_1', '#BF8A49') }};">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" onclick="toggleSidebar()">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand mx-auto" href="{{ route('dashboard') }}">
                    <img src="{{ asset(tenantSetting('logo_path_1', 'images/default-logo.png')) }}" alt="Logo"
                        style="height: 44px;">
                </a>
            </div>
        </nav>


        <div class="d-flex flex-grow-1">
            <!-- Sidebar -->
            @hasSection('sidebar')
                <div class="sidebar d-flex flex-column" id="sidebar">
                    <div class="sidebar-header p-3 d-flex d-lg-none justify-content-between align-items-center">
                        <h5 class="mb-0">Menú</h5>
                        <button type="button" class="btn-close" onclick="toggleSidebar()"></button>
                    </div>
                    <div class="flex-grow-1 overflow-auto">
                        @include('tenants.default.layouts.sidebar')
                    </div>
                </div>
            @endif

            <!-- Contenido principal -->
            <main class="main-content flex-grow-1 p-3">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
            document.body.style.overflow = sidebar.classList.contains('show') ? 'hidden' : '';
        }

        document.addEventListener('DOMContentLoaded', function () {
            window.addEventListener('resize', function () {
                if (window.innerWidth >= 992) {
                    const sidebar = document.getElementById('sidebar');
                    sidebar.classList.remove('show');
                    document.body.style.overflow = '';
                }
            });
        });
    </script>
</body>

</html>