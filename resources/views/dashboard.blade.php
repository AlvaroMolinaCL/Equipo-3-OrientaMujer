<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Panel de control') }}
            <!-- Settings Dropdown -->
             
            <div class="hidden sm:hidden lg:block ml-4 float-right sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Metric Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg p-5">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Usuarios Registrados</div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-white">245</div>
                    {{-- Reemplazar con: {{ $userCount }} --}}
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg p-5">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Nuevos Ingresos Hoy</div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-white">12</div>
                    {{-- Reemplazar con: {{ $newUsersToday }} --}}
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg p-5">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Suscripciones Activas</div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-white">83</div>
                    {{-- Reemplazar con: {{ $activeSubscriptions }} --}}
                </div>
            </div>

            {{-- Table Example --}}
            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
                <div
                    class="p-6 border-b border-gray-200 dark:border-gray-700 text-lg font-medium text-gray-900 dark:text-white">
                    Últimos Usuarios Registrados
                </div>
                <div class="p-4 overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-300">
                        <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nombre</th>
                                <th scope="col" class="px-6 py-3">Email</th>
                                <th scope="col" class="px-6 py-3">Fecha Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Repetir esta fila dinámicamente con @foreach --}}
                            <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4">Juan Pérez</td>
                                <td class="px-6 py-4">juan@example.com</td>
                                <td class="px-6 py-4">01/05/2025</td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4">María Gómez</td>
                                <td class="px-6 py-4">maria@example.com</td>
                                <td class="px-6 py-4">01/05/2025</td>
                            </tr>
                            {{-- Fin de loop --}}
                        </tbody>
                    </table>
                </div>
            </div>
            <x-btn-link class="ml-4 float-right" href="{{ route('tenants.index') }}">Ver tenants</x-btn-link>


        </div>
    </div>
</x-app-layout>