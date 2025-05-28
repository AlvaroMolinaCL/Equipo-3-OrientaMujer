@extends('tenants.default.layouts.panel')

@section('title', 'Editar Plan - ' . tenantSetting('name', 'Tenant'))

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    <div class="container">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-pencil-square me-2"></i>Editar plan
            </h3>
            <a href="{{ route('products.index') }}" class="btn btn-sm" style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                           color: {{ tenantSetting('text_color_1', '#8C2D18') }};
                           border: 2px solid {{ tenantSetting('color_tables', '#8C2D18') }};">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        {{-- Errores --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulario --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header" style="background-color: {{ tenantSetting('color_tables', '#8C2D18') }};
                           color: {{ tenantSetting('button_banner_text_color', 'white') }};">
                <h5 class="mb-0">Modificar los detalles del plan</h5>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Título del plan</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Tipo de ayuda legal</label>
                        <select name="category" class="form-select">
                            <option value="">Selecciona una categoría</option>
                            @foreach ($categorias as $cat)
                                <option value="{{ $cat }}" {{ old('category', $product->category) === $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Imagen</label>
                        @if ($product->image)
                            <div class="mb-2">
                                <img src="{{ asset($product->image) }}" alt="Imagen actual" class="img-fluid rounded"
                                    style="max-height: 150px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" name="image" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Precio</label>
                        <input type="number" class="form-control" name="price" step="1"
                            value="{{ old('price', number_format($product->price, 0, '', '')) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control" name="description"
                            rows="4">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn" style="background-color: {{ tenantSetting('color_tables', '#8C2D18') }};
                                   color: {{ tenantSetting('button_banner_text_color', '#ffffff') }};">
                            <i class="bi bi-save me-1"></i> Actualizar plan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection