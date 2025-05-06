@extends('layouts.app')

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
    <div class="container">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h2 mb-0">{{ __('Tenants') }}</h2>
            <a href="{{ route('tenants.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Agregar Tenant
            </a>
        </div>

        {{-- Tabla de tenants --}}
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Dominio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tenants as $tenant)
                        <tr>
                            <td>{{ $tenant->name }}</td>
                            <td>{{ $tenant->email }}</td>
                            <td>
                                @foreach ($tenant->domains as $domain)
                                    {{ $domain->domain }}{{ !$loop->last ? ',' : '' }}
                                @endforeach
                            </td>
                            <td>
                                <div class="d-flex flex-wrap justify-content-center gap-2">
                                    {{-- Ver --}}
                                    <a href="http://{{ $tenant->domains->first()->domain }}"
                                        class="btn btn-sm btn-primary d-flex align-items-center gap-1">
                                        <i class="bi bi-eye"></i> Ver Sitio
                                    </a>

                                    {{-- Editar --}}
                                    <a href="{{ route('tenants.edit', $tenant) }}"
                                        class="btn btn-sm btn-warning d-flex align-items-center gap-1">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>

                                    {{-- Eliminar --}}
                                    <form action="{{ route('tenants.destroy', $tenant) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro de eliminar este tenant?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-danger d-flex align-items-center gap-1">
                                            <i class="bi bi-x-circle"></i> Eliminar
                                        </button>
                                    </form>

                                    {{-- Permisos --}}
                                    <!--
                                        <a href="{{ route('tenants.permissions.edit', $tenant) }}"
                                            class="btn btn-sm btn-success d-flex align-items-center gap-1">
                                            <i class="bi bi-person-gear"></i> Permisos
                                        </a>
                                        -->
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
