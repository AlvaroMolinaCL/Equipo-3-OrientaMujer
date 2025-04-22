<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Crear Nuevo Tenant') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="p-4 text-sm text-green-800 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-900">
                    {{ session('success') }}
                </div>
            @endif

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Datos del Cliente') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Llena los siguientes campos para crear un nuevo tenant.
                        </p>
                    </header>

                    <form method="POST" action="{{ url('/create-tenant') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="nombre" :value="__('Subdominio')" />
                            <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('nombre')" />
                        </div>

                        <div>
                            <x-input-label for="empresa" :value="__('Nombre de la Empresa')" />
                            <x-text-input id="empresa" name="empresa" type="text" class="mt-1 block w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('empresa')" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email del Administrador')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div>
                            <x-input-label for="password" :value="__('Contraseña del Administrador')" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                        </div>

                        <div>
                            <x-input-label for="logo" :value="__('Logo de la Empresa')" />
                            <x-text-input id="logo" name="logo" type="file" class="mt-1 block w-full" accept="image/*" />
                            <x-input-error class="mt-2" :messages="$errors->get('logo')" />
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
