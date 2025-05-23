<section class="bg-white p-4 rounded-3 shadow-sm mb-4">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h2 class="h3 mb-0 fw-bold" style="color: {{ tenantSetting('primary_text_color', '#8C2D18') }};">
            <i class="bi bi-shield-lock me-2"></i>{{ __('Actualizar Contraseña') }}
        </h2>
    </div>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-4">
            <label for="update_password_current_password" class="form-label fw-medium" style="color: {{ tenantSetting('primary_text_color', '#8C2D18') }};">
                {{ __('Contraseña actual') }}
            </label>
            <input id="update_password_current_password" name="current_password" type="password"
                class="form-control border-0 py-2 px-3" style="background-color: {{ tenantSetting('input_bg_color', '#F5E8D0') }}; border-radius: 8px;"
                autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <div class="small mt-2" style="color: {{ tenantSetting('primary_text_color', '#8C2D18') }};">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="update_password_password" class="form-label fw-medium" style="color: {{ tenantSetting('primary_text_color', '#8C2D18') }};">
                {{ __('Nueva contraseña') }}
            </label>
            <input id="update_password_password" name="password" type="password" class="form-control border-0 py-2 px-3"
                style="background-color: {{ tenantSetting('input_bg_color', '#F5E8D0') }}; border-radius: 8px;" autocomplete="new-password">
            @error('password', 'updatePassword')
                <div class="small mt-2" style="color: {{ tenantSetting('primary_text_color', '#8C2D18') }};">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="update_password_password_confirmation" class="form-label fw-medium" style="color: {{ tenantSetting('primary_text_color', '#8C2D18') }};">
                {{ __('Confirme la nueva contraseña') }}
            </label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="form-control border-0 py-2 px-3" style="background-color: {{ tenantSetting('input_bg_color', '#F5E8D0') }}; border-radius: 8px;"
                autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <div class="small mt-2" style="color: {{ tenantSetting('primary_text_color', '#8C2D18') }};">{{ $message }}</div>
            @enderror
        </div>

        <div class="mt-4 pt-3 border-top text-center">
            <button type="submit" class="btn fw-medium py-1"
                style="background-color: {{ tenantSetting('navbar_color_1', '#8C2D18') }}; color: {{ tenantSetting('primary_button_text_color', 'white') }}; width: 210px;">
                <i class="bi bi-save me-2"></i>{{ __('Actualizar Contraseña') }}
            </button>

            @if (session('status') === 'password-updated')
                <div class="mt-3 small" style="color: {{ tenantSetting('success_text_color', '#BF8A49') }}" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)">
                    <i class="bi bi-check-circle me-1"></i>{{ __('Contraseña actualizada correctamente.') }}
                </div>
            @endif
        </div>
    </form>
</section>
