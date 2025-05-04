<nav class="navbar navbar-expand-lg fixed-top @yield('navbar-class', 'navbar-dark-mode')">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand ms-auto" href="/">
            <img src="{{ asset(tenantSetting('logo_path_1', '')) }}" class="logo logo-1 d-none" alt="Logo 1 {{ tenantSetting('name', 'Tenant') }}"
                width="300" height="50">
            <img src="{{ asset(tenantSetting('logo_path_2', '')) }}" class="logo logo-2 d-none" alt="Logo 2 {{ tenantSetting('name', 'Tenant') }}"
                width="300" height="50">
        </a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="/">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Usuari@</a></li>
                <li class="nav-item"><a class="nav-link" href="/servicios">Servicios</a></li>
                <li class="nav-item"><a class="nav-link" href="/contacto">Contacto</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Tips</a></li>
                <li class="nav-item"><a class="nav-link" href="/acerca-de">Sobre Orienta Mujer</a></li>
            </ul>
        </div>
    </div>
</nav>
