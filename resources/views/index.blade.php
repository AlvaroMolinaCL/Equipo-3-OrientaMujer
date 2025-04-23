<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orienta Mujer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Courier+Prime&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Montserrat', serif;
            background-color: #000;
            color: #fff;
            margin: 0;
            padding: 0;
            padding-top: 70px;
        }

        .navbar {
            background-color: #000;
            z-index: 999;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .navbar-nav .nav-link {
            color: white;
            font-size: 1rem;
        }

        .navbar-brand img {
            height: 50px;
            object-fit: contain;
        }

        .hero-section {
            background: url("{{ Storage::url('banner/Banner_Principal_OrientaMujer.png') }}") no-repeat center center;
            background-size: cover;
            height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 3rem 2rem;
            color: black;
            overflow: hidden;
        }

        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: rgba(0, 0, 0, 0.3);
            z-index: 1;
        }

        .hero-overlay {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 90%;
        }

        .hero-text {
            max-width: 600px;
            margin: 0 auto;
        }

        .hero-text h1 {
            font-size: 2.5rem;
        }

        .hero-text h1 strong {
            font-weight: bold;
        }

        .btn-consulta {
            background-color: #222;
            color: #fff;
            padding: 0.75rem 2rem;
            border: none;
            font-weight: bold;
            border-radius: 30px;
            margin-bottom: 1rem;
        }

        .btn-consulta:hover {
            background-color: #444;
            color: #fff;
        }

        .link-consulta {
            color: #000;
            text-decoration: none;
        }

        .scroll-section {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2rem;
        }

        #section1 {
            background-color: #111;
        }

        #section2 {
            background-color: #222;
        }

        #section3 {
            background-color: #333;
        }

        footer {
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 1rem;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Usuari@</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contacto</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Tips</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Sobre Orienta Mujer</a></li>
                </ul>
                <a class="navbar-brand ms-auto" href="/">
                    <img src="{{ Storage::url('logo/Logo_OrientaMujer_(Letras_Blancas).png') }}" width="300px"
                        height="50px">
                </a>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="hero-overlay">
            <div class="hero-text">
                <h1>La información es poder, <br><strong>¡empodérate!</strong></h1>
                <p class="mt-3">Acompañamiento jurídico y empático.</p>
                <button class="btn btn-consulta">Agenda tu asesoría</button>
                <br>
                <a href="#" class="link-consulta">Realice una consulta</a>
            </div>
        </div>
    </section>

    <section id="section1" class="scroll-section">
        Sección adicional 1
    </section>
    <section id="section2" class="scroll-section">
        Sección adicional 2
    </section>
    <section id="section3" class="scroll-section">
        Sección adicional 3
    </section>

    <footer>
        &copy; 2025 Orienta Mujer. Desarrollado por [nombre pendiente].
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
