<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased" x-data="{ sidebarOpen: false, dropdownOpen: false }">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex relative">
        <!-- Botón Hamburger personalizado -->
        <div class="absolute top-4 right-4 z-50 lg:hidden">
            <button @click="sidebarOpen = !sidebarOpen"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-300 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-700 transition duration-150 ease-in-out">

                <!-- Icono de menú (3 líneas) -->
                <svg x-show="!sidebarOpen" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                    <rect y="4" width="20" height="2" rx="1"></rect>
                    <rect y="9" width="20" height="2" rx="1"></rect>
                    <rect y="14" width="20" height="2" rx="1"></rect>
                </svg>

                <!-- Icono de cerrar (X) -->
                <svg x-show="sidebarOpen" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                    <line x1="4" y1="4" x2="16" y2="16" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" />
                    <line x1="16" y1="4" x2="4" y2="16" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" />
                </svg>
            </button>
        </div>

        <!-- Sidebar -->
        <aside :class="{'-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen}" 
               class="w-64 bg-white dark:bg-gray-800 shadow-md fixed inset-y-0 left-0 transform transition-transform duration-300 lg:translate-x-0 lg:static lg:inset-0 z-40" 
               id="sidebar">
            <div class="flex flex-col h-full">
                <!-- Scrollable Sidebar Content -->
                <div class="p-4 flex-1 overflow-y-auto">
                    <!-- Logo centrado -->
                    <div class="flex justify-center items-center">
                        <a href="{{ route('dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                        </a>
                    </div>

                    <ul class="mt-4 space-y-2">
                        <li>
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded {{ Route::is('dashboard') ? 'bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                                Panel de control
                            </a>
                        </li>
                        <li x-data="{
                            open: JSON.parse(localStorage.getItem('tenantsDropdown')) || {{ Route::is('tenants.*') ? 'true' : 'false' }},
                            toggle() {
                                this.open = !this.open;
                                localStorage.setItem('tenantsDropdown', this.open);
                            }
                        }">
                            <button @click="toggle"
                                class="w-full flex justify-between items-center px-4 py-2 rounded 
                                    {{ Route::is('tenants.*') ? 'bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                                <span>Tenants</span>
                                <svg :class="{ 'transform rotate-180': open }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <ul x-show="open" x-transition class="ml-6 mt-1 space-y-1 text-sm">
                                <li>
                                    <a href="{{ route('tenants.index') }}"
                                        class="block px-4 py-2 rounded 
                                            {{ Route::is('tenants.index') ? 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                        Ver Tenants
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('tenants.create') }}"
                                        class="block px-4 py-2 rounded 
                                            {{ Route::is('tenants.create') ? 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                        Añadir Tenant
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li x-data="{
                            open: false,
                            toggle() {
                                this.open = !this.open;
                            }
                        }">
                            <button @click="toggle"
                                class="w-full flex justify-between items-center px-4 py-2 rounded text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">
                                <span>Roles</span>
                                <svg :class="{ 'transform rotate-180': open }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <ul x-show="open" x-transition class="ml-6 mt-1 space-y-1 text-sm">
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 rounded text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Ver Roles
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 rounded text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Añadir Rol
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li x-data="{
                            open: false,
                            toggle() {
                                this.open = !this.open;
                            }
                        }">
                            <button @click="toggle"
                                class="w-full flex justify-between items-center px-4 py-2 rounded text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">
                                <span>Permisos</span>
                                <svg :class="{ 'transform rotate-180': open }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <ul x-show="open" x-transition class="ml-6 mt-1 space-y-1 text-sm">
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 rounded text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Ver Permisos
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 rounded text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Añadir Permiso
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <!-- Profile and Log Out Dropdown for Mobile -->
                <div class="mt-4 border-gray-200 dark:border-gray-700 pt-4 lg:hidden">
                    <div class="px-4 border-t border-b border-gray-200 dark:border-gray-700">
                        <button @click="dropdownOpen = !dropdownOpen" class="w-full flex items-center justify-between px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded focus:outline-none">
                            <div class="text-start">
                                <div class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
                            </div>
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>
                    <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="mt-2 space-y-2 px-4">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded">
                            Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left block px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>

                <!-- User Info for Large Screens -->
                <div class="border-t border-gray-200 dark:border-gray-700 p-4 sticky bottom-0 bg-white dark:bg-gray-800 hidden lg:block">
                    <div class="text-start">
                        <div class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Overlay for mobile -->
        <div @click="sidebarOpen = false" 
             :class="{'hidden': !sidebarOpen, 'block': sidebarOpen}" 
             class="fixed inset-0 bg-black bg-opacity-50 z-30"></div>

        <!-- Main Content -->
        <div class="flex-1 transition-all duration-300" id="main-content">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>