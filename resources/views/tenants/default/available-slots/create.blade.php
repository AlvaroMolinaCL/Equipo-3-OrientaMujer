@extends('tenants.default.layouts.panel')

@section('title', 'Crear Carga de Horarios - ' . tenantSetting('name', 'Tenant'))

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h3 class="fw-bold mt-3 mb-0" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
            <i class="bi bi-calendar-plus me-2"></i>Carga de Horarios
        </h3>
        <a href="{{ route('available-slots.index') }}" class="btn btn-sm"
            style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                color: {{ tenantSetting('text_color_1', '#8C2D18') }};
                border: 2px solid {{ tenantSetting('color_tables', '#8C2D18') }};">
            <i class="bi bi-arrow-left me-2"></i>Volver
        </a>
    </div>

    <form action="{{ route('schedule-batches.store') }}" method="POST">
        @csrf

        {{-- Selección de cantidad de días --}}
        <div class="mb-4">
            <label for="daysCount" class="form-label fw-bold" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                ¿Cuántos días deseas programar?
            </label>
            <select id="daysCount" class="form-select" name="days" required>
                <option value="" disabled selected>Selecciona una opción</option>
                @for ($i = 1; $i <= 14; $i++)
                    <option value="{{ $i }}">{{ $i }} día{{ $i > 1 ? 's' : '' }}</option>
                @endfor
            </select>
        </div>

        {{-- Contenedor de formularios por día --}}
        <div id="daysContainer"></div>

        {{-- Botón de envío --}}
        <div class="mt-4 text-center border-top pt-4">
            <button type="submit" class="btn fw-bold px-4 py-2"
                style="background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }};
                       color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }};">
                <i class="bi bi-save me-2"></i>Guardar Carga de Horarios
            </button>
        </div>
    </form>
</div>

{{-- Scripts para lógica de formulario dinámico --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    const daysContainer = document.getElementById('daysContainer');
    const daysCount = document.getElementById('daysCount');

    daysCount.addEventListener('change', () => {
        const count = parseInt(daysCount.value);
        daysContainer.innerHTML = '';

        for (let i = 0; i < count; i++) {
            const dayDiv = document.createElement('div');
            dayDiv.className = 'mb-4';
            dayDiv.innerHTML = `
                <h5 class="fw-bold mt-4 mb-3" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                    Día ${i + 1}
                </h5>
                <div class="slot-day-${i}">
                    ${generateSlotRow(i, 0)}
                </div>
                <div class="mt-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary add-slot" data-day="${i}">
                        <i class="bi bi-plus-circle me-1"></i>Agregar otro horario
                    </button>
                </div>
                <hr>
            `;
            daysContainer.appendChild(dayDiv);
        }

        // Activar flatpickr en todos los inputs nuevos
        flatpickr(".flat-time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });
    });

    function generateSlotRow(dayIndex, slotIndex) {
        return `
            <div class="row g-2 align-items-end mb-2">
                <div class="col-md-5">
                    <label class="form-label">Hora de inicio</label>
                    <input type="text" name="slots[${dayIndex}][${slotIndex}][start]" class="form-control flat-time" required>
                </div>
                <div class="col-md-5">
                    <label class="form-label">Hora de término</label>
                    <input type="text" name="slots[${dayIndex}][${slotIndex}][end]" class="form-control flat-time" required>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btn-sm remove-slot">✖</button>
                </div>
            </div>
        `;
    }

    // Delegar eventos para botones de agregar y quitar
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('add-slot')) {
            const dayIndex = e.target.getAttribute('data-day');
            const container = document.querySelector(`.slot-day-${dayIndex}`);
            const slotCount = container.querySelectorAll('.row').length;
            container.insertAdjacentHTML('beforeend', generateSlotRow(dayIndex, slotCount));
            flatpickr(".flat-time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true
            });
        }

        if (e.target.classList.contains('remove-slot')) {
            e.target.closest('.row').remove();
        }
    });
</script>
@endsection