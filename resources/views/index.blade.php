@extends('layouts.guest')

@section('title', config('app.name', 'Laravel'))

@section('content')
    <!-- Hero Section -->
    <section class="hero-section" style="background-color: #fdf5e5; border-bottom: 10px solid #6B3A2C;">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4" style="color: #4A1D0B;">Potencia tu Despacho Legal con una Página Web
                        Profesional</h1>
                    <p class="lead mb-4" style="color: #6B3A2C;">Solución todo-en-uno para gestión de clientes,
                        agendamiento, pagos y más</p>

                    <div class="d-flex gap-3 mb-4">
                        <a href="login" class="btn btn-lg text-white" style="background-color: #4A1D0B;">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Iniciar Sesión
                        </a>
                        <a href="#featuresCarousel" class="btn btn-lg btn-outline-dark">
                            <i class="bi bi-star-fill me-1"></i> Funciones
                        </a>
                    </div>

                    <div class="d-flex flex-wrap gap-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                            <span>Agendamiento 24/7</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                            <span>Pasarela de Pagos</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                            <span>Chatbot Inteligente</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="{{ asset('images/abogasense1.png  ') }}" alt="Dashboard para abogados"
                        class="img-fluid rounded-3 shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Badges Section -->
    <section class="py-4 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-auto text-center px-4">
                    <i class="bi bi-shield-lock fs-1" style="color: #6B3A2C;"></i>
                    <p class="mb-0 small">Seguridad SSL</p>
                </div>
                <div class="col-auto text-center px-4">
                    <i class="bi bi-phone fs-1" style="color: #6B3A2C;"></i>
                    <p class="mb-0 small">Personalizable</p>
                </div>
                <div class="col-auto text-center px-4">
                    <i class="bi bi-credit-card fs-1" style="color: #6B3A2C;"></i>
                    <p class="mb-0 small">Pagos Online</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Carousel Section -->
    <section class="features-carousel bg-white" id="featuresCarousel">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Todo lo que tu Despacho Legal Necesita</h2>
                <p class="section-subtitle">Una solución completa diseñada específicamente para abogados</p>
            </div>

            <div class="carousel-container">
                <div class="carousel-track" id="carouselTrack">
                    <!-- Card 1: Agendamiento Inteligente -->
                    <div class="feature-card">
                        <div class="feature-card-header">
                            <h4 class="feature-card-title">
                                <i class="bi bi-calendar-check"></i>
                                Agendamiento Inteligente
                            </h4>
                        </div>
                        <div class="feature-card-body">
                            <ul class="feature-list">
                                <li><i class="bi bi-check-circle-fill"></i> Reservas online 24/7</li>
                                <li><i class="bi bi-check-circle-fill"></i> Integración en calendario</li>
                                <li><i class="bi bi-check-circle-fill"></i> Control de disponibilidad</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Card 2: Gestión de Clientes -->
                    <div class="feature-card">
                        <div class="feature-card-header">
                            <h4 class="feature-card-title">
                                <i class="bi bi-people-fill"></i>
                                Gestión de Clientes
                            </h4>
                        </div>
                        <div class="feature-card-body">
                            <ul class="feature-list">
                                <li><i class="bi bi-check-circle-fill"></i> Base de datos organizada</li>
                                <li><i class="bi bi-check-circle-fill"></i> Historial de casos</li>
                                <li><i class="bi bi-check-circle-fill"></i> Documentos compartidos</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Card 3: Pagos en Línea -->
                    <div class="feature-card">
                        <div class="feature-card-header">
                            <h4 class="feature-card-title">
                                <i class="bi bi-credit-card"></i>
                                Pagos en Línea
                            </h4>
                        </div>
                        <div class="feature-card-body">
                            <ul class="feature-list">
                                <li><i class="bi bi-check-circle-fill"></i> Pasarela de pagos segura</li>
                                <li><i class="bi bi-check-circle-fill"></i> Confirmación de pagos</li>
                                <li><i class="bi bi-check-circle-fill"></i> Seguimiento de pagos</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Card 4: Chatbot Legal -->
                    <div class="feature-card">
                        <div class="feature-card-header">
                            <h4 class="feature-card-title">
                                <i class="bi bi-robot"></i>
                                Chatbot Legal
                            </h4>
                        </div>
                        <div class="feature-card-body">
                            <ul class="feature-list">
                                <li><i class="bi bi-check-circle-fill"></i> Respuestas automáticas</li>
                                <li><i class="bi bi-check-circle-fill"></i> Derivación a abogado</li>
                                <li><i class="bi bi-check-circle-fill"></i> Disponible 24/7</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Card 5: Diseño Personalizado -->
                    <div class="feature-card">
                        <div class="feature-card-header">
                            <h4 class="feature-card-title">
                                <i class="bi bi-brush"></i>
                                Diseño Personalizado
                            </h4>
                        </div>
                        <div class="feature-card-body">
                            <ul class="feature-list">
                                <li><i class="bi bi-check-circle-fill"></i> Logo y colores corporativos</li>
                                <li><i class="bi bi-check-circle-fill"></i> Adaptado a tu especialidad</li>
                                <li><i class="bi bi-check-circle-fill"></i> Optimizado para móviles</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Card 6: Reportes y Análisis -->
                    <div class="feature-card">
                        <div class="feature-card-header">
                            <h4 class="feature-card-title">
                                <i class="bi bi-bar-chart"></i>
                                Reportes y Análisis
                            </h4>
                        </div>
                        <div class="feature-card-body">
                            <ul class="feature-list">
                                <li><i class="bi bi-check-circle-fill"></i> Reporte de nuevos usuarios</li>
                                <li><i class="bi bi-check-circle-fill"></i> Eficiencia de tiempo</li>
                                <li><i class="bi bi-check-circle-fill"></i> Gestión de documentos</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <button class="carousel-nav prev" id="prevBtn">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button class="carousel-nav next" id="nextBtn">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>

            <div class="carousel-indicators" id="indicators"></div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-5" style="background-color: #fdf5e5;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold" style="color: #4A1D0B;">Abogados que Confían en Nosotros</h2>
                <p class="lead" style="color: #6B3A2C;">Lo que dicen nuestros clientes</p>
            </div>

            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-4">
                        <div class="d-flex mb-3 align-items-center">
                            <img src="{{ asset('images/reseñas/reseña_1.jpg') }}" class="rounded-circle me-3 flex-shrink-0"
                                style="width: 60px; height: 60px; object-fit: cover;" alt="Dra. Martínez">
                            <div>
                                <h5 class="mb-1" style="color: #4A1D0B;">Dra. Martínez</h5>
                                <p class="text-muted small mb-0">Derecho Familiar</p>
                            </div>
                        </div>
                        <p class="mb-0">"Desde que implementé esta plataforma, mis clientes pueden agendar citas a cualquier
                            hora y mis ingresos aumentaron un 30%."</p>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-4">
                        <div class="d-flex mb-3">
                            <img src="{{ asset('images/reseñas/reseña_2.jpg') }}" class="rounded-circle me-3 flex-shrink-0"
                                style="width: 60px; height: 60px; object-fit: cover;" alt="Dr. López">
                            <div>
                                <h5 class="mb-1" style="color: #4A1D0B;">Dr. López</h5>
                                <p class="text-muted small mb-0">Derecho Corporativo</p>
                            </div>
                        </div>
                        <p class="mb-0">"El chatbot responde preguntas básicas de clientes potenciales, lo que me ahorra
                            horas de llamadas innecesarias cada semana."</p>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-4">
                        <div class="d-flex mb-3 align-items-center">
                            <img src="{{ asset('images/reseñas/reseña_3.jpeg') }}" class="rounded-circle me-3 flex-shrink-0"
                                style="width: 60px; height: 60px; object-fit: cover;" alt="Dra. Rodríguez">
                            <div>
                                <h5 class="mb-1" style="color: #4A1D0B;">Dra. Rodríguez</h5>
                                <p class="text-muted small mb-0">Derecho Penal</p>
                            </div>
                        </div>
                        <p class="mb-0">"La pasarela de pagos ha simplificado enormemente el cobro de honorarios. Mis
                            clientes aprecian la facilidad de pago en línea."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold" style="color: #4A1D0B;">Planes a Medida para tu Despacho</h2>
                <p class="lead" style="color: #6B3A2C;">Elige el paquete que mejor se adapte a tus necesidades</p>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-lg-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-header py-4 text-center" style="background-color: #fdf5e5;">
                            <h4 class="mb-0" style="color: #4A1D0B;">Básico</h4>
                        </div>
                        <div class="card-body text-center p-4">
                            <h3 class="fw-bold mb-3" style="color: #6B3A2C;">$99/mes</h3>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i> Página
                                    web personalizada</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                                    Agendamiento básico</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                                    Gestión de clientes</li>
                                <li class="mb-3"><i class="bi bi-x-circle me-2 text-muted"></i> Pasarela de pagos</li>
                                <li class="mb-3"><i class="bi bi-x-circle me-2 text-muted"></i> Chatbot avanzado</li>
                            </ul>
                            <a href="#contact" class="btn btn-outline-dark w-100">Solicitar Información</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden" style="border: 3px solid #6B3A2C;">
                        <div class="card-header py-4 text-center text-white" style="background-color: #6B3A2C;">
                            <h4 class="mb-0">Profesional</h4>
                            <span class="badge bg-white text-dark mt-2">Más Popular</span>
                        </div>
                        <div class="card-body text-center p-4">
                            <h3 class="fw-bold mb-3" style="color: #6B3A2C;">$199/mes</h3>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i> Todo
                                    en Básico</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                                    Pasarela de pagos integrada</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                                    Chatbot básico</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                                    Reportes mensuales</li>
                                <li class="mb-3"><i class="bi bi-x-circle me-2 text-muted"></i> Chatbot avanzado</li>
                            </ul>
                            <a href="#contact" class="btn text-white w-100" style="background-color: #4A1D0B;">Contratar
                                Ahora</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-header py-4 text-center" style="background-color: #fdf5e5;">
                            <h4 class="mb-0" style="color: #4A1D0B;">Premium</h4>
                        </div>
                        <div class="card-body text-center p-4">
                            <h3 class="fw-bold mb-3" style="color: #6B3A2C;">$299/mes</h3>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i> Todo
                                    en Profesional</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                                    Chatbot avanzado con IA</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                                    Integración CRM</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                                    Reportes avanzados</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                                    Soporte prioritario</li>
                            </ul>
                            <a href="#contact" class="btn btn-outline-dark w-100">Solicitar Información</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold" style="color: #4A1D0B;">Preguntas Frecuentes</h2>
                <p class="lead" style="color: #6B3A2C;">Todo lo que necesitas saber</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item border-0 mb-3 rounded-4 overflow-hidden shadow-sm">
                            <h3 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"
                                    style="background-color: #fdf5e5; color: #4A1D0B;">
                                    ¿Cuánto tiempo toma implementar la solución?
                                </button>
                            </h3>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Normalmente implementamos tu página web profesional en 4-7 días laborales después de
                                    recibir toda la información necesaria (logo, contenido, fotos, etc.).
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border-0 mb-3 rounded-4 overflow-hidden shadow-sm">
                            <h3 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"
                                    style="background-color: #fdf5e5; color: #4A1D0B;">
                                    ¿Puedo migrar mis clientes actuales al sistema?
                                </button>
                            </h3>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Sí, ofrecemos servicio de migración de datos sin costo adicional. Solo necesitas
                                    proporcionarnos tus datos en formato Excel o CSV y nosotros nos encargamos del resto,
                                    manteniendo toda la información segura y organizada.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border-0 mb-3 rounded-4 overflow-hidden shadow-sm">
                            <h3 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"
                                    style="background-color: #fdf5e5; color: #4A1D0B;">
                                    ¿Qué métodos de pago están disponibles?
                                </button>
                            </h3>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Contamos con la integración de Webpay, por lo que tus
                                    clientes podrán pagar con tarjeta de crédito/débito y transferencias bancarias.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border-0 mb-3 rounded-4 overflow-hidden shadow-sm">
                            <h3 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"
                                    style="background-color: #fdf5e5; color: #4A1D0B;">
                                    ¿Ofrecen capacitación para usar el sistema?
                                </button>
                            </h3>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Sí, incluimos una sesión de capacitación virtual de 1 hora con cada implementación,
                                    además de videotutoriales paso a paso y documentación detallada. También ofrecemos
                                    soporte prioritario por correo para resolver cualquier duda rápidamente.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border-0 rounded-4 overflow-hidden shadow-sm">
                            <h3 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive"
                                    style="background-color: #fdf5e5; color: #4A1D0B;">
                                    ¿Es compatible con dispositivos móviles?
                                </button>
                            </h3>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Absolutamente. Tu página web y panel de control están completamente optimizados para
                                    smartphones y tablets. Tus clientes podrán agendar citas, hacer pagos y comunicarse
                                    desde cualquier dispositivo sin problemas.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA Section -->
    <section class="py-3 text-center" style="background-color: #4A1D0B;">
        <div class="container">
            <h3 class="text-white mt-2">Transforma tu Práctica Legal Hoy Mismo</h3>
            <p class="lead text-white">Más de 200 abogados ya confían en nuestra plataforma para gestionar sus
                despachos</p>
        </div>
    </section>
@endsection

@section('styles')
    <style>
        .hero-section {
            padding: 6rem 0;
        }

        .feature-card {
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(106, 58, 44, 0.1) !important;
        }

        .accordion-button:not(.collapsed) {
            background-color: #6B3A2C !important;
            color: white !important;
        }

        .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(106, 58, 44, 0.2);
        }

        .nav-pills .nav-link.active {
            background-color: #6B3A2C;
        }

        .nav-pills .nav-link {
            color: #4A1D0B;
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 4rem 0;
                text-align: center;
            }

            .display-4 {
                font-size: 2.5rem;
            }

            .d-flex.gap-3 {
                justify-content: center;
            }
        }
    </style>
@endsection