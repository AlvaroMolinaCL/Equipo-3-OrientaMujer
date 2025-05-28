<!DOCTYPE html>
<html>
<head>
    <title>Confirmación de Pedido</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .header { background-color: #8C2D18; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        .order-details { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        .total { font-weight: bold; font-size: 1.2em; }
        .footer { margin-top: 20px; padding: 10px; text-align: center; font-size: 0.9em; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <h1>¡Gracias por tu compra!</h1>
    </div>
    
    <div class="content">
        <p>Hola {{ $order->user->name }},</p>
        <p>Hemos recibido tu pedido con éxito. Aquí tienes los detalles:</p>
        
        <div class="order-details">
            <h2>Detalles del Pedido #{{ $order->id }}</h2>
            <p><strong>Fecha:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Método de pago:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
        </div>
        
        <h3>Productos:</h3>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>${{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="total">Total:</td>
                    <td class="total">${{ number_format($order->total, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    
    <div class="footer">
        <p>Si tienes alguna pregunta, no dudes en contactarnos.</p>
        <p>© {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
    </div>
</body>
</html>