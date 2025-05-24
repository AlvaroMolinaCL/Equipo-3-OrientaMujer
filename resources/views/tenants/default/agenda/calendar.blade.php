@extends('tenants.default.layouts.panel')

@section('title', 'Disponibilidad')

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
<div class="container">
    <h3 class="mb-4">Calendario de Disponibilidad</h3>
    <div id="calendar"></div>
    <div id="day-details" class="mt-4"></div>
</div>

{{-- FullCalendar --}}
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        height: 600,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: ''
        },
        events: '/api/available-slots',
        dateClick: function(info) {
            fetch(`/api/available-slots?date=${info.dateStr}`)
                .then(res => res.json())
                .then(data => {
                    const cont = document.getElementById('day-details');
                    cont.innerHTML = `<h5>Horarios del ${info.dateStr}</h5>`;

                    cont.innerHTML += `
                        <form action="/available-slots" method="POST" class="mb-4">
                            <input type="hidden" name="_token" value="${document.querySelector('meta[name=csrf-token]').content}">
                            <input type="hidden" name="mode" value="puntual">
                            <input type="hidden" name="date" value="${info.dateStr}">
                            <div class="row g-2 align-items-center">
                                <div class="col-md-4">
                                    <input name="start_time" type="time" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <input name="end_time" type="time" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-sm btn-primary">+ Agregar Horario</button>
                                </div>
                            </div>
                        </form>
                    `;

                    if (data.length === 0) {
                        cont.innerHTML += '<p>No hay horarios agregados para este día.</p>';
                        return;
                    }

                    data.forEach(slot => {
                        cont.innerHTML += `
                            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                <div><strong>${slot.start_time} - ${slot.end_time}</strong></div>
                                <div>
                                    <a href="/available-slots/${slot.id}/edit" class="btn btn-sm btn-secondary me-2">Editar</a>
                                    <form method="POST" action="/available-slots/${slot.id}" style="display:inline;">
                                        <input type="hidden" name="_token" value="${document.querySelector('meta[name=csrf-token]').content}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        `;
                    });
                });
        }
    });

    calendar.render();
});
</script>
@endsection