@extends('layouts.app')

@section('title', 'Gestión de Tenants - ' . config('app.name', 'Laravel'))

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0" style="color: #8C2D18;">
                <i class="bi bi-building me-2"></i>{{ __('Tenants') }}
            </h3>
            <a href="{{ route('dashboard') }}" class="btn btn-sm" style="background-color: #F5E8D0; color: #8C2D18;">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        {{-- Tabla de Tenants --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center"
                style="background-color: #8C2D18; color: white;">
                <h5 class="mb-0">Listado de Tenants</h5>
                <a href="{{ route('tenants.create') }}" class="btn btn-sm"
                    style="background-color: #FDF5E5; color: #8C2D18;">
                    <i class="bi bi-plus-circle"></i> Nuevo Tenant
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: #FDF5E5;">
                            <tr>
                                <th class="text-center" style="color: #8C2D18;">Nombre</th>
                                <th class="text-center" style="color: #8C2D18;">Email</th>
                                <th class="text-center" style="color: #8C2D18;">Dominio(s)</th>
                                <th class="text-center" style="color: #8C2D18;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse ($tenants as $tenant)
                                <tr>
                                    <td>{{ $tenant->name }}</td>
                                    <td>{{ $tenant->email }}</td>
                                    <td>
                                        @foreach ($tenant->domains as $domain)
                                            {{ $domain->domain }}{{ !$loop->last ? ',' : '' }}
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column flex-md-row justify-content-center gap-2">
                                            {{-- Ver --}}
                                            <a href="http://{{ $tenant->domains->first()->domain }}"
                                                class="btn btn-sm w-100 d-flex align-items-center justify-content-center gap-1"
                                                style="background-color: #BF8A49; color: white;" target="_blank">
                                                <i class="bi bi-eye"></i> Ver
                                            </a>

                                            {{-- Editar --}}
                                            <a href="{{ route('tenants.edit', $tenant) }}"
                                                class="btn btn-sm w-100 d-flex align-items-center justify-content-center gap-1"
                                                style="background-color: #8C2D18; color: white;">
                                                <i class="bi bi-pencil"></i> Editar
                                            </a>

                                            {{-- Páginas --}}
                                            <a href="{{ route('tenants.pages.edit', $tenant) }}"
                                                class="btn btn-sm w-100 d-flex align-items-center justify-content-center gap-1"
                                                style="background-color: #BF8A49; color: white;">
                                                <i class="bi bi-building-gear"></i> Páginas
                                            </a>

                                            {{-- Eliminar --}}
                                            <form action="{{ route('tenants.destroy', $tenant) }}" method="POST"
                                                onsubmit="return confirm('¿Estás seguro de eliminar este tenant?')"
                                                class="w-100">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm w-100 d-flex align-items-center justify-content-center gap-1"
                                                    style="background-color: #dc3545; color: white;">
                                                    <i class="bi bi-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-muted">No hay tenants.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
