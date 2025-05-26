@extends('tenants.default.layouts.panel')

@section('title', 'Editar Rol - ' . tenantSetting('name', 'Tenant'))

@section('navbar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h3 class="fw-bold mb-0" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-person-gear me-2"></i>Editar Rol
            </h3>
            <a href="{{ route('roles.index') }}" class="btn btn-sm"
                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                  color: {{ tenantSetting('text_color_1', '#8C2D18') }};
                  border: 2px solid {{ tenantSetting('color_tables', '#8C2D18') }};">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        {{-- Formulario --}}
        <div class="card shadow border-0" style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('roles.update', $role->id) }}"
                    class="bg-white p-4 rounded-3 shadow-sm">
                    @csrf
                    @method('PUT')

                    <h5 class="fw-medium mb-3"
                        style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};">
                        <i class="bi bi-info-circle me-2"></i>Información del Rol
                    </h5>

                    {{-- Nombre --}}
                    <div class="mb-4">
                        <label for="rol_name" class="form-label fw-medium"
                            style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};">
                            <i class="bi bi-globe me-1"></i>Nombre
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"
                                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                <i class="bi bi-fonts"></i>
                            </span>
                            <input id="rol_name" type="text" class="form-control border-start-0" name="rol_name"
                                value="{{ old('rol_name', $role->name) }}" required>
                        </div>
                        @error('rol_name')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Permisos --}}
                    <div class="mb-4">
                        <label class="form-label fw-medium"
                            style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};">
                            <i class="bi bi-shield-lock me-1"></i>Permisos del Rol
                        </label>
                        <div class="row">
                            @foreach ($permissions as $permission)
                                <div class="col-md-4 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                            value="{{ $permission->name }}" id="perm-{{ $permission->id }}"
                                            {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="perm-{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Botón Guardar --}}
                    <div class="mt-4 pt-3 border-top text-center">
                        <button type="submit" class="btn fw-medium py-1"
                            style="background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }}; color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }}; width: 200px;">
                            <i class="bi bi-save me-2"></i>Actualizar Rol
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
