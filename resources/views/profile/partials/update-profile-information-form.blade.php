<section class="bg-white p-4 rounded-3 shadow-sm mb-1">
    <h5 class="fw-medium mb-3" style="color: #8C2D18;">
        <i class="bi bi-person-gear me-2"></i>{{ __('Información de Perfil') }}
    </h5>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="mb-4">
            <label for="name" class="form-label fw-medium" style="color: #8C2D18;">
                <i class="bi bi-person me-1"></i>{{ __('Nombre Completo') }}
            </label>
            <div class="input-group">
                <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                    <i class="bi bi-fonts"></i>
                </span>
                <input id="name" type="text" class="form-control border-start-0"
                    placeholder="Por ejemplo: Juan Pérez" style="background-color: #FDF5E5;" name="name"
                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            </div>
            @error('name')
                <div class="text-danger small mt-2">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="form-label fw-medium" style="color: #8C2D18;">
                <i class="bi bi-envelope me-1"></i>{{ __('Correo Electrónico') }}
            </label>
            <div class="input-group">
                <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                    <i class="bi bi-at"></i>
                </span>
                <input type="email" class="form-control border-start-0" style="background-color: #FDF5E5;"
                    placeholder="Por ejemplo: miemail@gmail.com" id="email" name="email"
                    value="{{ old('email', $user->email) }}" required autocomplete="email">
            </div>
            @error('email')
                <div class="text-danger small mt-2">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-3 p-3" style="background-color: #FDF5E5; border-radius: 8px;">
                    <p class="small mb-2" style="color: #8C2D18;">
                        {{ __('Su dirección de correo electrónico no se encuentra verificada.') }}
                    </p>
                    <button form="send-verification" class="btn btn-link btn-sm p-0 text-decoration-none"
                        style="color: #8C2D18;">
                        <i class="bi bi-envelope-arrow-up me-1"></i>{{ __('Reenviar Correo de Verificación') }}
                    </button>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <div class="mt-2 small text-success">
                        <i
                            class="bi bi-check-circle me-1"></i>{{ __('Se ha enviado un nuevo enlace de verificación.') }}
                    </div>
                @endif
            @endif
        </div>

        <div class="mt-4 pt-3 border-top text-center">
            <button type="submit" class="btn fw-medium py-1"
                style="background-color: #8C2D18; color: white; width: 210px;">
                <i class="bi bi-save me-2"></i>{{ __('Guardar Cambios') }}
            </button>

            @if (session('status') === 'profile-updated')
                <div class="mt-3 small" style="color: #BF8A49;" x-data="{ show: true }" x-show="show" x-transition
                    x-init="setTimeout(() => show = false, 3000)">
                    <i class="bi bi-check-circle me-1"></i>{{ __('Perfil actualizado correctamente.') }}
                </div>
            @endif
        </div>
    </form>
</section>
