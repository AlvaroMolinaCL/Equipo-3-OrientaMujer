<section class="bg-white p-4 rounded-3 shadow-sm mb-1">
    <h5 class="fw-medium mb-3" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
        <i class="bi bi-shield-lock me-2"></i>{{ __('Actualizar Contraseña') }}
    </h5>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-4">
            <label for="update_password_current_password" class="form-label fw-medium"
                style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-lock me-1"></i>{{ __('Contraseña Actual') }}
            </label>
            <div class="input-group">
                <span class="input-group-text"
                    style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                    <i class="bi bi-key"></i>
                </span>
                <input type="password" class="form-control border-start-0"
                    style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};"
                    placeholder="Ingrese su contraseña actual" id="update_password_current_password"
                    name="current_password" autocomplete="current-password">
                <button class="btn" type="button"
                    style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};"
                    onclick="togglePassword('update_password_current_password')">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
            @error('current_password', 'updatePassword')
                <div class="text-danger small mt-2">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="update_password_password" class="form-label fw-medium"
                style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-lock me-1"></i>{{ __('Nueva Contraseña') }}
            </label>
            <div class="input-group">
                <span class="input-group-text"
                    style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                    <i class="bi bi-key"></i>
                </span>
                <input type="password" class="form-control border-start-0"
                    style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};"
                    placeholder="Ingrese una contraseña segura" id="update_password_password" name="password"
                    autocomplete="new-password">
                <button class="btn" type="button"
                    style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};"
                    onclick="togglePassword('update_password_password')">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
            @error('password', 'updatePassword')
                <div class="text-danger small mt-2">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="update_password_password_confirmation" class="form-label fw-medium"
                style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-lock me-1"></i>{{ __('Confirmar Nueva Contraseña') }}
            </label>
            <div class="input-group">
                <span class="input-group-text"
                    style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                    <i class="bi bi-key-fill"></i>
                </span>
                <input type="password" class="form-control border-start-0" style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};"
                    placeholder="Confirme la contraseña ingresada anteriormente"
                    id="update_password_password_confirmation" name="password_confirmation" autocomplete="new-password">
                <button class="btn" type="button"
                    style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};"
                    onclick="togglePassword('update_password_password_confirmation')">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
            @error('password_confirmation', 'updatePassword')
                <div class="text-danger small mt-2">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>

        <div class="mt-4 pt-3 border-top text-center">
            <button type="submit" class="btn fw-medium py-1"
                style="background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }}; color: {{ tenantSetting('primary_button_text_color', 'white') }}; width: 250px;">
                <i class="bi bi-save me-2"></i>{{ __('Actualizar Contraseña') }}
            </button>

            @if (session('status') === 'password-updated')
                <div class="mt-3 small" style="color: {{ tenantSetting('text_color_1', '#BF8A49') }}"
                    x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)">
                    <i class="bi bi-check-circle me-1"></i>{{ __('Contraseña actualizada correctamente.') }}
                </div>
            @endif
        </div>
    </form>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling.querySelector('i');
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    </script>
</section>
