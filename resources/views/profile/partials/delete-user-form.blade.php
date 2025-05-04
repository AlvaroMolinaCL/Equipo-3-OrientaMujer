<section class="mb-1">
    <header>
        <h2 class="h5 text-danger">
            {{ __('Eliminar Cuenta') }}
        </h2>
        <p class="text-muted">
            {{ __('Una vez eliminada su cuenta, todos sus recursos y datos se eliminarán permanentemente. Antes de eliminarla, descargue cualquier dato o información que desee conservar.') }}
        </p>
    </header>

    <!-- Botón para abrir el modal -->
    <button class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#confirmUserDeletion">
        {{ __('Eliminar Cuenta') }}
    </button>

    <!-- Modal de confirmación -->
    <div class="modal fade" id="confirmUserDeletion" tabindex="-1" aria-labelledby="confirmUserDeletionLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{ route('profile.destroy') }}" class="modal-content">
                @csrf
                @method('delete')

                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="confirmUserDeletionLabel">
                        {{ __('¿Está seguro de querer eliminar su cuenta?') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="{{ __('Close') }}"></button>
                </div>

                <div class="modal-body">
                    <p class="text-muted">
                        {{ __('Una vez eliminada su cuenta, todos sus recursos y datos se eliminarán permanentemente. Ingrese su contraseña para confirmar que desea eliminar su cuenta permanentemente.') }}
                    </p>

                    <div class="mb-3">
                        <label for="password" class="form-label sr-only">{{ __('Contraseña') }}</label>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="{{ __('Ingrese su contraseña') }}">
                        @error('password', 'userDeletion')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('Cancelar') }}</button>
                    <button type="submit" class="btn btn-danger">{{ __('Eliminar Cuenta') }}</button>
                </div>
            </form>
        </div>
    </div>
</section>
