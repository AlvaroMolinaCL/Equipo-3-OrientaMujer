@extends('tenants.default.layouts.app')

@section('navbar')
    @section('navbar-class', 'navbar-light-mode')
    @include('tenants.default.layouts.navigation')
@endsection

@section('body-class', 'theme-light')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Planes Disponibles</h1>

    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="text-muted">{{ $product->category }}</p>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="fw-bold">${{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="#" class="btn btn-primary">Escoger Plan</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
