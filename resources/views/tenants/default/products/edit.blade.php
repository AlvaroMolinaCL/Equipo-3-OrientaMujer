@extends('tenants.default.layouts.panel')

@section('title', 'Panel de Control - ' . tenantSetting('name', 'Tenant'))

@section('sidebar')
@include('tenants.default.layouts.sidebar')
@endsection

@section('content')
<div class="container">
    <h1>Editar Producto</h1>

    <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Categoría</label>
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
                <img src="{{ asset($product->image) }}" alt="Imagen actual" style="max-height: 150px;">
            </div>
            @endif

            <input type="file" class="form-control" name="image" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" class="form-control" name="price" step="0.01" value="{{ old('price', $product->price) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" name="description">{{ old('description', $product->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection