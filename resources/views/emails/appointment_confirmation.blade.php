<!DOCTYPE html>
<html>

<head>
    <title>Confirmación de Cita</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .header {
            background-color: #8C2D18;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .content {
            padding: 20px;
        }

        .appointment-details {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .footer {
            margin-top: 20px;
            padding: 10px;
            text-align: center;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>¡Tu cita ha sido confirmada!</h1>
    </div>

    <div class="content">
        <p>Hola {{ $userName }},</p>
        <p>Hemos confirmado tu cita con éxito. Aquí tienes los detalles:</p>

        <div class="appointment-details">
            <h2>Detalles de la Cita</h2>
            <table>
                <tr>
                    <th>Fecha:</th>
                    <td>{{ $slot->date }}</td>
                </tr>
                <tr>
                    <th>Hora:</th>
                    <td>{{ $slot->start_time }}</td>
                </tr>
            </table>
        </div>

        @if(count($productNames))
            <h3>Productos adquiridos:</h3>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Detalle</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productNames as $name)
                        <tr>
                            <td>{{ $name }}</td>
                            <td>Incluido en tu compra</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="footer">
        <p>Si necesitas modificar o cancelar tu cita, por favor contáctanos.</p>
        <p>© {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
    </div>
</body>

</html>