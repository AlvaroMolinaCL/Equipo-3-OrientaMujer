<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tenants') }}
            </h2>

            <!-- User Dropdown -->
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
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-3">Nombre</th>
                                    <th class="px-6 py-3">Email</th>
                                    <th class="px-6 py-3">Dominio</th>
                                    <th class="px-6 py-3">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tenants as $tenant)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            {{ $tenant->name }}
                                        </td>
                                        <td class="px-6 py-3">{{ $tenant->email }}</td>
                                        <td class="px-6 py-3">
                                            @foreach ($tenant->domains as $domain)
                                                {{ $domain->domain }}{{ !$loop->last ? ',' : '' }}
                                            @endforeach
                                        </td>
                                        {{-- Acciones --}}
                                        <td class="px-6 py-3">
                                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                                                {{-- Ver --}}
                                                <a href="http://{{ $tenant->domains->first()->domain }}:8000"
                                                    class="w-full h-full min-h-[44px] px-2 py-2 text-xs text-white bg-blue-500 rounded hover:bg-blue-600 text-center flex items-center justify-center">
                                                    Ver sitio
                                                </a>

                                                {{-- Editar --}}
                                                <a href="{{ route('tenants.edit', $tenant) }}"
                                                    class="w-full h-full min-h-[44px] px-2 py-2 text-xs text-white bg-yellow-500 rounded hover:bg-yellow-600 text-center flex items-center justify-center">
                                                    Editar
                                                </a>

                                                {{-- Eliminar --}}
                                                <form action="{{ route('tenants.destroy', $tenant) }}" method="POST"
                                                    onsubmit="return confirm('¿Estás seguro de eliminar este tenant?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="w-full h-full min-h-[44px] px-2 py-2 text-xs text-white bg-red-600 rounded hover:bg-red-700 text-center flex items-center justify-center">
                                                        Eliminar
                                                    </button>
                                                </form>

                                                {{-- Editar permisos --}}
                                                <a href="{{ route('tenants.permissions.edit', $tenant) }}"
                                                    class="w-full h-full min-h-[44px] px-2 py-2 text-xs text-white bg-green-500 rounded hover:bg-green-600 text-center flex items-center justify-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M3 12l2 2 4-4m4 4l2-2 4 4m-4 4l4 4m0-4l-4-4"></path>
                                                    </svg>
                                                    Permisos
                                                </a>
                                            </div>
                                        </td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <x-btn-link class="me-5 float-right mb-4" href="{{ route('tenants.create') }}">
                    Agregar Tenant
                </x-btn-link>
            </div>

        </div>
    </div>
</x-app-layout>