@foreach ($solicitudes as $solicitud)
    <div>
        <p><strong>{{ $solicitud->name }}</strong> ({{ $solicitud->email }})</p>
        <p>{{ $solicitud->reason }}</p>
        <form method="POST" action="solicitudes-superadmin/{{ $solicitud->id }}/aprobar">
            @csrf
            <button type="submit">Aprobar y Enviar Invitación</button>
        </form>
    </div>
@endforeach
