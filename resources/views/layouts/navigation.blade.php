<nav class="navbar navbar-expand-lg navbar-light bg-light flex-column p-3 border-end"
    style="width: 250px; height: 100vh; position: fixed; top: 0; left: 0; overflow-y: auto;">
    <a class="navbar-brand mx-auto" href="{{ route('dashboard') }}">
        <x-application-logo class="d-block" style="height: 36px; width: auto;" />
    </a>

    <ul class="navbar-nav flex-column w-100 mt-4">
        <li class="nav-item">
            <a class="nav-link {{ Route::is('dashboard') ? 'active bg-body-secondary' : '' }}"
                href="{{ route('dashboard') }}">Panel de Control</a>
        </li>

        <!-- Tenants -->
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                href="#tenantsMenu" role="button" aria-expanded="false" aria-controls="tenantsMenu">
                Tenants
                <i class="bi bi-chevron-down small"></i>
            </a>
            <div class="collapse ps-3" id="tenantsMenu">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('tenants.index') ? 'active' : '' }}"
                            href="{{ route('tenants.index') }}">Ver Tenants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('tenants.create') ? 'active' : '' }}"
                            href="{{ route('tenants.create') }}">Agregar Tenant</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Roles -->
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                href="#rolesMenu" role="button" aria-expanded="false" aria-controls="rolesMenu">
                Roles
                <i class="bi bi-chevron-down small"></i>
            </a>
            <div class="collapse ps-3" id="rolesMenu">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="#">Ver Roles</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Agregar Rol</a></li>
                </ul>
            </div>
        </li>

        <!-- Permisos -->
        <!--
            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                    href="#permisosMenu" role="button" aria-expanded="false" aria-controls="permisosMenu">
                    Permisos
                    <i class="bi bi-chevron-down small"></i>
                </a>
                <div class="collapse ps-3" id="permisosMenu">
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link" href="#">Ver Permisos</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Agregar Permiso</a></li>
                    </ul>
                </div>
            </li>
        -->

        <!-- Usuarios -->
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                href="#usersMenu" role="button" aria-expanded="false" aria-controls="usersMenu">
                Usuarios
                <i class="bi bi-chevron-down small"></i>
            </a>
            <div class="collapse ps-3" id="usersMenu">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('users.index') ? 'active' : '' }}"
                            href="{{ route('users.index') }}">Ver Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('users.create') ? 'active' : '' }}"
                            href="{{ route('users.create') }}">Agregar Usuario</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>

    <!-- User Info -->
    <div class="mt-auto border-top pt-3">
        <div class="text-left">
            <strong>{{ Auth::user()->name }}</strong><br>
            <small>{{ Auth::user()->email }}</small>
        </div>
        <div class="dropup mt-2">
            <button class="btn btn-sm btn-outline-secondary w-100 dropdown-toggle" type="button"
                data-bs-toggle="dropdown">
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
