@extends('tenants.default.layouts.panel')

@section('title', 'Gestión de Usuarios - ' . tenantSetting('name', 'Tenant'))

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-people me-2"></i>{{ __('Usuarios') }}
            </h3>
            <a href="{{ route('dashboard') }}" class="btn btn-sm"
                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
              color: {{ tenantSetting('text_color_1', '#8C2D18') }};
              border: 2px solid {{ tenantSetting('color_tables', '#8C2D18') }};">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        {{-- Tabla de usuarios --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center"
                style="background-color: {{ tenantSetting('color_tables', '#8C2D18') }};
                               color: {{ tenantSetting('button_banner_text_color', 'white') }};">
                <h5 class="mb-0">Listado de Usuarios</h5>
                <a href="{{ route('users.create') }}" class="btn btn-sm"
                    style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};
                                   color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                    <i class="bi bi-plus-circle"></i> Nuevo Usuario
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: {{ tenantSetting('button_banner_text_color', '#FDF5E5') }};">
                            <tr>
                                <th class="text-center" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                    Nombre</th>
                                <th class="text-center" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                    Email</th>
                                <th class="text-center" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                    Rol</th>
                                <th class="text-center" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            <span class="badge"
                                                style="background-color: {{ tenantSetting('button_color_sidebar', '#BF8A49') }};
                                                                               color: white;">
                                                {{ $role->name }}
                                            </span>{{ !$loop->last ? ' ' : '' }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($user->email == Auth::user()->email)
                                            {{-- Editar --}}
                                            <div class="d-flex flex-wrap justify-content-center align-items-center gap-2">
                                                <a href="{{ route('profile.edit', $user) }}"
                                                    class="btn btn-sm d-flex align-items-center justify-content-center gap-1"
                                                    style="background-color: {{ tenantSetting('color_tables', '#8C2D18') }};
                                                                               color: white; min-width: 100px;">
                                                    <i class="bi bi-pencil"></i> Editar
                                                </a>
                                            </div>
                                        @else
                                            <div class="d-flex flex-wrap justify-content-center align-items-center gap-2">
                                                {{-- Editar --}}
                                                <a href="{{ route('users.edit', $user) }}"
                                                    class="btn btn-sm d-flex align-items-center justify-content-center gap-1"
                                                    style="background-color: {{ tenantSetting('color_tables', '#8C2D18') }};
                                                                           color: white; min-width: 100px;">
                                                    <i class="bi bi-pencil"></i> Editar
                                                </a>

                                                {{-- Eliminar --}}
                                                <form action="{{ route('users.destroy', $user) }}" method="POST"
                                                    onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm d-flex align-items-center justify-content-center gap-1"
                                                        style="background-color: {{ tenantSetting('button_color_sidebar', '#BF8A49') }}; color: white; min-width: 100px;">
                                                        <i class="bi bi-trash"></i> Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-muted">No hay usuarios.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
