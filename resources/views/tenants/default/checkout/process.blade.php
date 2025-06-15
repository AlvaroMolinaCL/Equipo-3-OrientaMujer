@extends('tenants.default.layouts.app')

@section('content')
<div class="container text-center py-5">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Cargando...</span>
    </div>
    <h3 class="mt-3">Preparando pago seguro...</h3>

    <form id="paymentForm" action="{{ route('transbank.create') }}" method="POST">
        @csrf
        <input type="hidden" name="amount" value="{{ $amount }}">
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-enviar el formulario
    document.getElementById('paymentForm').submit();
});
</script>
@endsection