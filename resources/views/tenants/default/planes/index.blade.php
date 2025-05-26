@extends('tenants.default.layouts.app')

@section('navbar')
@section('navbar-class', 'navbar-light-mode')
@include('tenants.default.layouts.navigation')
@endsection

@section('body-class', 'theme-light')

@section('content')
<section class="py-5" style="margin-top: 80px;">
    <div class="container">
        <h1 class="mb-4">Planes Disponibles</h1>

        <div class="row">
            @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow">
                    @if($product->image)
                    <img src="{{ asset(path: $product->image) }}" alt="Imagen del producto" class="card-img-top" style="object-fit: cover; height: 200px;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="text-muted">{{ $product->category }}</p>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="fw-bold">${{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                    <div class="card-footer text-center">
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-outline-primary">Agregar al carrito</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endsection