@extends('tenants.default.layouts.panel')

@section('title', 'Panel de Control - ' . tenantSetting('name', 'Tenant'))

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
<div class="container mt-5">
    <h2>Crear nuevo plan de ayuda</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Título del plan</label>
            <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Tipo de ayuda legal</label>
            <select name="category" class="form-select">
                <option value="">Selecciona una categoría</option>
                @foreach ($categorias as $cat)
                    <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>
                        {{ $cat }}
                    </option>
                @endforeach
            </select>

        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" class="form-control" id="price" name="price" required step="0.01" value="{{ old('price') }}">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Imagen del plan (opcional)</label>
            <input class="form-control" type="file" id="image" name="image" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Crear plan</button>
    </form>
</div>
@endsection