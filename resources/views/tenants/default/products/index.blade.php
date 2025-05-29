@extends('tenants.default.layouts.panel')

@section('title', 'Gestión de Planes - ' . tenantSetting('name', 'Tenant'))

@section('content')
    <div class="container">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-card-checklist me-2"></i>Gestión de Planes
            </h3>
            <a href="{{ route('dashboard') }}" class="btn btn-sm"
                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                           color: {{ tenantSetting('text_color_1', '#8C2D18') }};
                           border: 2px solid {{ tenantSetting('color_tables', '#8C2D18') }};">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        {{-- Éxito --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Tabla --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center"
                style="background-color: {{ tenantSetting('color_tables', '#8C2D18') }};
                           color: {{ tenantSetting('button_banner_text_color', 'white') }};">
                <h5 class="mb-0">Listado de Planes</h5>
                {{-- Botón Crear --}}
                <a href="{{ route('products.create') }}" class="btn btn-sm"
                    style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};
                                       color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                    <i class="bi bi-plus-circle me-1"></i>Nuevo Plan
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 text-center">
                        <thead style="background-color: {{ tenantSetting('button_banner_text_color', '#FDF5E5') }};">
                            <tr>
                                <th style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">Nombre</th>
                                <th style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">Categoría</th>
                                <th style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">Precio</th>
                                <th style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">Imagen</th>
                                <th style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category }}</td>
                                    <td>${{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>
                                        @if ($product->image)
                                            <img src="{{ asset($product->image) }}" alt="Imagen del producto"
                                                style="object-fit: cover; height: 80px; width: auto; border-radius: 8px;">
                                        @else
                                            <span class="text-muted">Sin imagen</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column flex-md-row justify-content-center gap-2">
                                            <a href="{{ route('products.edit', $product) }}"
                                                class="btn btn-sm d-flex align-items-center justify-content-center gap-1 flex-grow-2"
                                                style="background-color: {{ tenantSetting('color_tables', '#8C2D18') }};
                                                                           color: white; min-width: 100px;">
                                                <i class="bi bi-pencil-square"></i> Editar
                                            </a>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST"
                                                onsubmit="return confirm('¿Seguro que deseas eliminar este producto?')"
                                                style="width: 100px;">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="btn btn-sm d-flex align-items-center justify-content-center gap-1 flex-grow-2"
                                                    style="background-color: #dc3545; color: white; min-width: 100px;">
                                                    <i class="bi bi-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-3 text-muted">No hay planes.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
