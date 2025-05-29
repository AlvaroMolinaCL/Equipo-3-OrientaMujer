@extends('tenants.default.layouts.app')

@section('title', 'Resumen del Agendamiento - ' . tenantSetting('name', 'Tenant'))

@section('navbar')
    @include('tenants.default.layouts.navigation')
@endsection

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <div class="row">
                <!-- Resumen del Pedido -->
                <div class="col-lg-8 mb-4">
                    <div class="bg-white rounded shadow-sm p-4">
                        <h3 class="mb-4"
                            style="font-family: {{ tenantSetting('heading_font', '') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                            Resumen de tu pedido</h3>

                        <div class="table-responsive">
                            <table class="table">
                                <thead
                                    style="background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }}; color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }};">
                                    <tr>
                                        <th>Producto</th>
                                        <th class="text-end">Precio</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-end">Subtotal</th>
                                        <th class="text-center">Acción</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if ($item->product->image ?? false)
                                                        <img src="{{ asset($item->product->image) }}" width="50"
                                                            height="50" class="rounded me-2" style="object-fit: cover;">
                                                    @endif
                                                    {{ $item->product->name ?? 'Producto no disponible' }}
                                                </div>
                                            </td>
                                            <td class="text-end">${{ number_format($item->price, 0, ',', '.') }}</td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-end">
                                                ${{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                <form action="{{ route('cart.remove.item', $item->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        title="Eliminar">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold">Total:</td>
                                        <td class="text-end fw-bold h5"
                                            style="color: {{ tenantSetting('navbar_color_2', '#8C2D18') }};">
                                            ${{ number_format(
                                                $items->sum(function ($item) {
                                                    return $item->price * $item->quantity;
                                                }),
                                                0,
                                                ',',
                                                '.',
                                            ) }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Formulario de Pago -->
                <div class="col-lg-4">
                    <div class="bg-white rounded shadow-sm p-4">
                        <h3 class="mb-4"
                            style="font-family: {{ tenantSetting('heading_font', '') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                            Método de pago</h3>

                        <form id="payment-form" action="{{ route('checkout.process') }}" method="POST">
                            @csrf

                            <!-- Datos del Cliente -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre completo</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ auth()->user()->name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ auth()->user()->email }}" required>
                            </div>

                            <!-- Métodos de Pago -->
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="credit-card"
                                        value="credit_card" checked>
                                    <label class="form-check-label" for="credit-card">
                                        <i class="fas fa-credit-card me-2"></i>Tarjeta de crédito/débito
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="transfer"
                                        value="transfer">
                                    <label class="form-check-label" for="transfer">
                                        <i class="fas fa-university me-2"></i>Transferencia bancaria
                                    </label>
                                </div>
                            </div>

                            <!-- Sección de Tarjeta de Crédito (visible solo cuando se selecciona) -->
                            <div id="credit-card-fields">
                                <div class="mb-3">
                                    <label for="card-number" class="form-label">Número de tarjeta</label>
                                    <input type="text" class="form-control" id="card-number"
                                        placeholder="1234 5678 9012 3456">
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="card-expiry" class="form-label">Fecha de expiración</label>
                                        <input type="text" class="form-control" id="card-expiry" placeholder="MM/AA">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="card-cvc" class="form-label">CVC</label>
                                        <input type="text" class="form-control" id="card-cvc" placeholder="123">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn w-100 py-2"
                                style="background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }};
                                                       color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }};">
                                <i class="fas fa-lock me-2"></i>Pagar ahora
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mostrar/ocultar campos según método de pago
            const paymentMethodRadios = document.querySelectorAll('input[name="payment_method"]');
            const creditCardFields = document.getElementById('credit-card-fields');

            function togglePaymentFields() {
                const selectedMethod = document.querySelector('input[name="payment_method"]:checked').value;
                creditCardFields.style.display = selectedMethod === 'credit_card' ? 'block' : 'none';
            }

            paymentMethodRadios.forEach(radio => {
                radio.addEventListener('change', togglePaymentFields);
            });

            // Inicializar estado
            togglePaymentFields();
        });
    </script>
@endpush

@push('styles')
    <style>
        .bg-white {
            border-radius: 0.5rem;
        }

        #credit-card-fields {
            margin-top: 1rem;
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: 0.25rem;
        }
    </style>
@endpush
