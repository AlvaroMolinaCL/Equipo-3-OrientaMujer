@extends('tenants.default.layouts.app')

@section('navbar')
    @include('tenants.default.layouts.navigation')
@endsection

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container text-center">
            <div class="mb-4">
                <i class="fas fa-check-circle fa-5x text-success"></i>
            </div>
            <h2 class="mb-3">¡Pago completado con éxito!</h2>

            <div class="card mx-auto mb-4" style="max-width: 500px;">
                <div class="card-body">
                    <h5 class="card-title">Resumen de tu orden</h5>
                    <p class="card-text">
                        <strong>Número de orden:</strong> #{{ $order_id }}<br>
                        <strong>Total pagado:</strong> ${{ number_format($total, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            <p class="lead mb-4">Hemos enviado los detalles a tu correo electrónico.</p>

            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('products.planes') }}" class="btn btn-secondary">
                    <i class="fas fa-store me-2"></i>Ver más planes
                </a>
                <a href="{{ route('tenants.default.index') }}" class="btn" style="background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }};
                          color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }};">
                    <i class="fas fa-home me-2"></i>Volver al inicio
                </a>
            </div>
        </div>
    </section>
@endsection