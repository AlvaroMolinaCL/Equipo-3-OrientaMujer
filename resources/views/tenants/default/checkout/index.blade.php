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
                                                        <img src="{{ asset($item->product->image) }}" width="50" height="50"
                                                            class="rounded me-2" style="object-fit: cover;">
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
                            Datos de usuario</h3>

                        <form id="payment-form" action="{{ route('checkout.process') }}" method="POST">
                            @csrf

                            <!-- Datos del Cliente -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre completo</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ auth()->user()->name }} {{ auth()->user()->last_name }} {{ auth()->user()->second_last_name }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ auth()->user()->email }}" readonly>
                            </div>

                            <!-- métodos de pago con: -->
                            <div>
                                <div class="bg-white rounded shadow-sm p-4">
                                    <form id="webpayForm" action="{{ route('checkout.process') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="total_amount" value="{{ $total }}">

                                        <div class="d-grid gap-2">
                                            <button type="submit" id="payButton" class="btn w-100 py-2" style="background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }};
                           color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }};">
                                                <i class="fas fa-credit-card me-2"></i>
                                                Pagar ${{ number_format($total, 0, ',', '.') }}
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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