@extends('tenants.default.layouts.app')

@section('content')
    <div class="container">
        <div class="alert alert-danger">
            <h4>Pago Rechazado</h4>
            <p>Orden de compra: {{ $buyOrder ?? 'No disponible' }}</p>

            @isset($responseCode)
                <p>Código de error: {{ $responseCode }}</p>
            @endisset

            @isset($errorMessage)
                <p>Motivo: {{ $errorMessage }}</p>
            @endisset
        </div>

    </div>
@endsection