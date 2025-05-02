<x-tenant-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Usuarios') }}
            <x-btn-link class="ml-4 float-right" href="{{ route('users.create') }}">Añadir usuario</x-btn-link>
        </h2>
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
                                    <th class="px-6 py-3">Rol</th>
                                    <th class="px-6 py-3">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            {{ $user->name }}
                                        </td>
                                        <td class="px-6 py-3">{{ $user->email }}</td>
                                        <td class="px-6 py-3">
                                            @foreach ($user->roles as $role)
                                                {{ $role->name }}{{ !$loop->last ? ',' : '' }}
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-3">
                                            <div class="flex flex-wrap justify-center gap-1">

                                                {{-- Editar --}}
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="flex items-center gap-1 px-2 py-1 bg-yellow-500 text-white rounded text-xs hover:bg-yellow-600">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M11 5h2M12 7v12m-6 0h12a2 2 0 002-2V7a2 2 0 00-2-2h-3.586a1 1 0 01-.707-.293l-1.414-1.414a1 1 0 00-.707-.293H9a1 1 0 00-.707.293L6.879 4.707A1 1 0 016.172 5H4a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                    </svg>
                                                    Editar
                                                </a>

                                                {{-- Eliminar --}}
                                                <form action="{{ route('users.destroy', $user) }}" method="POST"
                                                    onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="flex items-center gap-1 px-2 py-1 bg-red-600 text-white rounded text-xs hover:bg-red-700">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            stroke-width="2" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-tenant-app-layout>
