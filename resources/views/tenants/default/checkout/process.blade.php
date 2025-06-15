@extends('tenants.default.layouts.app')

@section('title', 'Procesando pago - ' . tenantSetting('name', 'Tenant'))

@section('content')
    <div class="container d-flex flex-column align-items-center justify-content-center py-5" style="min-height: 60vh;">
        <div class="spinner-border text-success" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Cargando...</span>
        </div>
        <h3 class="mt-4" style="font-family: {{ tenantSetting('heading_font', 'Poppins, sans-serif') }}; font-weight: 600;">
            Preparando pago seguro...
        </h3>
        <p class="text-muted">Por favor espera un momento mientras conectamos con el sistema de pago</p>

        <form id="paymentForm" action="{{ route('transbank.create') }}" method="POST">
            @csrf
            <input type="hidden" name="amount" value="{{ $amount }}">
            <noscript>
                <p class="mt-3 text-danger">JavaScript está deshabilitado. Haz clic para continuar.</p>
                <button type="submit" class="btn btn-success">Continuar</button>
            </noscript>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Auto-enviar el formulario
            document.getElementById('paymentForm').submit();
        });
    </script>
@endsection