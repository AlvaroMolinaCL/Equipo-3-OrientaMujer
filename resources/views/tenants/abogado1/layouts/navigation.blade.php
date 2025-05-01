<nav class="navbar navbar-expand-lg fixed-top @yield('navbar-class', 'navbar-dark-mode')">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand ms-auto" href="/">
            <img id="logo-navbar" src="{{ url('/images/logo/Logo_OrientaMujer_(Letras_Blancas).png') }}"
                data-white="{{ url('/images/logo/Logo_OrientaMujer_(Letras_Blancas).png') }}"
                data-black="{{ url('/images/logo/Logo_OrientaMujer_(Letras_Negras).png') }}" width="300px"
                height="50px" alt="Logo Orienta Mujer">
        </a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="/">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Usuari@</a></li>
                <li class="nav-item"><a class="nav-link" href="/servicios">Servicios</a></li>
                <li class="nav-item"><a class="nav-link" href="/contacto">Contacto</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Tips</a></li>
                <li class="nav-item"><a class="nav-link" href="/acerca-de">Sobre Orienta Mujer</a></li>
                <!--
                    <li class="nav-item" style="font-family: 'Courier Prime', Courier"><a class="nav-link" href="/">Inicio</a></li>
                    <li class="nav-item" style="font-family: 'Courier Prime', Courier"><a class="nav-link" href="/login">Usuari@</a></li>
                    <li class="nav-item" style="font-family: 'Courier Prime', Courier"><a class="nav-link" href="/servicios">Servicios</a></li>
                    <li class="nav-item" style="font-family: 'Courier Prime', Courier"><a class="nav-link" href="/contacto">Contacto</a></li>
                    <li class="nav-item" style="font-family: 'Courier Prime', Courier"><a class="nav-link" href="/tips">Tips</a></li>
                    <li class="nav-item" style="font-family: 'Courier Prime', Courier"><a class="nav-link" href="/acerca-de">Sobre Orienta Mujer</a></li>
                -->
            </ul>
        </div>
    </div>
</nav>
