<!DOCTYPE html>
<html>
<head>
    <title>Pago Aprobado</title>
</head>
<body>
    <h1>¡Pago Aprobado!</h1>
    <p>Orden de compra: {{ $buyOrder }}</p>
    <p>Monto: ${{ number_format($amount, 0, ',', '.') }}</p>
    <p>Código de autorización: {{ $authorizationCode }}</p>
    <p>Fecha: {{ $transactionDate }}</p>
    <a href="{{ url('/') }}">Volver al inicio</a>
</body>
</html>