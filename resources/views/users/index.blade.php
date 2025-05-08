@extends('layouts.app')

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 fw-bold mb-0" style="color: #8C2D18;">{{ __('Usuarios') }}</h2>
            <a href="{{ route('dashboard') }}" class="btn btn-sm" style="background-color: #F5E8D0; color: #8C2D18;">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>

        {{-- Tabla de usuarios --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center"
                style="background-color: #8C2D18; color: white;">
                <h5 class="mb-0">Listado de Usuarios</h5>
                <a href="{{ route('users.create') }}" class="btn btn-sm" style="background-color: #FDF5E5; color: #8C2D18;">
                    <i class="bi bi-plus-circle"></i> Nuevo Usuario
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: #FDF5E5;">
                            <tr>
                                <th class="text-center" style="color: #8C2D18;">Nombre</th>
                                <th class="text-center" style="color: #8C2D18;">Email</th>
                                <th class="text-center" style="color: #8C2D18;">Roles</th>
                                <th class="text-center" style="color: #8C2D18;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            <span class="badge" style="background-color: #BF8A49; color: white;">
                                                {{ $role->name }}
                                            </span>{{ !$loop->last ? ' ' : '' }}
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap justify-content-center gap-2">
                                            {{-- Editar --}}
                                            <a href="{{ route('users.edit', $user) }}"
                                                class="btn btn-sm d-flex align-items-center justify-content-center gap-1 flex-grow-1"
                                                style="background-color: #8C2D18; color: white; min-width: 100px;">
                                                <i class="bi bi-pencil"></i> Editar
                                            </a>

                                            {{-- Eliminar --}}
                                            <form action="{{ route('users.destroy', $user) }}" method="POST"
                                                onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')"
                                                class="flex-grow-1">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm d-flex align-items-center justify-content-center gap-1 w-100"
                                                    style="background-color: #dc3545; color: white; min-width: 100px;">
                                                    <i class="bi bi-trash"></i> Eliminar
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
@endsection