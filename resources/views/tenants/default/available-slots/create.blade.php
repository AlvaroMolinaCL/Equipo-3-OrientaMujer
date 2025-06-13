@extends('tenants.default.layouts.panel')

@section('title', 'Crear Carga de Horarios - ' . tenantSetting('name', 'Tenant'))

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    <style>
        .day-card {
            max-height: 100%;
            flex-shrink: 0;
            width: 500px; /* antes 350 */
            transition: box-shadow 0.3s ease;
        }

        .day-tab-active {
            color: {{ tenantSetting('text_color_1', '#8C2D18') }};
            font-weight: bold;
            border-bottom: 2px solid {{ tenantSetting('text_color_1', '#8C2D18') }};
            transition: all 0.2s ease-in-out;
        }

        .day-card:hover {
            box-shadow: 0 0 0.5rem rgba(0, 0, 0, 0.1);
        }

        #dayTabs {
            margin-top: 1.2rem; /* Aumenta separación con respecto al select */
        }

        .scroll-container {
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            padding-bottom: 1rem; /* Añade separación inferior */
        }

        .validation-error {
            color: red;
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        .btn-disabled {
            background-color: #ccc !important;
            color: #666 !important;
            border: 1px solid #bbb !important;
            cursor: not-allowed;
            pointer-events: none;
        }
    </style>
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

        {{-- Nombre de la carga (opcional) --}}
        <div id="batchNameWrapper" class="mb-4 d-none">
            <label for="batchName" class="form-label fw-bold" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                Nombre de la carga (opcional)
            </label>
            <input type="text" class="form-control" name="name" id="batchName" placeholder="Ej: Semana del 10 de Julio">
        </div>

        {{-- Menú de navegación por día --}}
        <ul id="dayTabs" class="nav nav-pills justify-content-center mb-4 d-none flex-wrap"></ul>

        {{-- Contenedor de formularios por día --}}
        <div class="scroll-container d-flex gap-3 mb-4" id="daysContainer"
            style="overflow-x: auto; scroll-snap-type: x mandatory; scroll-behavior: smooth;">
            {{-- Se llenará dinámicamente --}}
        </div>


        {{-- Botón de envío --}}
        <div class="mt-4 text-center border-top pt-4">
            <button id="saveButton" type="submit"
                class="btn fw-bold px-4 py-2 btn-disabled"
                disabled
                style="background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }};
                    color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }};">
                <i class="bi bi-save me-2"></i>Guardar Carga de Horarios
            </button>
        </div>
    </form>
</div>

{{-- Scripts para lógica de formulario dinámico --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    const daysContainer = document.getElementById('daysContainer');
    const daysCount = document.getElementById('daysCount');

    daysCount.addEventListener('change', () => {
        const count = parseInt(daysCount.value);
        // Mostrar el campo de nombre de carga si se selecciona una cantidad de días
        const nameWrapper = document.getElementById('batchNameWrapper');
        if (count > 0) {
            nameWrapper.classList.remove('d-none');
        } else {
            nameWrapper.classList.add('d-none');
        }

        daysContainer.innerHTML = '';
        const dayTabs = document.getElementById('dayTabs');
        dayTabs.innerHTML = '';
        dayTabs.classList.remove('d-none');

        for (let i = 0; i < count; i++) {
            // Crear tarjeta por día
            const dayCard = document.createElement('div');
            dayCard.className = 'day-card p-3 rounded shadow-sm';
            dayCard.id = `day-${i}`;
            dayCard.style = `
                min-width: 500px;
                scroll-snap-align: start;
                background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};
            `;
            dayCard.innerHTML = `
                <h5 class="fw-bold mb-3" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">Día ${i + 1}</h5>
                <div class="slot-day-${i}">
                    ${generateSlotRow(i, 0)}
                </div>
                <div class="mt-2 d-flex justify-content-center">
                    <button type="button" class="btn btn-sm btn-outline-secondary add-slot" data-day="${i}">
                        <i class="bi bi-plus-circle me-1"></i>Agregar horario
                    </button>
                </div>
            `;
            daysContainer.appendChild(dayCard);

            // Agregar botón de navegación
            const tab = document.createElement('li');
            tab.className = 'nav-item';
            tab.innerHTML = `
                <button
                    type="button"
                    class="nav-link btn btn-sm fw-bold day-nav-btn"
                    style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};"
                    data-target="day-${i}"
                    onclick="document.getElementById('day-${i}').scrollIntoView({ behavior: 'smooth', inline: 'center' });">
                    ${i + 1}
                </button>
            `;
            dayTabs.appendChild(tab);
        }

        // Inicializar flatpickr
        flatpickr(".flat-time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });
    });

    function generateSlotRow(dayIndex, slotIndex) {
        return `
            <div class="slot-wrapper mb-3 w-100" data-index="${slotIndex}">
                <div class="d-flex align-items-end gap-2">
                    <span class="slot-number fw-bold pt-4" style="min-width: 1.5rem; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                        ${slotIndex + 1}.
                    </span>
                    <div style="flex: 1;">
                        <label class="form-label">Hora de inicio</label>
                        <input type="text" name="slots[${dayIndex}][${slotIndex}][start]" class="form-control flat-time start-time" required>
                    </div>
                    <div style="flex: 1;">
                        <label class="form-label">Hora de término</label>
                        <input type="text" name="slots[${dayIndex}][${slotIndex}][end]" class="form-control flat-time end-time" required>
                    </div>
                    <div style="flex: 0;">
                        <label class="form-label d-block">&nbsp;</label>
                        <button type="button"
                            class="btn btn-outline-danger btn-sm remove-slot d-flex align-items-center justify-content-center mb-1"
                            style="width: 30px; height: 30px;"
                            title="Eliminar horario">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </div>
                <div class="w-100 mt-1">
                    <div class="validation-error text-center"></div>
                </div>
            </div>
        `;
    }

    // Delegar eventos para botones de agregar y quitar
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('add-slot')) {
            const dayIndex = e.target.getAttribute('data-day');
            const container = document.querySelector(`.slot-day-${dayIndex}`);
            const slotCount = container.querySelectorAll('.slot-wrapper').length;
            container.insertAdjacentHTML('beforeend', generateSlotRow(dayIndex, slotCount));
            flatpickr(".flat-time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true
            });
            validateAllSlots();
        }

        if (e.target.closest('.remove-slot')) {
            const slotWrapper = e.target.closest('.slot-wrapper');
            if (!slotWrapper) return;

            const container = slotWrapper.closest('.slot-day-' + slotWrapper.closest('[id^="day-"]').id.split('-')[1]);
            slotWrapper.remove();

            // Reenumerar los horarios
            const wrappers = container.querySelectorAll('.slot-wrapper');
            wrappers.forEach((wrapper, index) => {
                const label = wrapper.querySelector('.slot-number');
                if (label) label.textContent = `${index + 1}.`;
            });
            validateAllSlots();
        }
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('day-nav-btn')) {
            const allBtns = document.querySelectorAll('.day-nav-btn');
            allBtns.forEach(btn => btn.classList.remove('day-tab-active'));

            e.target.classList.add('day-tab-active');
            const targetId = e.target.getAttribute('data-target');
            const targetEl = document.getElementById(targetId);
            if (targetEl) {
                targetEl.scrollIntoView({ behavior: 'smooth', inline: 'center' });
            }
        }
    });

    function validateAllSlots() {
        const saveButton = document.getElementById('saveButton');
        let isValid = true;

        const allDays = document.querySelectorAll('[id^="day-"]');

        allDays.forEach(dayCard => {
            const slots = Array.from(dayCard.querySelectorAll('.slot-wrapper'));
            const parsedSlots = [];

            slots.forEach(slot => {
                slot.querySelector('.validation-error').textContent = '';
            });

            slots.forEach((slot, i) => {
                const start = slot.querySelector('.start-time').value;
                const end = slot.querySelector('.end-time').value;
                const errorEl = slot.querySelector('.validation-error');

                if (start && end) {
                    if (start >= end) {
                        errorEl.textContent = 'La hora de término debe ser posterior a la hora de inicio.';
                        isValid = false;
                    }

                    parsedSlots.push({ index: i, start, end });
                } else {
                    isValid = false;
                }
            });

            // Validar solapamientos
            for (let i = 0; i < parsedSlots.length; i++) {
                for (let j = 0; j < parsedSlots.length; j++) {
                    if (i !== j) {
                        const a = parsedSlots[i];
                        const b = parsedSlots[j];
                        if (a.start < b.end && b.start < a.end) {
                            const errorEl = slots[i].querySelector('.validation-error');
                            if (!errorEl.textContent) {
                                errorEl.textContent = `Este horario disponible choca con el n. ${b.index + 1}. ${b.start} - ${b.end}`;
                                isValid = false;
                            }
                        }
                    }
                }
            }
        });

        // Aplicar estado final al botón
        saveButton.disabled = !isValid;
        if (isValid) {
            saveButton.classList.remove('btn-disabled');
        } else {
            saveButton.classList.add('btn-disabled');
        }
    }

    document.addEventListener('input', function (e) {
        if (e.target.classList.contains('start-time') || e.target.classList.contains('end-time')) {
            validateAllSlots();
        }
    });
</script>
@endsection