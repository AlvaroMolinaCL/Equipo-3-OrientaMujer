@extends('tenants.default.layouts.panel')

@section('title', 'Gestión de Roles - ' . tenantSetting('name', 'Tenant'))

@section('navbar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-person-check me-2"></i>{{ __('Roles') }}
            </h3>
            <a href="{{ route('dashboard') }}" class="btn btn-sm"
                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                  color: {{ tenantSetting('text_color_1', '#8C2D18') }};
                  border: 2px solid {{ tenantSetting('color_tables', '#8C2D18') }};">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        {{-- Tabla de Roles --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center"
                style="background-color: {{ tenantSetting('color_tables', '#8C2D18') }}; color: {{ tenantSetting('button_banner_text_color', 'white') }};">
                <h5 class="mb-0">Listado de Roles</h5>
                <a href="{{ route('roles.create') }}" class="btn btn-sm"
                    style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                    <i class="bi bi-plus-circle"></i> Nuevo Rol
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: #FDF5E5;">
                            <tr>
                                <th class="text-center" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                    Nombre</th>
                                <th class="text-center" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse ($roles as $rol)
                                <tr>
                                    <td>{{ $rol->name }}</td>
                                    <td>
                                        <div class="d-flex flex-wrap justify-content-center align-items-center gap-2">
                                            @if ($rol->name == 'Admin')
                                                <div class="text-danger small">
                                                    <i class="bi bi-exclamation-circle me-1"></i>No puede editar ni eliminar
                                                    este rol por defecto del sistema.
                                                </div>
                                            @else
                                                {{-- Editar --}}
                                                <a href="{{ route('roles.edit', $rol) }}"
                                                    class="btn btn-sm d-flex align-items-center justify-content-center gap-1"
                                                    style="background-color: {{ tenantSetting('color_tables', '#8C2D18') }}; color: {{ tenantSetting('button_banner_text_color', 'white') }}; min-width: 100px;">
                                                    <i class="bi bi-pencil"></i> Editar
                                                </a>

                                                {{-- Eliminar --}}
                                                <form action="{{ route('roles.destroy', $rol) }}" method="POST"
                                                    onsubmit="return confirm('¿Estás seguro de eliminar este tenant?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm d-flex align-items-center justify-content-center gap-1"
                                                        style="background-color: {{ tenantSetting('button_color_sidebar', '#BF8A49') }}; color: white; min-width: 100px;">
                                                        <i class="bi bi-trash"></i> Eliminar
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center py-3 text-muted">No hay roles.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
