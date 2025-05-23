<nav class="navbar navbar-light flex-column p-3 h-100"
    style="background-color: {{ tenantSetting('navbar_color_1', 'rgb(68, 30, 8)') }};">
    <a class="navbar-brand mx-auto d-none d-lg-block p-0 mb-3" href="{{ route('dashboard') }}">
        <img src="{{ asset(tenantSetting('logo_path_1', 'images/default-logo.png')) }}" alt="Logo"
            style="max-width: 100%; height: 60px" class="img-fluid mx-auto d-block">
    </a>

    <ul class="navbar-nav flex-column w-100">
        <li class="nav-item">
            <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"
                style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">
                <i class="bi bi-speedometer2 me-2"></i> Panel de Control
            </a>
        </li>

        <!-- Usuarios -->
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                href="#usersMenu" style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">
                <span><i class="bi bi-people me-2"></i> Usuarios</span>
                <i class="bi bi-chevron-down small"></i>
            </a>
            <div class="collapse ps-3" id="usersMenu">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('users.index') ? 'active' : '' }}"
                            href="{{ route('users.index') }}"
                            style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">Ver Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('users.create') ? 'active' : '' }}"
                            href="{{ route('users.create') }}"
                            style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">Agregar Usuario</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>

    <!-- User Info -->
    <div class="mt-auto border-top pt-3"
        style="border-color: {{ tenantSetting('button_banner_color', '#BF8A49') }} !important;">
        <div class="text-left">
            <strong
                style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">{{ Auth::user()->name }}</strong><br>
            <small
                style="color: {{ tenantSetting('navbar_text_color_1', '#BF8A49') }};">{{ Auth::user()->email }}</small>
        </div>
        <div class="dropup mt-2">
            <button class="btn btn-sm w-100 dropdown-toggle" type="button" data-bs-toggle="dropdown"
                style="background-color: {{ tenantSetting('button_banner_color', '#BF8A49') }}; color: {{ tenantSetting('button_banner_text_color', 'white') }};">
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
