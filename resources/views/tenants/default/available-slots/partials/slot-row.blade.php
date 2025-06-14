<div class="slot-wrapper mb-3 w-100" data-index="{{ $slotIndex }}">
    <div class="d-flex align-items-end gap-2">
        <span class="slot-number fw-bold pt-4" style="min-width: 1.5rem; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
            {{ $slotIndex + 1 }}.
        </span>
        <div style="flex: 1;">
            <label class="form-label">Hora de inicio</label>
            <input type="text" name="slots[{{ $dayIndex }}][{{ $slotIndex }}][start]" class="form-control flat-time start-time" value="{{ $slot->start_time }}" required>
        </div>
        <div style="flex: 1;">
            <label class="form-label">Hora de término</label>
            <input type="text" name="slots[{{ $dayIndex }}][{{ $slotIndex }}][end]" class="form-control flat-time end-time" value="{{ $slot->end_time }}" required>
        </div>
        <div style="flex: 0;">
            <label class="form-label d-block">&nbsp;</label>
            <button type="button" class="btn btn-outline-danger btn-sm remove-slot d-flex align-items-center justify-content-center mb-1" style="width: 30px; height: 30px;" title="Eliminar horario">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    </div>
    <div class="w-100 mt-1">
        <div class="validation-error text-center"></div>
    </div>
</div>