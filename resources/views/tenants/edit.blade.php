<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Tenant') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('tenants.update', $tenant) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div>
                            <x-input-label for="name" :value="__('Nombre')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $tenant->name)" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $tenant->email)" required autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Dominio -->
                        <div class="mt-4">
                            <x-input-label for="domain_name" :value="__('Dominio')" />
                            <x-text-input id="domain_name" class="block mt-1 w-full" type="text" name="domain_name" :value="old('domain_name', $tenant->domains->first()->domain)" required autocomplete="domain_name" />
                            <x-input-error :messages="$errors->get('domain_name')" class="mt-2" />
                        </div>

                        <!-- Contraseña -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Contraseña (opcional)')" />
                            <x-text-input id="password" class="block mt-1 w-full"
                                        type="password" name="password" autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                        type="password" name="password_confirmation" autocomplete="new-password" />
                        </div>

                        <!-- Botón de actualizar -->
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Actualizar Tenant') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
