@extends('tenants.default.layouts.app')

@section('title', tenantSetting('name', 'Tenant'))

@section('navbar')
@section('navbar-class', 'navbar-dark-mode')
    @include('tenants.default.layouts.navigation')
@endsection

@section('body-class', 'theme-light')


@section('content')
<section class="py-5" style="margin-top: 80px;">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold mb-3">Planes Disponibles</h1>
            <p class="lead">Elige el plan que mejor se adapte a tus necesidades</p>
        </div>

        <div class="row g-4">
            @forelse($products as $product)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0 overflow-hidden">
                    @if($product->image)
                    <div class="card-img-top overflow-hidden" style="height: 200px;">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-100 h-100 object-fit-cover">
                    </div>
                    @endif
                    
                    <div class="card-body d-flex flex-column">
                        <div class="mb-3">
                            <span class="badge mb-2" style="background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }}; color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }};">
                                {{ $product->category }}
                            </span>
                            <h3 class="h4">{{ $product->name }}</h3>
                            <p class="text-muted">{{ $product->description }}</p>
                        </div>
                        
                        <div class="mt-auto">
                            <h4 class="fw-bold mb-3" style="color: {{ tenantSetting('navbar_color_2', '#8C2D18') }};">
                                ${{ number_format($product->price, 0, ',', '.') }}
                            </h4>
                            
                            <form action="{{ route('cart.add') }}" method="POST" class="mt-3">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn w-100 py-2" 
                                        style="background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }}; 
                                               color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }};
                                               border-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }};">
                                    <i class="fas fa-calendar-alt me-2"></i>Agendar Reunión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    No hay planes disponibles en este momento.
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .object-fit-cover {
        object-fit: cover;
    }
    
    .btn:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }
</style>
@endpush