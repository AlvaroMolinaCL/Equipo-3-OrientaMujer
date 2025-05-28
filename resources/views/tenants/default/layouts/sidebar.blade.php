<style>
    .navbar-nav .nav-link.active {
        background-color:
            {{ tenantSetting('button_color_sidebar', '#BF8A49') }}
            !important;
        border-radius: 0.375rem;
    }
</style>

<nav class="navbar navbar-light flex-column p-3 h-100"
    style="background-color: {{ tenantSetting('navbar_color_1', 'rgb(68, 30, 8)') }};">
    <a class="navbar-brand mx-auto d-none d-lg-block p-0 mb-3" href="{{ route('dashboard') }}">
        <img src="{{ asset(tenantSetting('logo_path_1', 'images/logo/Logo_1_(Predeterminado).png')) }}" alt="Logo"
            style="max-width: 100%; height: 60px" class="img-fluid mx-auto d-block">
    </a>

    <ul class="navbar-nav flex-column w-100" id="sidebarAccordion">
        {{-- Panel de Control --}}
        <li class="nav-item">
            <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"
                style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">
                <i class="bi bi-speedometer2 me-2"></i> Panel de Control
            </a>
        </li>

        {{-- Apariencia --}}
        <li class="nav-item">
            <a class="nav-link {{ Route::is('appearance.index') ? 'active' : '' }}" href="{{ route('appearance') }}"
                style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">
                <i class="bi bi-palette me-2"></i> Apariencia
            </a>
        </li>

        {{-- Mi Agenda --}}
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                href="#availableSlotsMenu" style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};"
                aria-expanded="false">
                <span><i class="bi bi-calendar me-2"></i> Mi Agenda</span>
                <i class="bi bi-chevron-down small"></i>
            </a>
            <div class="collapse ps-3 {{ Route::is('available-slots.*') ? 'show' : '' }}" id="availableSlotsMenu"
                data-bs-parent="#sidebarAccordion">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('available-slots.index') ? 'active' : '' }}"
                            href="{{ route('available-slots.index') }}"
                            style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">Ver Disponibilidad</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('available-slots.create') ? 'active' : '' }}"
                            href="{{ route('available-slots.create') }}"
                            style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">Agregar
                            Disponibilidad</a>
                    </li>
                </ul>
            </div>
        </li>

        {{-- Archivos --}}
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                href="#filesMenu" style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};"
                aria-expanded="false">
                <span><i class="bi bi-file-text me-2"></i> Archivos</span>
                <i class="bi bi-chevron-down small"></i>
            </a>
            <div class="collapse ps-3 {{ Route::is('files.*') ? 'show' : '' }}" id="filesMenu"
                data-bs-parent="#sidebarAccordion">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('files.index') ? 'active' : '' }}"
                            href="{{ route('files.index') }}"
                            style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">Mis Archivos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('files.create') ? 'active' : '' }}"
                            href="{{ route('files.create') }}"
                            style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">Agregar Archivos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('files.shared.files') ? 'active' : '' }}"
                            href="{{ route('files.shared.files') }}"
                            style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">Archivos
                            Compartidos</a>
                    </li>
                </ul>
            </div>
        </li>

        {{-- Usuarios --}}
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                href="#usersMenu" style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};"
                aria-expanded="false">
                <span><i class="bi bi-people me-2"></i> Usuarios</span>
                <i class="bi bi-chevron-down small"></i>
            </a>
            <div class="collapse ps-3 {{ Route::is('users.*') ? 'show' : '' }}" id="usersMenu"
                data-bs-parent="#sidebarAccordion">
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

        {{-- Roles --}}
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                href="#rolesMenu" style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">
                <span><i class="bi bi-person-check me-2"></i> Roles</span>
                <i class="bi bi-chevron-down small"></i>
            </a>
            <div class="collapse ps-3 {{ Route::is('roles.*') ? 'show' : '' }}" id="rolesMenu"
                data-bs-parent="#sidebarAccordion">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('roles.index') ? 'active' : '' }}"
                            href="{{ route('roles.index') }}"
                            style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">Ver Roles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('roles.create') ? 'active' : '' }}"
                            href="{{ route('roles.create') }}"
                            style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">Agregar Rol</a>
                    </li>
                </ul>
            </div>
        </li>
        {{-- Planes --}}
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                href="#planesMenu" style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">
                <span><i class="bi bi-card-checklist me-2"></i> Planes</span>
                <i class="bi bi-chevron-down small"></i>
            </a>
            <div class="collapse ps-3 {{ Route::is('products.*') ? 'show' : '' }}" id="planesMenu"
                data-bs-parent="#sidebarAccordion">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('products.index') ? 'active' : '' }}"
                            href="{{ route('products.index') }}"
                            style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">Ver Planes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('products.create') ? 'active' : '' }}"
                            href="{{ route('products.create') }}"
                            style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">Agregar Plan</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>

    {{-- Información de Usuario --}}
    <div class="mt-auto border-top pt-3"
        style="border-color: {{ tenantSetting('navbar_text_color_1', '#BF8A49') }} !important;">
        <div class="text-left">
            <strong
                style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">{{ Auth::user()->name }}</strong><br>
            <small
                style="color: {{ tenantSetting('navbar_text_color_1', '#BF8A49') }};">{{ Auth::user()->email }}</small>
        </div>
        <div class="dropup mt-2">
            <button class="btn btn-sm w-100 dropdown-toggle" type="button" data-bs-toggle="dropdown" style="background-color: {{ tenantSetting('button_color_sidebar', '#BF8A49') }};
               color: {{ tenantSetting('navbar_text_color_1', 'white') }};
               border: 1px solid {{ tenantSetting('navbar_text_color_1', 'white') }};">
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