<nav class="navbar navbar-light flex-column p-3 h-100" style="background-color:rgb(68, 30, 8) ;">
    <a class="navbar-brand mx-auto d-none d-lg-block p-0 mb-3" href="{{ route('dashboard') }}">
        <img src="{{ asset('images/abogasense3.png') }}" alt="Logo" style="height: 60px;">
    </a>

    <ul class="navbar-nav flex-column w-100" id="sidebarAccordion">
        <li class="nav-item">
            <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"
                style="color: white">
                <i class="bi bi-speedometer2 me-2"></i> Panel de Control
            </a>
        </li>

        {{-- Tenants --}}
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                href="#tenantsMenu" style="color: white;">
                <span><i class="bi bi-building me-2"></i> Tenants</span>
                <i class="bi bi-chevron-down small"></i>
            </a>
            <div class="collapse ps-3 {{ Route::is('tenants.*') ? 'show' : '' }}" id="tenantsMenu"
                data-bs-parent="#sidebarAccordion">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('tenants.index') ? 'active' : '' }}"
                            href="{{ route('tenants.index') }}" style="color: white;">Ver Tenants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('tenants.create') ? 'active' : '' }}"
                            href="{{ route('tenants.create') }}" style="color: white;">Agregar Tenant</a>
                    </li>
                </ul>
            </div>
        </li>

        {{-- Dominios --}}
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                href="#domainsMenu" style="color: white;">
                <span><i class="bi bi-globe-americas me-2"></i> Dominios</span>
                <i class="bi bi-chevron-down small"></i>
            </a>
            <div class="collapse ps-3 {{ Route::is('domains.*') ? 'show' : '' }}" id="domainsMenu"
                data-bs-parent="#sidebarAccordion">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('domains.index') ? 'active' : '' }}"
                            href="{{ route('domains.index') }}" style="color: white;">Ver Dominios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('domains.create') ? 'active' : '' }}"
                            href="{{ route('domains.create') }}" style="color: white;">Agregar Dominio</a>
                    </li>
                </ul>
            </div>
        </li>

        {{-- Usuarios --}}
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                href="#usersMenu" style="color: white;">
                <span><i class="bi bi-people me-2"></i> Usuarios</span>
                <i class="bi bi-chevron-down small"></i>
            </a>
            <div class="collapse ps-3 {{ Route::is('users.*') ? 'show' : '' }}" id="usersMenu"
                data-bs-parent="#sidebarAccordion">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('users.index') ? 'active' : '' }}"
                            href="{{ route('users.index') }}" style="color: white;">Ver Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('users.create') ? 'active' : '' }}"
                            href="{{ route('users.create') }}" style="color: white;">Agregar Usuario</a>
                    </li>
                </ul>
            </div>
        </li>

        {{-- Roles --}}
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                href="#rolesMenu" style="color: white;">
                <span><i class="bi bi-person-check me-2"></i> Roles</span>
                <i class="bi bi-chevron-down small"></i>
            </a>
            <div class="collapse ps-3 {{ Route::is('roles.*') ? 'show' : '' }}" id="rolesMenu"
                data-bs-parent="#sidebarAccordion">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('roles.index') ? 'active' : '' }}"
                            href="{{ route('roles.index') }}" style="color: white;">Ver Roles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('roles.create') ? 'active' : '' }}"
                            href="{{ route('roles.create') }}" style="color: white;">Agregar Rol</a>
                    </li>
                </ul>
            </div>
        </li>

        {{-- Token de Acceso --}}
        <li class="nav-item">
            <a class="nav-link {{ Route::is('admin.token') ? 'active' : '' }}" href="{{ route('admin.token') }}"
                style="color: white;">
                <i class="bi bi-key me-2"></i> Solicitudes de Acceso
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
