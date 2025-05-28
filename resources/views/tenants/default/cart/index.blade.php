@extends('tenants.default.layouts.app')

@section('navbar')
@include('tenants.default.layouts.navigation')
@endsection

@section('content')
<section class="py-5" style="margin-top: 40px;">
    <div class="container">
        <!-- Encabezado -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">Tu Carrito</h2>
            <a href="{{ route('products.planes') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Continuar comprando
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if ($items->isEmpty())
        <!-- Carrito vacío -->
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="fas fa-shopping-cart fa-4x" style="color: {{ tenantSetting('navbar_color_2', '#8C2D18') }};"></i>
            </div>
            <h4 class="mb-3">Tu carrito está vacío</h4>
            <a href="{{ route('products.planes') }}" class="btn btn-lg"
               style="background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }};
                      color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }};">
                <i class="fas fa-store me-2"></i>Explorar planes
            </a>
        </div>
        @else
        <!-- Contenido del carrito -->
        <div class="bg-white rounded shadow-sm overflow-hidden">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead style="background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }}; color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }};">
                        <tr>
                            <th class="py-3">Producto</th>
                            <th class="py-3 text-center">Cantidad</th>
                            <th class="py-3 text-end">Precio Unitario</th>
                            <th class="py-3 text-end">Subtotal</th>
                            <th class="py-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr class="align-middle">
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($item->product->image ?? false)
                                    <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" 
                                         class="rounded me-3" width="60" height="60" style="object-fit: cover;">
                                    @endif
                                    <div>
                                        <h5 class="mb-1">{{ $item->product->name ?? 'Producto no disponible' }}</h5>
                                        <small class="text-muted">{{ $item->product->category ?? '' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="quantity-form">
                                    @csrf
                                    @method('PATCH')
                                    <div class="input-group input-group-sm" style="max-width: 120px;">
                                        <button type="button" class="btn btn-outline-secondary decrement">-</button>
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="10"
                                               class="form-control text-center quantity-input">
                                        <button type="button" class="btn btn-outline-secondary increment">+</button>
                                    </div>
                                </form>
                            </td>
                            <td class="text-end">${{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="text-end fw-bold">${{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" class="text-end fw-bold">Total:</td>
                            <td class="text-end fw-bold h5" style="color: {{ tenantSetting('navbar_color_2', '#8C2D18') }};">
                                ${{ number_format($items->sum(function($item) { return $item->price * $item->quantity; }), 0, ',', '.') }}
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="bg-light p-4 border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="fas fa-broom me-2"></i>Vaciar carrito
                        </button>
                    </form>
                    
                    <a href="{{ route('checkout') }}" class="btn btn-lg"
                       style="background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }};
                              color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }};">
                        <i class="fas fa-credit-card me-2"></i>Proceder al pago
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Manejar incremento/decremento
    document.querySelectorAll('.increment').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.closest('.input-group').querySelector('.quantity-input');
            input.stepUp();
            this.closest('.quantity-form').submit();
        });
    });

    document.querySelectorAll('.decrement').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.closest('.input-group').querySelector('.quantity-input');
            input.stepDown();
            this.closest('.quantity-form').submit();
        });
    });

    // Actualizar automáticamente al cambiar el valor manualmente
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            this.closest('.quantity-form').submit();
        });
    });
});
</script>
@endpush

@push('styles')
<style>
    .table thead th {
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    .table tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
    .bg-white {
        border-radius: 0.5rem;
    }
    .input-group {
        margin: 0 auto;
    }
    .quantity-input {
        width: 40px;
    }
</style>
@endpush