<nav class="navbar navbar-light flex-column p-3 h-100" style="background-color:rgb(68, 30, 8) ;">
    <a class="navbar-brand mx-auto d-none d-lg-block p-0 mb-3" href="{{ route('dashboard') }}">
        <img src="{{ asset('images/abogasense3.png') }}" alt="Logo" style="height: 60px;">
    </a>

    {{-- Botón Inicio --}}
    <div class="px-3 mb-3 mt-3">
        <a href="{{ route('tenants.default.index') }}" class="btn w-100"
            style="background-color: #BF8A49;
              color: white;
              border-radius: 0.375rem;
              text-align: center;
              display: block;">
            <i class="bi bi-house-door-fill me-2"></i> Inicio
        </a>
    </div>

    <ul class="navbar-nav flex-column w-100" id="sidebarAccordion">
        <li class="nav-item">
            <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"
                style="color: white">
                <i class="bi bi-speedometer2 me-2"></i> Panel de Control
            </a>
        </li>

        {{-- Dominios --}}
        <li class="nav-item">
            <a class="nav-link {{ Route::is('domains.index') ? 'active' : '' }}" href="{{ route('domains.index') }}"
                style="color: white;">
                <span><i class="bi bi-globe-americas me-2"></i> Dominios</span>
            </a>
        </li>

        {{-- Roles --}}
        <li class="nav-item">
            <a class="nav-link {{ Route::is('roles.index') ? 'active' : '' }}" href="{{ route('roles.index') }}"
                style="color: white;">
                <span><i class="bi bi-person-check me-2"></i> Roles</span>
            </a>
        </li>

        {{-- Token de Acceso --}}
        <li class="nav-item">
            <a class="nav-link {{ Route::is('admin.token') ? 'active' : '' }}" href="{{ route('admin.token') }}"
                style="color: white;">
                <i class="bi bi-key me-2"></i> Solicitudes de Acceso
            </a>
        </li>

        {{-- Tenants --}}
        <li class="nav-item">
            <a class="nav-link {{ Route::is('tenants.index') ? 'active' : '' }}" href="{{ route('tenants.index') }}"
                style="color: white;">
                <span><i class="bi bi-building me-2"></i> Tenants</span>
            </a>
        </li>

        {{-- Usuarios --}}
        <li class="nav-item">
            <a class="nav-link {{ Route::is('users.index') ? 'active' : '' }}" href="{{ route('users.index') }}"
                style="color: white;">
                <span><i class="bi bi-people me-2"></i> Usuarios</span>
            </a>
        </li>
    </ul>

    {{-- Información de Usuario --}}
    <div class="mt-auto border-top pt-3" style="border-color: #BF8A49 !important;">
        <div class="text-left">
            <strong style="color: white;">{{ Auth::user()->name }}</strong><br>
            <small style="color: #BF8A49;">{{ Auth::user()->email }}</small>
        </div>
        <div class="dropup mt-2">
            <button class="btn btn-sm w-100 dropdown-toggle" type="button" data-bs-toggle="dropdown"
                style="background-color: #BF8A49; color: white; border-color: #BF8A49;">
                Cuenta
            </button>
            <ul class="dropdown-menu w-100">
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item" type="submit">Cerrar Sesión</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
