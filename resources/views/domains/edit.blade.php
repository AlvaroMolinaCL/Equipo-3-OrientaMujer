@extends('layouts.app')

@section('title', 'Editar Dominio Personalizado - ' . config('app.name', 'Laravel'))

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h3 class="fw-bold mb-0" style="color: #8C2D18;">
                <i class="bi bi-globe-americas me-2"></i>{{ __('Editar Dominio') }}
            </h3>
            <a href="{{ route('domains.index') }}" class="btn btn-sm" style="background-color: #F5E8D0; color: #8C2D18;">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        {{-- Formulario --}}
        <div class="card shadow border-0" style="background-color: #FDF5E5;">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('domains.update', $domain) }}"
                    class="bg-white p-4 rounded-3 shadow-sm">
                    @csrf
                    @method('PUT')

                    {{-- Dominio --}}
                    <div class="mb-4">
                        <label for="domain_name" class="form-label fw-medium" style="color: #8C2D18;">
                            <i class="bi bi-globe me-1"></i>Dominio
                        </label>
                        <div class="input-group">
                            <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                <i class="bi bi-fonts"></i>
                            </span>
                            <input id="domain_name" type="text" class="form-control border-start-0"
                                style="background-color: #FDF5E5;" name="domain_name"
                                value="{{ old('domain_name', $domain->domain) }}" required autofocus>
                        </div>
                        @error('domain_name')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Tenant --}}
                    <div class="mb-4">
                        <label for="tenant" class="form-label fw-medium" style="color: #8C2D18;">
                            <i class="bi bi-fonts me-1"></i>Tenant
                        </label>
                        <div class="input-group">
                            <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                <i class="bi bi-type"></i>
                            </span>
                            <select id="tenant" class="form-select border-start-0" style="background-color: #FDF5E5;"
                                name="tenant">
                                <option disabled>Seleccione un tenant</option>
                                @foreach ($tenants as $tenant)
                                    <option value="{{ old('tenant_id', $tenant->id) == $tenant->id ? $tenant->id : '' }}">
                                        {{ $tenant->name }} ({{ $tenant->id . '.' . config('app.domain') }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('tenant')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Botón Guardar --}}
                    <div class="mt-4 pt-3 border-top text-center">
                        <button type="submit" class="btn fw-medium py-1"
                            style="background-color: #8C2D18; color: white; width: 200px;">
                            <i class="bi bi-save me-2"></i>Actualizar Dominio
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
