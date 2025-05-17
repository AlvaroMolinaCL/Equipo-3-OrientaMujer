<section class="bg-white p-4 rounded-3 shadow-sm">
    <h5 class="fw-medium mb-3" style="color: #8C2D18;">
        <i class="bi bi-trash3 me-2"></i>{{ __('Eliminar Cuenta') }}
    </h5>

    <div class="p-3 mb-4 text-center" style="background-color: #FDF5E5; border-radius: 8px;">
        <p class="mb-3" style="color: #8C2D18;">
            {{ __('Una vez eliminada su cuenta, todos sus datos se eliminarán permanentemente.') }}
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
                    <h5 class="modal-title fw-bold" style="color: #8C2D18;" id="confirmUserDeletionLabel">
                        <i class="bi bi-exclamation-octagon me-2"></i>{{ __('Confirmar Eliminación') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p style="color: #8C2D18;">
                        {{ __('Esta acción no se puede deshacer. Todos sus datos serán eliminados permanentemente. Para confirmar, ingrese su contraseña.') }}
                    </p>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-medium" style="color: #8C2D18;">
                            <i class="bi bi-lock me-1"></i>{{ __('Contraseña') }}
                        </label>
                        <div class="input-group">
                            <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                                <i class="bi bi-key"></i>
                            </span>
                            <input type="password" class="form-control border-start-0"
                                style="background-color: #FDF5E5;" placeholder="Ingrese su contraseña" id="password"
                                name="password" required>
                            <button class="btn" type="button" style="background-color: #F5E8D0; color: #8C2D18;"
                                onclick="togglePassword('password')">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password', 'userDeletion')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn fw-medium" data-bs-dismiss="modal"
                        style="background-color: #F5E8D0; color: #8C2D18;">
                        {{ __('Cancelar') }}
                    </button>
                    <button type="submit" class="btn fw-medium" style="background-color: #dc3545; color: white;">
                        <i class="bi bi-trash3 me-1"></i>{{ __('Eliminar Definitivamente') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

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
