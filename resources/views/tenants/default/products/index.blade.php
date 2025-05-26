@extends('tenants.default.layouts.panel')

@section('title', 'Panel de Control - ' . tenantSetting('name', 'Tenant'))

@section('sidebar')
@include('tenants.default.layouts.sidebar')
@endsection

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Productos</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Crear Producto</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category }}</td>
                <td>${{ number_format($product->price, 0, ',', '.') }}</td>
                <td>
                    @if ($product->image)
                    <img src="{{ asset($product->image) }}" alt="Imagen del producto" class="card-img-top" style="object-fit: cover; height: 200px;">
                    @else
                    Sin imagen
                    @endif
                </td>
                <td>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No hay productos aún.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection