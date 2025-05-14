<section class="bg-white p-4 rounded-3 shadow-sm">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h2 class="h3 mb-0 fw-bold" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
            <i class="bi bi-trash3 me-2"></i>{{ __('Eliminar cuenta') }}
        </h2>
    </div>

    <div class="p-3 mb-4 text-center" style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; border-radius: 8px;">
        <p class="mb-3" style="color: #dc3545;">
            {{ __('Una vez eliminada su cuenta, todos sus recursos y datos se eliminarán permanentemente.') }}
        </p>
        <div class="text-center">
            <button class="btn fw-medium py-1" data-bs-toggle="modal" data-bs-target="#confirmUserDeletion"
                style="background-color: #dc3545; color: white; width: 210px;">
                <i class="bi bi-exclamation-triangle me-2"></i>{{ __('Eliminar Cuenta') }}
            </button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmUserDeletion" tabindex="-1" aria-labelledby="confirmUserDeletionLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{ route('profile.destroy') }}" class="modal-content">
                @csrf
                @method('delete')

                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};" id="confirmUserDeletionLabel">
                        <i class="bi bi-exclamation-octagon me-2"></i>{{ __('Confirmar Eliminación') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                        {{ __('Esta acción no se puede deshacer. Todos sus datos serán eliminados permanentemente.') }}
                    </p>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-medium" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                            {{ __('Ingrese su contraseña para confirmar') }}
                        </label>
                        <input type="password" id="password" name="password" class="form-control border-0 py-2 px-3"
                            style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; border-radius: 8px;" placeholder="{{ __('Contraseña') }}">
                        @error('password', 'userDeletion')
                            <div class="small mt-2" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn fw-medium" data-bs-dismiss="modal"
                        style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                        {{ __('Cancelar') }}
                    </button>
                    <button type="submit" class="btn fw-medium" style="background-color: #dc3545; color: white;">
                        <i class="bi bi-trash3 me-1"></i>{{ __('Eliminar Definitivamente') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>