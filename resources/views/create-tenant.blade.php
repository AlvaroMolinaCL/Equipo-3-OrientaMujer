<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Crear un nuevo cliente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-900">
                    {{ session('success') }}
                </div>
            @endif

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Información del cliente') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Ingresa un nombre para el nuevo cliente. Este será su subdominio.
                        </p>
                    </header>

                    <form method="POST" action="{{ url('/create-tenant') }}" class="mt-6 space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="nombre" :value="__('Subdominio')" />
                            <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" placeholder="cliente1" required autofocus autocomplete="off" />
                            <x-input-error class="mt-2" :messages="$errors->get('nombre')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Crear Tenant') }}</x-primary-button>
                        </div>
                    </form>
                </section>
            </div>

        </div>
    </div>
</x-app-layout>
