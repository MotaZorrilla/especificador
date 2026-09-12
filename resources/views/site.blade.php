<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Especificador de Pintura Intumescente | Cálculo y Certificación para Acero</title>
    <meta name="description" content="Calcula la masividad exacta de perfiles estructurales de acero y genera especificaciones técnicas oficiales de espesores mínimos bajo NCh3040.Of2007 y OGUC en Chile.">

    <!-- Google Fonts: Plus Jakarta Sans & Open Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary: #fb6340;
            --primary-dark: #f5365c;
            --fire-gradient: linear-gradient(310deg, #fb6340 0%, #f5365c 100%);
            --fire-glow: rgba(251, 99, 64, 0.35);
            --navy-gradient: linear-gradient(310deg, #172b4d 0%, #11cdef 100%);
            --dark-luxury: linear-gradient(135deg, #111424 0%, #1a1f37 100%);
            --dark-gradient: linear-gradient(310deg, #141727 0%, #3a416f 100%);
            --blue-gradient: linear-gradient(310deg, #5e72e4 0%, #825ee4 100%);
            --card-glass: rgba(255, 255, 255, 0.92);
            --border-glass: rgba(255, 255, 255, 0.14);
            --bg-light: #f8fafc;
            --text-dark: #252f40;
            --text-muted: #67748e;
            --argon-radius: 1.15rem;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Glass Navbar */
        .glass-nav {
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
        }

        .navbar-brand-logo {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: var(--fire-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.25rem;
            box-shadow: 0 4px 12px rgba(245, 54, 92, 0.35);
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            min-height: 90vh;
            background: linear-gradient(135deg, #111424 0%, #1a1f37 60%, #751426 100%);
            display: flex;
            align-items: center;
            padding: 130px 0 90px;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 85% 15%, rgba(251, 99, 64, 0.28) 0%, transparent 50%),
                        radial-gradient(circle at 10% 85%, rgba(17, 205, 239, 0.18) 0%, transparent 45%);
            pointer-events: none;
        }

        .badge-luxury {
            padding: 7px 16px;
            font-weight: 700;
            font-size: 0.82rem;
            border-radius: 50rem;
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .badge-fire-soft {
            background: rgba(251, 99, 64, 0.16);
            color: #ff8d72;
            border: 1px solid rgba(251, 99, 64, 0.3);
        }

        .badge-navy-soft {
            background: rgba(17, 205, 239, 0.15);
            color: #11cdef;
            border: 1px solid rgba(17, 205, 239, 0.3);
        }

        .badge-success-soft {
            background: rgba(45, 206, 137, 0.15);
            color: #2dce89;
            border: 1px solid rgba(45, 206, 137, 0.3);
        }

        /* Card & Effects */
        .floating-card {
            border-radius: var(--argon-radius);
            border: 1px solid rgba(0, 0, 0, 0.06);
            background: #ffffff;
            transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        }

        .floating-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 22px 40px -10px rgba(0, 0, 0, 0.12) !important;
        }

        .icon-shape-gradient {
            width: 58px;
            height: 58px;
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            color: #fff;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        }

        .step-badge {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: var(--fire-gradient);
            color: #fff;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: 0 4px 14px rgba(245, 54, 92, 0.35);
        }

        /* Galería de Perfiles */
        .profile-card {
            background: #ffffff;
            border-radius: 1.1rem;
            border: 1px solid #e9ecef;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        }

        .profile-card:hover {
            border-color: #fb6340;
            transform: translateY(-5px);
            box-shadow: 0 16px 35px rgba(251, 99, 64, 0.14);
        }

        .profile-img-container {
            height: 180px;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            position: relative;
            border-bottom: 1px solid #f1f3f5;
        }

        .profile-img-container img {
            max-height: 145px;
            max-width: 90%;
            object-fit: contain;
            filter: drop-shadow(0 3px 6px rgba(0, 0, 0, 0.08));
            transition: transform 0.35s ease;
        }

        .profile-card:hover .profile-img-container img {
            transform: scale(1.06);
        }

        .nav-pills-luxury .nav-link {
            border-radius: 0.75rem;
            color: #525f7f;
            font-weight: 700;
            padding: 0.6rem 1.4rem;
            border: 1px solid transparent;
            background: rgba(255, 255, 255, 0.6);
            transition: all 0.2s ease;
        }

        .nav-pills-luxury .nav-link.active {
            background: #111424;
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(20, 24, 45, 0.25);
        }

        .exposure-toggle-btn {
            border: 2px solid #e9ecef;
            background: #fff;
            font-weight: 700;
            border-radius: 0.75rem;
            padding: 0.5rem 1.1rem;
            color: var(--text-dark);
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.88rem;
        }

        .exposure-toggle-btn.active {
            background: var(--fire-gradient);
            color: #fff;
            border-color: transparent;
            box-shadow: 0 4px 15px var(--fire-glow);
        }

        /* Buttons */
        .btn-fire {
            background: var(--fire-gradient);
            color: #ffffff !important;
            font-weight: 700;
            border: none;
            border-radius: 0.75rem;
            padding: 0.65rem 1.5rem;
            box-shadow: 0 4px 15px var(--fire-glow);
            transition: all 0.25s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-fire:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(245, 54, 92, 0.6);
            color: #ffffff !important;
        }

        .btn-dash-outline {
            background: transparent;
            color: #ffffff !important;
            border: 2px solid rgba(255, 255, 255, 0.8);
            font-weight: 700;
            border-radius: 0.75rem;
            padding: 0.65rem 1.5rem;
            transition: all 0.25s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-dash-outline:hover {
            background: #ffffff;
            color: #141727 !important;
            transform: translateY(-2px);
        }

        .card-preview {
            border-radius: 1.25rem;
            background: #ffffff;
            border: none;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .preview-header {
            background: #f8f9fa;
            border-radius: 1.25rem 1.25rem 0 0;
            padding: 14px 20px;
            border-bottom: 1px solid #edf2f7;
        }

        /* Acordeón FAQ */
        .accordion-luxury .accordion-item {
            background: #fff;
            border: 1px solid #eef2f6;
            border-radius: 1rem !important;
            margin-bottom: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }

        .accordion-luxury .accordion-button {
            font-weight: 700;
            font-size: 1.05rem;
            color: var(--text-dark);
            background: #fff;
            padding: 1.25rem 1.5rem;
            box-shadow: none !important;
        }

        .accordion-luxury .accordion-button:not(.collapsed) {
            color: #fb6340;
            background: #fff;
            border-bottom: 1px solid #f1f3f5;
        }

        .accordion-luxury .accordion-body {
            padding: 1.25rem 1.5rem;
            color: var(--text-muted);
            line-height: 1.7;
        }

        /* Contador Animado */
        .stat-counter-card {
            background: #fff;
            border-radius: 1.1rem;
            padding: 1.75rem 1.25rem;
            border: 1px solid #eef2f6;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
        }

        .stat-counter-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        /* Modales */
        .modal-luxury .modal-content {
            border-radius: 1.25rem;
            border: none;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }

        .modal-header-dark {
            background: linear-gradient(135deg, #111424 0%, #1a1f37 100%);
            color: #fff;
            padding: 1.25rem 1.75rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
        }

        .modal-header-fire {
            background: var(--fire-gradient);
            color: #fff;
            padding: 1.25rem 1.75rem;
        }

        .calc-geom-btn {
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.78rem;
            padding: 5px 10px;
            transition: all 0.2s ease;
        }
    </style>
</head>

<body>

    <!-- NAVBAR NAVEGACIÓN -->
    <nav class="navbar navbar-expand-lg glass-nav fixed-top py-2 px-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center m-0 text-decoration-none" href="index.html">
                <div class="navbar-brand-logo me-2">
                    <i class="bi bi-fire"></i>
                </div>
                <div>
                    <span class="fw-bold text-dark d-block lh-1" style="font-size: 1.05rem;">Especificador</span>
                    <small class="text-muted fw-semibold" style="font-size: 0.72rem;">Pintura Intumescente</small>
                </div>
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Menu">
                <i class="bi bi-list fs-2 text-dark"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold px-3" href="#beneficios">Beneficios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold px-3" href="#galeria-perfiles">Perfiles 2D</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold px-3" href="#como-funciona">Cómo Funciona</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold px-3" href="#normativa">Normativa INN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold px-3" href="#faq-metricas">Preguntas FAQ</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                    <button type="button" class="btn btn-outline-warning btn-sm fw-bold px-3 py-2 text-dark rounded-3 d-inline-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#modalCalculadoraMasividad">
                        <i class="bi bi-calculator-fill"></i>
                        <span class="d-none d-xl-inline">Simulador</span> en Vivo
                    </button>
                    @auth
                        <a href="{{ route('home') }}" class="btn-fire btn-sm">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline m-0">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm fw-bold px-3 py-2 rounded-3">
                                <i class="bi bi-box-arrow-right"></i> Salir
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-dark btn-sm fw-bold px-3 py-2 text-decoration-none rounded-3">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Iniciar Sesión
                        </a>
                        <a href="{{ route('login') }}" class="btn-fire btn-sm">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero-section text-white">
        <div class="container position-relative">
            <div class="row align-items-center gy-5">
                <div class="col-lg-7 text-center text-lg-start">
                    <div class="badge-luxury badge-fire-soft mb-3">
                        <i class="bi bi-shield-check text-warning"></i> Protección Pasiva contra Incendios · Chile
                    </div>
                    <h1 class="text-white fw-bold display-5 mb-3 lh-sm">
                        Especificación Inteligente y Certificada de <span style="background: linear-gradient(310deg, #ffc107 0%, #ff5722 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Pintura Intumescente</span>
                    </h1>
                    <p class="lead text-white-50 mb-4 pe-lg-4" style="font-size: 1.15rem; line-height: 1.65;">
                        Calcula automáticamente la <strong>masividad física (P/A)</strong> de 11 geometrías estructurales de acero y genera especificaciones técnicas oficiales de espesores mínimos (F15 a F120) conforme a <strong>NCh3040.Of2007</strong> y la <strong>OGUC</strong>.
                    </p>

                    <div class="d-flex flex-wrap justify-content-center justify-content-lg-start gap-3">
                        @auth
                            <a href="{{ route('home') }}" class="btn btn-lg btn-light fw-bold text-danger px-4 py-3 rounded-3 shadow-lg text-decoration-none d-inline-flex align-items-center gap-2">
                                <i class="bi bi-speedometer2 text-danger fs-5"></i> Ir al Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-lg btn-light fw-bold text-danger px-4 py-3 rounded-3 shadow-lg text-decoration-none d-inline-flex align-items-center gap-2">
                                <i class="bi bi-box-arrow-in-right text-danger fs-5"></i> Ingresar al Dashboard
                            </a>
                        @endauth
                        <button type="button" class="btn btn-warning btn-lg fw-bold text-dark px-4 py-3 rounded-3 shadow-lg d-inline-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalCalculadoraMasividad">
                            <i class="bi bi-calculator-fill fs-5"></i> Abrir Simulador en Vivo
                        </button>
                    </div>

                    <div class="mt-4 pt-3 d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start gap-3 text-white-50" style="font-size: 0.82rem;">
                        <span><i class="bi bi-check-circle-fill text-success me-1"></i> Norma NCh3040.Of2007</span>
                        <span><i class="bi bi-check-circle-fill text-success me-1"></i> Ensayos NCh935/1 (IDIEM/DICTUC)</span>
                        <span><i class="bi bi-check-circle-fill text-success me-1"></i> Exigido por Inspectores INN</span>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card card-preview p-0">
                        <div class="preview-header d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge rounded-pill bg-danger p-1"></span>
                                <span class="badge rounded-pill bg-warning p-1"></span>
                                <span class="badge rounded-pill bg-success p-1"></span>
                                <span class="fw-bold text-dark ms-2" style="font-size: 0.88rem;">Cálculo de Masividad</span>
                            </div>
                            <span class="badge bg-success-subtle text-success border border-success-subtle fw-semibold" style="font-size: 0.75rem;">100% Automático</span>
                        </div>

                        <div class="card-body p-4">
                            <div class="bg-light p-3 rounded-3 mb-3 border">
                                <div class="row g-2" style="font-size: 0.82rem;">
                                    <div class="col-6">
                                        <span class="text-muted d-block">Perfil de Acero:</span>
                                        <strong class="text-dark">HN 30x44 (HSR)</strong>
                                    </div>
                                    <div class="col-6">
                                        <span class="text-muted d-block">Exposición:</span>
                                        <strong class="text-dark">Columna 4 Caras (P4C)</strong>
                                    </div>
                                    <div class="col-6">
                                        <span class="text-muted d-block">Resistencia:</span>
                                        <strong class="text-danger fw-bold">F-60 Minutos</strong>
                                    </div>
                                    <div class="col-6">
                                        <span class="text-muted d-block">Masividad (P/A):</span>
                                        <strong class="text-primary fw-bold">198 m⁻¹</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between p-3 mb-3 border rounded-3 bg-white">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-file-earmark-pdf-fill text-danger fs-2 me-3"></i>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.9rem;">Especificación Técnica Oficial</h6>
                                        <small class="text-muted" style="font-size: 0.75rem;">Lista para Inspectores INN en Obra</small>
                                    </div>
                                </div>
                                <span class="badge bg-light text-secondary border">PDF Carta</span>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-outline-danger fw-bold py-2 rounded-3" data-bs-toggle="modal" data-bs-target="#modalCalculadoraMasividad">
                                    <i class="bi bi-sliders me-1"></i> Probar con Mis Medidas
                                </button>
                                <a href="{{ route('home') }}" class="btn-fire py-2 rounded-3">
                                    <i class="bi bi-speedometer2"></i> Ir al Panel de Control
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BARRA INTERACTIVA DE ACCESO A MODALES TÉCNICOS -->
    <div class="py-3 border-bottom shadow-sm" style="background: linear-gradient(135deg, #111424 0%, #1a1f37 100%);">
        <div class="container d-flex flex-wrap align-items-center justify-content-between gap-2">
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-danger"><i class="bi bi-shield-fire me-1"></i> Módulos Técnicos</span>
                <span class="text-white-50 text-xs d-none d-md-inline">Guías y Criterios Oficiales de Protección Pasiva</span>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <button class="btn btn-sm btn-outline-light rounded-3" data-bs-toggle="modal" data-bs-target="#modalNormativa">
                    <i class="bi bi-book-half me-1 text-warning"></i> Guía Normativa INN
                </button>
                <button class="btn btn-sm btn-outline-light rounded-3" data-bs-toggle="modal" data-bs-target="#modalLaboratorios">
                    <i class="bi bi-shield-check me-1 text-info"></i> IDIEM / DICTUC
                </button>
                <button class="btn btn-sm btn-outline-light rounded-3" data-bs-toggle="modal" data-bs-target="#modalExposicion">
                    <i class="bi bi-layers-half me-1 text-success"></i> Criterios P4C / V3C
                </button>
                <button class="btn btn-sm btn-outline-warning rounded-3" data-bs-toggle="modal" data-bs-target="#modalPlanes">
                    <i class="bi bi-tags-fill me-1"></i> Planes y Precios
                </button>
            </div>
        </div>
    </div>

    <!-- PILARES / BENEFICIOS -->
    <section id="beneficios" class="py-6 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge-luxury badge-fire-soft mb-2">Propuesta de Valor de Ingeniería</span>
                <h2 class="fw-bold text-dark mt-2">Precisión y Respaldo Legal para tu Proyecto</h2>
                <p class="text-muted col-lg-7 mx-auto">Elimina errores en memorias de cálculo y determina con certeza los espesores requeridos por laboratorios oficiales acreditados ante el INN.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 floating-card p-4">
                        <div class="icon-shape-gradient mb-3" style="background: var(--fire-gradient);">
                            <i class="bi bi-cpu"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-2">Motor Geométrico de 11 Perfiles</h4>
                        <p class="text-muted" style="font-size: 0.9rem;">Formulación analítica exacta para perfiles H, tubulares rectangulares y circulares, canales, costaneras atiesadas y en cajón, ángulos y perfiles Z con acuerdos curvos.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 floating-card p-4">
                        <div class="icon-shape-gradient mb-3" style="background: var(--navy-gradient);">
                            <i class="bi bi-database-check"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-2">Matriz de Ensayos Certificados</h4>
                        <p class="text-muted" style="font-size: 0.9rem;">Cruce algorítmico inmediato contra curvas oficiales de marcas ensayadas en laboratorios <strong>IDIEM, DICTUC e IDIC</strong> bajo norma NCh935/1.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 floating-card p-4">
                        <div class="icon-shape-gradient mb-3" style="background: var(--dark-gradient);">
                            <i class="bi bi-file-earmark-check"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-2">Memoria Técnica en PDF Oficial</h4>
                        <p class="text-muted" style="font-size: 0.9rem;">Emisión de documentos ejecutivos con cortes 2D, memoria dimensional y directrices técnicas exigidas por la norma <strong>NCh3040.Of2007</strong> para recepción municipal.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN: GALERÍA INTERACTIVA DE PERFILES CON DIAGRAMAS REALES -->
    <section id="galeria-perfiles" class="py-6" style="background: #f4f7fb;">
        <div class="container">
            <div class="row align-items-end mb-4">
                <div class="col-lg-7">
                    <div class="badge-luxury badge-navy-soft mb-2">
                        <i class="bi bi-bounding-box-circles"></i> Biblioteca Geométrica 2D
                    </div>
                    <h2 class="fw-bolder text-dark mb-2">Galería de Perfiles y Diagramas de Corte</h2>
                    <p class="text-muted mb-0">
                        Visualiza el perímetro expuesto al fuego ($P$) alternando entre columnas aisladas (4 Caras) y vigas bajo losa continua (3 Caras). Haz clic en cualquier perfil para simularlo en tiempo real.
                    </p>
                </div>
                <div class="col-lg-5 text-lg-end mt-3 mt-lg-0">
                    <div class="d-inline-flex p-1 bg-white rounded-3 shadow-sm border">
                        <button type="button" class="exposure-toggle-btn active me-1" id="btnToggle4C" onclick="cambiarExposicionGaleria('4_caras')">
                            <i class="bi bi-shield-fill me-1"></i> 4 Caras (P4C / V4C)
                        </button>
                        <button type="button" class="exposure-toggle-btn" id="btnToggle3C" onclick="cambiarExposicionGaleria('3_caras')">
                            <i class="bi bi-shield-shaded me-1"></i> 3 Caras (V3C)
                        </button>
                    </div>
                </div>
            </div>

            <!-- GRID DE 11 PERFILES REALES -->
            <div class="row g-4" id="gridPerfilesGaleria">
                
                <!-- HSR -->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="profile-card h-100 d-flex flex-column">
                        <div class="profile-img-container">
                            <span class="badge bg-dark position-absolute top-0 start-0 m-2 text-xxs">HSR</span>
                            <img class="img-corte" data-forma="HSR" src="./assets/img/Cortes/4_caras/HSR.png" alt="Perfil H Sin Radio" onerror="this.src='/assets/img/Cortes/4_caras/HSR.png'">
                        </div>
                        <div class="p-3 d-flex flex-column flex-grow-1">
                            <h6 class="fw-bold text-dark mb-1">Perfil H / I Soldado (HSR)</h6>
                            <p class="text-xs text-muted mb-2">Vigas y columnas de alas paralelas soldadas o armadas (HN, IN).</p>
                            <div class="bg-light p-2 rounded text-xxs mb-3 mt-auto font-monospace">
                                A = B1·e1 + B2·e2 + H·t - t(e1+e2)
                            </div>
                            <button class="btn btn-sm btn-outline-danger w-100 fw-bold" onclick="abrirSimuladorConPerfil('HSR')">
                                <i class="bi bi-calculator me-1"></i> Simular Perfil
                            </button>
                        </div>
                    </div>
                </div>

                <!-- HCR -->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="profile-card h-100 d-flex flex-column">
                        <div class="profile-img-container">
                            <span class="badge bg-dark position-absolute top-0 start-0 m-2 text-xxs">HCR</span>
                            <img class="img-corte" data-forma="HCR" src="./assets/img/Cortes/4_caras/HCR.png" alt="Perfil H Con Radio" onerror="this.src='/assets/img/Cortes/4_caras/HCR.png'">
                        </div>
                        <div class="p-3 d-flex flex-column flex-grow-1">
                            <h6 class="fw-bold text-dark mb-1">Perfil H / I Laminado (HCR)</h6>
                            <p class="text-xs text-muted mb-2">Perfiles laminados en caliente con acuerdo curvo (HEA, HEB, IPE, IPN).</p>
                            <div class="bg-light p-2 rounded text-xxs mb-3 mt-auto font-monospace">
                                + 4·(r² - π·r²/4) en Área
                            </div>
                            <button class="btn btn-sm btn-outline-danger w-100 fw-bold" onclick="abrirSimuladorConPerfil('HCR')">
                                <i class="bi bi-calculator me-1"></i> Simular Perfil
                            </button>
                        </div>
                    </div>
                </div>

                <!-- R (Tubo Rectangular) -->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="profile-card h-100 d-flex flex-column">
                        <div class="profile-img-container">
                            <span class="badge bg-dark position-absolute top-0 start-0 m-2 text-xxs">R</span>
                            <img class="img-corte" data-forma="R" src="./assets/img/Cortes/4_caras/R.png" alt="Tubo Rectangular" onerror="this.src='/assets/img/Cortes/4_caras/R.png'">
                        </div>
                        <div class="p-3 d-flex flex-column flex-grow-1">
                            <h6 class="fw-bold text-dark mb-1">Tubo Rectangular / Cuadrado</h6>
                            <p class="text-xs text-muted mb-2">Perfiles tubulares estructurales cerrados para columnas y diagonales.</p>
                            <div class="bg-light p-2 rounded text-xxs mb-3 mt-auto font-monospace">
                                P = 2B + 2H - 16e + 4πe
                            </div>
                            <button class="btn btn-sm btn-outline-danger w-100 fw-bold" onclick="abrirSimuladorConPerfil('R')">
                                <i class="bi bi-calculator me-1"></i> Simular Perfil
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Circular -->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="profile-card h-100 d-flex flex-column">
                        <div class="profile-img-container">
                            <span class="badge bg-dark position-absolute top-0 start-0 m-2 text-xxs">Circular</span>
                            <img class="img-corte" data-forma="Circular" src="./assets/img/Cortes/4_caras/Circular.png" alt="Tubo Cilíndrico" onerror="this.src='/assets/img/Cortes/4_caras/Circular.png'">
                        </div>
                        <div class="p-3 d-flex flex-column flex-grow-1">
                            <h6 class="fw-bold text-dark mb-1">Tubo Cilíndrico Circular</h6>
                            <p class="text-xs text-muted mb-2">Columnas y tirantes circulares de acero con calentamiento 360°.</p>
                            <div class="bg-light p-2 rounded text-xxs mb-3 mt-auto font-monospace">
                                P = π·D | A = π·D·e - π·e²
                            </div>
                            <button class="btn btn-sm btn-outline-danger w-100 fw-bold" onclick="abrirSimuladorConPerfil('Circular')">
                                <i class="bi bi-calculator me-1"></i> Simular Perfil
                            </button>
                        </div>
                    </div>
                </div>

                <!-- C (Canal) -->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="profile-card h-100 d-flex flex-column">
                        <div class="profile-img-container">
                            <span class="badge bg-dark position-absolute top-0 start-0 m-2 text-xxs">C</span>
                            <img class="img-corte" data-forma="C" src="./assets/img/Cortes/4_caras/C.png" alt="Canal C Simple" onerror="this.src='/assets/img/Cortes/4_caras/C.png'">
                        </div>
                        <div class="p-3 d-flex flex-column flex-grow-1">
                            <h6 class="fw-bold text-dark mb-1">Canal C Simple</h6>
                            <p class="text-xs text-muted mb-2">Canal U o C conformado en frío o laminado para vigas y arriostramientos.</p>
                            <div class="bg-light p-2 rounded text-xxs mb-3 mt-auto font-monospace">
                                P_4C = 4B + 2H - 14e + 3πe
                            </div>
                            <button class="btn btn-sm btn-outline-danger w-100 fw-bold" onclick="abrirSimuladorConPerfil('C')">
                                <i class="bi bi-calculator me-1"></i> Simular Perfil
                            </button>
                        </div>
                    </div>
                </div>

                <!-- IC (Doble Canal) -->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="profile-card h-100 d-flex flex-column">
                        <div class="profile-img-container">
                            <span class="badge bg-dark position-absolute top-0 start-0 m-2 text-xxs">IC</span>
                            <img class="img-corte" data-forma="IC" src="./assets/img/Cortes/4_caras/IC.png" alt="Doble Canal IC" onerror="this.src='/assets/img/Cortes/4_caras/IC.png'">
                        </div>
                        <div class="p-3 d-flex flex-column flex-grow-1">
                            <h6 class="fw-bold text-dark mb-1">Doble Canal C (IC)</h6>
                            <p class="text-xs text-muted mb-2">Dos canales C unidos por el alma formando un perfil en I compuesto.</p>
                            <div class="bg-light p-2 rounded text-xxs mb-3 mt-auto font-monospace">
                                P = 8B + 2H - 20e + 6πe
                            </div>
                            <button class="btn btn-sm btn-outline-danger w-100 fw-bold" onclick="abrirSimuladorConPerfil('IC')">
                                <i class="bi bi-calculator me-1"></i> Simular Perfil
                            </button>
                        </div>
                    </div>
                </div>

                <!-- CA (Costanera Atiesada) -->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="profile-card h-100 d-flex flex-column">
                        <div class="profile-img-container">
                            <span class="badge bg-dark position-absolute top-0 start-0 m-2 text-xxs">CA</span>
                            <img class="img-corte" data-forma="CA" src="./assets/img/Cortes/4_caras/CA.png" alt="Costanera Atiesada" onerror="this.src='/assets/img/Cortes/4_caras/CA.png'">
                        </div>
                        <div class="p-3 d-flex flex-column flex-grow-1">
                            <h6 class="fw-bold text-dark mb-1">Costanera Atiesada (CA)</h6>
                            <p class="text-xs text-muted mb-2">Perfil C plegado con pestañas de rigidización para correas de techo y muro.</p>
                            <div class="bg-light p-2 rounded text-xxs mb-3 mt-auto font-monospace">
                                P = 4C + 4B + 2H + 6πe - 30e
                            </div>
                            <button class="btn btn-sm btn-outline-danger w-100 fw-bold" onclick="abrirSimuladorConPerfil('CA')">
                                <i class="bi bi-calculator me-1"></i> Simular Perfil
                            </button>
                        </div>
                    </div>
                </div>

                <!-- ICA (Doble Costanera) -->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="profile-card h-100 d-flex flex-column">
                        <div class="profile-img-container">
                            <span class="badge bg-dark position-absolute top-0 start-0 m-2 text-xxs">ICA</span>
                            <img class="img-corte" data-forma="ICA" src="./assets/img/Cortes/4_caras/ICA.png" alt="Doble Costanera ICA" onerror="this.src='/assets/img/Cortes/4_caras/ICA.png'">
                        </div>
                        <div class="p-3 d-flex flex-column flex-grow-1">
                            <h6 class="fw-bold text-dark mb-1">Doble Costanera (ICA)</h6>
                            <p class="text-xs text-muted mb-2">Dos perfiles CA unidos alma con alma para columnas y vigas maestras.</p>
                            <div class="bg-light p-2 rounded text-xxs mb-3 mt-auto font-monospace">
                                P = 8C + 8B + 2H - 52e + 12πe
                            </div>
                            <button class="btn btn-sm btn-outline-danger w-100 fw-bold" onclick="abrirSimuladorConPerfil('ICA')">
                                <i class="bi bi-calculator me-1"></i> Simular Perfil
                            </button>
                        </div>
                    </div>
                </div>

                <!-- OCA (Costanera Cajón) -->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="profile-card h-100 d-flex flex-column">
                        <div class="profile-img-container">
                            <span class="badge bg-dark position-absolute top-0 start-0 m-2 text-xxs">OCA</span>
                            <img class="img-corte" data-forma="OCA" src="./assets/img/Cortes/4_caras/OCA.png" alt="Costanera Cajón OCA" onerror="this.src='/assets/img/Cortes/4_caras/OCA.png'">
                        </div>
                        <div class="p-3 d-flex flex-column flex-grow-1">
                            <h6 class="fw-bold text-dark mb-1">Costanera Cajón (OCA)</h6>
                            <p class="text-xs text-muted mb-2">Dos costaneras enfrentadas soldadas en cajón cerrado de alta rigidez torsional.</p>
                            <div class="bg-light p-2 rounded text-xxs mb-3 mt-auto font-monospace">
                                P = 4B + 2H - 24e + 8πe
                            </div>
                            <button class="btn btn-sm btn-outline-danger w-100 fw-bold" onclick="abrirSimuladorConPerfil('OCA')">
                                <i class="bi bi-calculator me-1"></i> Simular Perfil
                            </button>
                        </div>
                    </div>
                </div>

                <!-- L (Ángulo) -->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="profile-card h-100 d-flex flex-column">
                        <div class="profile-img-container">
                            <span class="badge bg-dark position-absolute top-0 start-0 m-2 text-xxs">L</span>
                            <img class="img-corte" data-forma="L" src="./assets/img/Cortes/4_caras/L.png" alt="Ángulo L" onerror="this.src='/assets/img/Cortes/4_caras/L.png'">
                        </div>
                        <div class="p-3 d-flex flex-column flex-grow-1">
                            <h6 class="fw-bold text-dark mb-1">Ángulo Estructural L</h6>
                            <p class="text-xs text-muted mb-2">Perfiles angulares en L para diagonales de reticulados y arriostramientos.</p>
                            <div class="bg-light p-2 rounded text-xxs mb-3 mt-auto font-monospace">
                                P = 2H + 2B - 6e + 1.5πe
                            </div>
                            <button class="btn btn-sm btn-outline-danger w-100 fw-bold" onclick="abrirSimuladorConPerfil('L')">
                                <i class="bi bi-calculator me-1"></i> Simular Perfil
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Z (Perfil Z) -->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="profile-card h-100 d-flex flex-column">
                        <div class="profile-img-container">
                            <span class="badge bg-dark position-absolute top-0 start-0 m-2 text-xxs">Z</span>
                            <img class="img-corte" data-forma="Z" src="./assets/img/Cortes/4_caras/Z.png" alt="Perfil Z Plegado" onerror="this.src='/assets/img/Cortes/4_caras/Z.png'">
                        </div>
                        <div class="p-3 d-flex flex-column flex-grow-1">
                            <h6 class="fw-bold text-dark mb-1">Perfil Z Plegado</h6>
                            <p class="text-xs text-muted mb-2">Costanera Z con atiesadores inclinados a 22.5° para cubiertas industriales.</p>
                            <div class="bg-light p-2 rounded text-xxs mb-3 mt-auto font-monospace">
                                Corrección trigonométrica tan(22.5°)
                            </div>
                            <button class="btn btn-sm btn-outline-danger w-100 fw-bold" onclick="abrirSimuladorConPerfil('Z')">
                                <i class="bi bi-calculator me-1"></i> Simular Perfil
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- CÓMO FUNCIONA (PASO A PASO) -->
    <section id="como-funciona" class="py-6 bg-white">
        <div class="container py-3">
            <div class="text-center mb-5">
                <span class="badge-luxury badge-fire-soft mb-2">Flujo de Trabajo Automatizado</span>
                <h2 class="fw-bold text-dark mt-2">Especifica tu Estructura en 3 Simples Pasos</h2>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center rounded-4 bg-light">
                        <div class="step-badge mx-auto mb-3">1</div>
                        <h5 class="fw-bold text-dark mb-2">Ingresa tu Perfil</h5>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">Define el tipo geométrico del elemento (viga o pilar), sus dimensiones en milímetros y la condición de exposición térmica (3 o 4 caras).</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center rounded-4 bg-light">
                        <div class="step-badge mx-auto mb-3">2</div>
                        <h5 class="fw-bold text-dark mb-2">Cálculo y Cruce Certificado</h5>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">El motor calcula la masividad exacta ($m^{-1}$) y cruza los datos con la matriz de ensayos oficiales de pinturas homologadas (IDIEM/DICTUC).</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center rounded-4 bg-light">
                        <div class="step-badge mx-auto mb-3">3</div>
                        <h5 class="fw-bold text-dark mb-2">Descarga el PDF Oficial</h5>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">Obtén el informe técnico formal con diagramas 2D de corte, espesores en micras y respaldo normativo para inspección en obra.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NORMATIVA Y MARCO LEGAL -->
    <section id="normativa" class="py-6" style="background: #f4f6f9;">
        <div class="container text-center">
            <div class="col-lg-8 mx-auto">
                <span class="badge-luxury badge-navy-soft mb-2">Marco Regulatorio Nacional</span>
                <h2 class="fw-bold text-dark mt-2 mb-3">100% Conforme a la Normativa Chilena</h2>
                <p class="text-muted mb-4">
                    La Ordenanza General de Urbanismo y Construcciones (OGUC, Art. 4.3.3) y la norma NCh3040.Of2007 exigen que toda aplicación de pintura intumescente cuente con respaldo de ensayos en laboratorios oficiales y cumpla con espesores mínimos certificados.
                </p>

                <div class="card p-4 border-0 shadow-sm rounded-4 bg-white mb-4">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-4 border-end">
                            <h6 class="fw-bold text-dark mb-1">OGUC Art. 4.3.3</h6>
                            <small class="text-muted">Resistencias F15 a F120</small>
                        </div>
                        <div class="col-md-4 border-end">
                            <h6 class="fw-bold text-dark mb-1">NCh935/1</h6>
                            <small class="text-muted">Curvas de Ensayo al Fuego</small>
                        </div>
                        <div class="col-md-4">
                            <h6 class="fw-bold text-dark mb-1">NCh3040.Of2007</h6>
                            <small class="text-muted">Certificación Oficial INN</small>
                        </div>
                    </div>
                </div>

                <button class="btn btn-outline-dark fw-bold rounded-3 px-4" data-bs-toggle="modal" data-bs-target="#modalNormativa">
                    <i class="bi bi-journal-text me-1 text-danger"></i> Ver Resumen Normativo Completo
                </button>
            </div>
        </div>
    </section>

    <!-- FAQ ACORDEÓN INTERACTIVO Y CONTADORES -->
    <section id="faq-metricas" class="py-6 bg-white">
        <div class="container">
            
            <!-- CONTADORES ANIMADOS -->
            <div class="row g-4 mb-6">
                <div class="col-lg-3 col-6">
                    <div class="stat-counter-card">
                        <div class="stat-number text-danger" id="cntPerfiles">15,420</div>
                        <h6 class="fw-bold text-dark mb-1">Perfiles Calculados</h6>
                        <small class="text-muted">Ensayados conforme NCh3040</small>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="stat-counter-card">
                        <div class="stat-number text-primary" id="cntMemorias">1,850</div>
                        <h6 class="fw-bold text-dark mb-1">Memorias Emitidas</h6>
                        <small class="text-muted">Aprobadas por ITO y DOM</small>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="stat-counter-card">
                        <div class="stat-number text-success">100%</div>
                        <h6 class="fw-bold text-dark mb-1">Conformidad Legal</h6>
                        <small class="text-muted">Alineado al Art. 4.3.3 OGUC</small>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="stat-counter-card">
                        <div class="stat-number text-warning">3</div>
                        <h6 class="fw-bold text-dark mb-1">Laboratorios INN</h6>
                        <small class="text-muted">IDIEM · DICTUC · IDIC</small>
                    </div>
                </div>
            </div>

            <!-- ACORDEÓN BOOTSTRAP 5 -->
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center mb-5">
                        <span class="badge-luxury badge-fire-soft mb-2">Resolución Técnica Especializada</span>
                        <h2 class="fw-bolder text-dark">Preguntas Frecuentes sobre Especificación y Normativa</h2>
                        <p class="text-muted">Criterios de ingeniería contra fuego, tolerancias de medición electromagnética y recepción en obra.</p>
                    </div>

                    <div class="accordion accordion-luxury" id="accordionEspecificador">
                        
                        <!-- FAQ 1 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true">
                                    <i class="bi bi-1-circle-fill text-danger me-2"></i> ¿Cómo influye el factor de masividad (P/A o Ap/V) en el espesor de pintura intumescente?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionEspecificador">
                                <div class="accordion-body">
                                    La <strong>masividad ($m^{-1}$)</strong> representa el cociente entre el perímetro expuesto al calor ($P$, en metros) y el área de la sección transversal de acero ($A$, en $m^2$). Un perfil con alta masividad (perfil delgado y esbelto) se calienta mucho más rápido en un incendio estándar que un perfil macizo y robusto. Por ende, <strong>a mayor masividad, mayor será el espesor de película seca (DFT en micras)</strong> que exige la curva de ensayo de laboratorio para garantizar la resistencia F15, F30, F60, F90 o F120 según NCh935/1.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 2 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                    <i class="bi bi-2-circle-fill text-danger me-2"></i> ¿En qué consiste la regla 80-20 de la norma NCh3040.Of2007 para la recepción en terreno?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionEspecificador">
                                <div class="accordion-body">
                                    La norma chilena <strong>NCh3040.Of2007</strong> establece tres condiciones obligatorias de aprobación de espesores medidos mediante medidor magnético electromagnético en obra:
                                    <ul class="mt-2 mb-0">
                                        <li><strong>1. Espesor Promedio:</strong> El promedio de todas las lecturas registradas en un elemento o sector no puede ser inferior al espesor especificado en el informe técnico oficial ($E_{prom} \ge E_{esp}$).</li>
                                        <li><strong>2. Tolerancia Mínima Individual:</strong> Ninguna lectura puntual puede registrar menos del <strong>80%</strong> del espesor de diseño ($E_i \ge 0.80 \times E_{esp}$).</li>
                                        <li><strong>3. Límite de Frecuencia 80-100%:</strong> Como máximo, un <strong>20%</strong> de las lecturas individuales puede situarse en el rango comprendido entre el 80% y el 100% del espesor especificado.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 3 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                    <i class="bi bi-3-circle-fill text-danger me-2"></i> ¿Por qué una viga de 3 caras (V3C) consume significativamente menos pintura que un pilar de 4 caras (P4C)?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionEspecificador">
                                <div class="accordion-body">
                                    Cuando una viga sostiene una losa continua de hormigón armado o placa colaborante (deck metálico), el ala superior queda térmicamente resguardada del fuego directo. Al descontar el ala superior del perímetro expuesto ($P_{V3C} < P_{4C}$), la masividad calculada se reduce drásticamente. Al disminuir la masividad, la matriz de ensayos oficiales certifica un espesor de micras sensiblemente inferior, ahorrando hasta un <strong>35% a 45% de pintura intumescente</strong> sin comprometer la seguridad estructural.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 4 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                    <i class="bi bi-4-circle-fill text-danger me-2"></i> ¿Cuáles son los requisitos de compatibilidad para el tren de pintura (Anticorrosivo + Intumescente + Topcoat)?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionEspecificador">
                                <div class="accordion-body">
                                    No se puede aplicar pintura intumescente sobre cualquier imprimante. El tren de pintura debe estar certificado por el fabricante y ensayado en laboratorio:
                                    <ul class="mt-2 mb-0">
                                        <li><strong>Sustrato:</strong> Granallado comercial o casi blanco según SSPC-SP 10 / ISO 8501-1 Sa $2\frac{1}{2}$ con perfil de rugosidad 35-50 µm.</li>
                                        <li><strong>Imprimante:</strong> Anticorrosivo alquídico corto en aceite o epóxico tolerante, aplicado a 50-75 µm. Evitar sobre-espesores de anticorrosivo que generen delaminación ante altas temperaturas.</li>
                                        <li><strong>Topcoat de Sellado:</strong> En ambientes semi-expuestos (C2-C3) o exteriores con radiación UV y humedad, es imperativo sellar con esmalte de poliuretano alifático o acrílico certificado a 40-50 µm.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA BANNER DIRECTO AL DASHBOARD -->
    <section class="py-6 text-white text-center position-relative" style="background: var(--fire-gradient);">
        <div class="container">
            <div class="col-lg-8 mx-auto">
                <h2 class="text-white fw-bold display-6 mb-3">¿Listo para especificar tu próximo proyecto?</h2>
                <p class="lead text-white-50 mb-4">
                    Accede al software y genera memorias de cálculo con el rigor que exigen los proyectos de ingeniería en Chile.
                </p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="{{ route('home') }}" class="btn btn-lg btn-light fw-bold text-danger px-5 py-3 rounded-3 shadow text-decoration-none">
                        <i class="bi bi-grid-fill me-2"></i> Ir al Dashboard
                    </a>
                    <button type="button" class="btn btn-lg btn-dark fw-bold px-4 py-3 rounded-3 shadow" data-bs-toggle="modal" data-bs-target="#modalCalculadoraMasividad">
                        <i class="bi bi-calculator-fill me-1"></i> Abrir Simulador
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="py-5 bg-white border-top">
        <div class="container">
            <div class="row align-items-center justify-content-between gy-3">
                <div class="col-md-6 text-center text-md-start">
                    <div class="d-flex align-items-center justify-content-center justify-content-md-start mb-2">
                        <div class="navbar-brand-logo me-2" style="width: 32px; height: 32px; font-size: 1rem;">
                            <i class="bi bi-fire"></i>
                        </div>
                        <span class="fw-bold text-dark">Especificador de Pintura Intumescente</span>
                    </div>
                    <p class="text-muted mb-0" style="font-size: 0.82rem;">
                        Plataforma de cálculo y certificación estructural de protección pasiva contra incendios en Chile.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="d-flex align-items-center justify-content-center justify-content-md-end gap-3 mb-2" style="font-size: 0.88rem;">
                        <a href="{{ route('login') }}" class="fw-bold text-dark text-decoration-none">Iniciar Sesión</a>
                        <span class="text-muted">·</span>
                        <a href="{{ route('register') }}" class="fw-bold text-dark text-decoration-none">Registrarse</a>
                        <span class="text-muted">·</span>
                        <a href="{{ route('home') }}" class="fw-bold text-danger text-decoration-none">Dashboard</a>
                    </div>
                    <small class="text-muted d-block" style="font-size: 0.75rem;">
                        © 2026 <strong>PinturaIntumescente.cl</strong> · Desarrollado por <strong>Neobranding</strong>.
                    </small>
                </div>
            </div>
        </div>
    </footer>

    <!-- ========================================================================= -->
    <!-- MODAL 1: CALCULADORA INTERACTIVA DE MASIVIDAD Y ESPESORES EN VIVO -->
    <!-- ========================================================================= -->
    <div class="modal fade modal-luxury" id="modalCalculadoraMasividad" tabindex="-1" aria-labelledby="modalCalculadoraLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                
                <!-- HEADER -->
                <div class="modal-header modal-header-dark">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: var(--fire-gradient);">
                            <i class="bi bi-calculator text-white fs-4"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold text-white mb-0" id="modalCalculadoraLabel">Calculadora de Masividad y Espesores en Vivo</h5>
                            <small class="text-white-50" style="font-size: 0.78rem;">Normas NCh3040.Of2007 · NCh935/1 · OGUC Art. 4.3.3</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <!-- BODY -->
                <div class="modal-body p-4 bg-light">
                    <div class="row g-4">
                        
                        <!-- COLUMNA IZQUIERDA: CONFIGURACIÓN Y COTAS -->
                        <div class="col-lg-6">
                            <div class="card border-0 shadow-sm rounded-3 p-3 bg-white h-100">
                                
                                <!-- 1. Selección de Geometría -->
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark d-flex justify-content-between align-items-center mb-2" style="font-size: 0.85rem;">
                                        <span><i class="bi bi-bounding-box text-danger me-1"></i> 1. Tipo de Perfil Estructural</span>
                                        <span class="badge bg-light text-dark border fw-normal" id="lblTipoPerfilNombre">HSR (Perfil H sin radio)</span>
                                    </label>
                                    
                                    <div class="d-flex flex-wrap gap-1" id="selectorGeometria">
                                        <button type="button" class="btn btn-sm btn-dark calc-geom-btn active text-white" data-geom="HSR">HSR</button>
                                        <button type="button" class="btn btn-sm btn-outline-dark calc-geom-btn" data-geom="HCR">HCR</button>
                                        <button type="button" class="btn btn-sm btn-outline-dark calc-geom-btn" data-geom="R">R (Tubo)</button>
                                        <button type="button" class="btn btn-sm btn-outline-dark calc-geom-btn" data-geom="Circular">Circular</button>
                                        <button type="button" class="btn btn-sm btn-outline-dark calc-geom-btn" data-geom="C">Canal C</button>
                                        <button type="button" class="btn btn-sm btn-outline-dark calc-geom-btn" data-geom="CA">CA (Costanera)</button>
                                        <button type="button" class="btn btn-sm btn-outline-dark calc-geom-btn" data-geom="ICA">ICA (Doble)</button>
                                        <button type="button" class="btn btn-sm btn-outline-dark calc-geom-btn" data-geom="OCA">OCA (Cajón)</button>
                                        <button type="button" class="btn btn-sm btn-outline-dark calc-geom-btn" data-geom="L">L (Ángulo)</button>
                                        <button type="button" class="btn btn-sm btn-outline-dark calc-geom-btn" data-geom="Z">Perfil Z</button>
                                    </div>
                                </div>

                                <!-- 2. Presets Típicos Chilenos -->
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark mb-1" style="font-size: 0.82rem;">
                                        <i class="bi bi-bookmark-check text-primary me-1"></i> Cargar Perfil Estándar Chileno (Opcional):
                                    </label>
                                    <select class="form-select form-select-sm rounded-3" id="selectPresetsChilenos">
                                        <option value="">-- Selecciona un perfil preconfigurado --</option>
                                    </select>
                                </div>

                                <!-- 3. Condición de Exposición -->
                                <div class="mb-3 p-2 bg-light rounded-3 border">
                                    <label class="form-label fw-bold text-dark mb-2 d-block" style="font-size: 0.82rem;">
                                        <i class="bi bi-shield-shaded text-danger me-1"></i> 2. Condición de Exposición al Fuego:
                                    </label>
                                    <div class="btn-group w-100" role="group" id="grupoExposicion">
                                        <input type="radio" class="btn-check" name="calcExposicion" id="exp4C" value="4C" checked autocomplete="off">
                                        <label class="btn btn-outline-primary btn-sm py-2 fw-semibold" for="exp4C">
                                            <i class="bi bi-shield-fill me-1"></i> 4 Caras (P4C / V4C)
                                        </label>

                                        <input type="radio" class="btn-check" name="calcExposicion" id="exp3C" value="3C" autocomplete="off">
                                        <label class="btn btn-outline-primary btn-sm py-2 fw-semibold" for="exp3C">
                                            <i class="bi bi-shield-check me-1"></i> 3 Caras (V3C con Losa)
                                        </label>
                                    </div>
                                    <small class="text-muted d-block mt-1 text-center" style="font-size: 0.72rem;" id="lblExposicionDesc">
                                        Calentamiento uniforme por los 4 lados del elemento estructural.
                                    </small>
                                </div>

                                <!-- 4. Dimensiones / Cotas Dinámicas -->
                                <div>
                                    <label class="form-label fw-bold text-dark mb-2" style="font-size: 0.82rem;">
                                        <i class="bi bi-rulers text-danger me-1"></i> 3. Dimensiones Transversales (mm):
                                    </label>
                                    
                                    <div class="row g-2" id="contenedorInputs">
                                        <!-- Input H -->
                                        <div class="col-6 col-md-4 calc-input-box" id="box_H">
                                            <label class="text-muted fw-semibold mb-1" style="font-size: 0.75rem;">Altura H (mm)</label>
                                            <div class="input-group input-group-sm">
                                                <input type="number" step="0.1" min="1" class="form-control fw-bold" id="inp_H" value="300">
                                                <span class="input-group-text bg-light">mm</span>
                                            </div>
                                        </div>

                                        <!-- Input B / B1 -->
                                        <div class="col-6 col-md-4 calc-input-box" id="box_B1">
                                            <label class="text-muted fw-semibold mb-1" style="font-size: 0.75rem;" id="lbl_B1">Base B (mm)</label>
                                            <div class="input-group input-group-sm">
                                                <input type="number" step="0.1" min="1" class="form-control fw-bold" id="inp_B1" value="150">
                                                <span class="input-group-text bg-light">mm</span>
                                            </div>
                                        </div>

                                        <!-- Input B2 -->
                                        <div class="col-6 col-md-4 calc-input-box" id="box_B2">
                                            <label class="text-muted fw-semibold mb-1" style="font-size: 0.75rem;">Base Inf. B2 (mm)</label>
                                            <div class="input-group input-group-sm">
                                                <input type="number" step="0.1" min="1" class="form-control fw-bold" id="inp_B2" value="150">
                                                <span class="input-group-text bg-light">mm</span>
                                            </div>
                                        </div>

                                        <!-- Input e / e1 -->
                                        <div class="col-6 col-md-4 calc-input-box" id="box_e1">
                                            <label class="text-muted fw-semibold mb-1" style="font-size: 0.75rem;" id="lbl_e1">Espesor e (mm)</label>
                                            <div class="input-group input-group-sm">
                                                <input type="number" step="0.1" min="0.5" class="form-control fw-bold" id="inp_e1" value="9.0">
                                                <span class="input-group-text bg-light">mm</span>
                                            </div>
                                        </div>

                                        <!-- Input e2 -->
                                        <div class="col-6 col-md-4 calc-input-box" id="box_e2">
                                            <label class="text-muted fw-semibold mb-1" style="font-size: 0.75rem;">Espesor Ala 2 e2</label>
                                            <div class="input-group input-group-sm">
                                                <input type="number" step="0.1" min="0.5" class="form-control fw-bold" id="inp_e2" value="9.0">
                                                <span class="input-group-text bg-light">mm</span>
                                            </div>
                                        </div>

                                        <!-- Input t (Espesor Alma H) -->
                                        <div class="col-6 col-md-4 calc-input-box" id="box_t">
                                            <label class="text-muted fw-semibold mb-1" style="font-size: 0.75rem;">Espesor Alma t (mm)</label>
                                            <div class="input-group input-group-sm">
                                                <input type="number" step="0.1" min="0.5" class="form-control fw-bold" id="inp_t" value="6.0">
                                                <span class="input-group-text bg-light">mm</span>
                                            </div>
                                        </div>

                                        <!-- Input r (Radio acuerdo) -->
                                        <div class="col-6 col-md-4 calc-input-box" id="box_r">
                                            <label class="text-muted fw-semibold mb-1" style="font-size: 0.75rem;">Radio r (mm)</label>
                                            <div class="input-group input-group-sm">
                                                <input type="number" step="0.1" min="0" class="form-control fw-bold" id="inp_r" value="13.0">
                                                <span class="input-group-text bg-light">mm</span>
                                            </div>
                                        </div>

                                        <!-- Input C (Pestaña) -->
                                        <div class="col-6 col-md-4 calc-input-box" id="box_C">
                                            <label class="text-muted fw-semibold mb-1" style="font-size: 0.75rem;">Pestaña C (mm)</label>
                                            <div class="input-group input-group-sm">
                                                <input type="number" step="0.1" min="1" class="form-control fw-bold" id="inp_C" value="15.0">
                                                <span class="input-group-text bg-light">mm</span>
                                            </div>
                                        </div>

                                        <!-- Input D (Diámetro Exterior) -->
                                        <div class="col-6 col-md-4 calc-input-box" id="box_D">
                                            <label class="text-muted fw-semibold mb-1" style="font-size: 0.75rem;">Diámetro Ext. D (mm)</label>
                                            <div class="input-group input-group-sm">
                                                <input type="number" step="0.1" min="1" class="form-control fw-bold" id="inp_D" value="114.3">
                                                <span class="input-group-text bg-light">mm</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNA DERECHA: RESULTADOS EN TIEMPO REAL -->
                        <div class="col-lg-6">
                            <div class="d-flex flex-column gap-3 h-100">
                                
                                <!-- TARJETA MASIVIDAD Y PROPIEDADES GEOMÉTRICAS -->
                                <div class="card border-0 shadow-sm rounded-3 p-3 text-white" style="background: linear-gradient(135deg, #111424 0%, #1a1f37 100%);">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="badge bg-danger text-white fw-bold px-2 py-1" style="font-size: 0.75rem;">
                                            CÁLCULO REACTIVO NCh3040
                                        </span>
                                        <span class="text-white-50" style="font-size: 0.75rem;" id="resGeomTag">HSR · 4 Caras</span>
                                    </div>

                                    <div class="row align-items-center g-3 my-1">
                                        <div class="col-6 text-center border-end border-secondary">
                                            <small class="text-white-50 text-uppercase d-block fw-semibold" style="font-size: 0.72rem; letter-spacing: 1px;">Masividad (P/A)</small>
                                            <div class="display-6 fw-bolder text-warning my-1" id="resMasividad">271</div>
                                            <span class="badge bg-warning text-dark fw-bold px-2 py-1" style="font-size: 0.72rem;" id="resMasividadNivel">Media</span>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-2">
                                                <small class="text-white-50 d-block" style="font-size: 0.72rem;">Perímetro Expuesto (P):</small>
                                                <strong class="text-white fs-6" id="resPerimetro">1,188 mm</strong>
                                            </div>
                                            <div>
                                                <small class="text-white-50 d-block" style="font-size: 0.72rem;">Área Transversal (A):</small>
                                                <strong class="text-white fs-6" id="resArea">4,392 mm²</strong>
                                                <small class="text-white-50" style="font-size: 0.7rem;" id="resAreaCm2">(43.92 cm²)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- TARJETA ESPESORES NORMATIVOS F30, F60, F90, F120 -->
                                <div class="card border-0 shadow-sm rounded-3 p-3 bg-white flex-grow-1">
                                    <div class="d-flex align-items-center justify-content-between mb-2 pb-2 border-bottom">
                                        <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.88rem;">
                                            <i class="bi bi-shield-fire text-danger me-1"></i> Espesores Mínimos Certificados (DFT)
                                        </h6>
                                        <span class="badge bg-light text-dark border fw-normal" style="font-size: 0.72rem;">Curvas Ensayadas</span>
                                    </div>

                                    <div class="row g-2 text-center" id="gridEspesores">
                                        <!-- F30 -->
                                        <div class="col-6 col-sm-3">
                                            <div class="p-2 rounded-3 border bg-light h-100">
                                                <span class="badge bg-info text-white mb-1" style="font-size: 0.7rem;">F30</span>
                                                <h5 class="fw-bolder text-dark mb-0" id="resF30Micras">519 µm</h5>
                                                <small class="text-muted d-block" style="font-size: 0.7rem;" id="resF30Mils">20.4 mils</small>
                                                <span class="badge bg-success-subtle text-success mt-1" style="font-size: 0.65rem;" id="badgeF30">Viable</span>
                                            </div>
                                        </div>

                                        <!-- F60 -->
                                        <div class="col-6 col-sm-3">
                                            <div class="p-2 rounded-3 border bg-light h-100">
                                                <span class="badge bg-primary text-white mb-1" style="font-size: 0.7rem;">F60</span>
                                                <h5 class="fw-bolder text-dark mb-0" id="resF60Micras">1,315 µm</h5>
                                                <small class="text-muted d-block" style="font-size: 0.7rem;" id="resF60Mils">51.8 mils</small>
                                                <span class="badge bg-success-subtle text-success mt-1" style="font-size: 0.65rem;" id="badgeF60">Viable</span>
                                            </div>
                                        </div>

                                        <!-- F90 -->
                                        <div class="col-6 col-sm-3">
                                            <div class="p-2 rounded-3 border bg-light h-100">
                                                <span class="badge bg-warning text-dark mb-1" style="font-size: 0.7rem;">F90</span>
                                                <h5 class="fw-bolder text-dark mb-0" id="resF90Micras">2,322 µm</h5>
                                                <small class="text-muted d-block" style="font-size: 0.7rem;" id="resF90Mils">91.4 mils</small>
                                                <span class="badge bg-success-subtle text-success mt-1" style="font-size: 0.65rem;" id="badgeF90">Viable</span>
                                            </div>
                                        </div>

                                        <!-- F120 -->
                                        <div class="col-6 col-sm-3">
                                            <div class="p-2 rounded-3 border bg-light h-100">
                                                <span class="badge bg-danger text-white mb-1" style="font-size: 0.7rem;">F120</span>
                                                <h5 class="fw-bolder text-dark mb-0" id="resF120Micras">Fuera Rango</h5>
                                                <small class="text-muted d-block" style="font-size: 0.7rem;" id="resF120Mils">N/A</small>
                                                <span class="badge bg-danger-subtle text-danger mt-1" style="font-size: 0.65rem;" id="badgeF120">Límite Superado</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Resumen Técnico Ejecutivo -->
                                    <div class="mt-3 p-2 rounded-3 bg-light border text-start" style="font-size: 0.75rem;">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <strong class="text-dark"><i class="bi bi-info-circle text-primary me-1"></i> Resumen de Especificación:</strong>
                                            <span class="text-muted">En Vivo</span>
                                        </div>
                                        <p class="text-muted mb-1" id="resTextoResumen">
                                            Perfil HSR (300×150×9×6) · Exposición: 4 Caras · Masividad M = 271 m⁻¹. Espesor sugerido para F60: 1,315 µm (51.8 mils).
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FOOTER -->
                <div class="modal-footer bg-white border-top px-4 py-3 d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-outline-secondary btn-sm px-3" id="btnCopiarCalculo">
                        <i class="bi bi-clipboard-check me-1"></i> Copiar Especificación
                    </button>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-light btn-sm px-3" data-bs-dismiss="modal">Cerrar</button>
                        <a href="{{ route('login') }}" class="btn btn-danger btn-sm px-4 fw-bold shadow-sm d-inline-flex align-items-center gap-1">
                            <span>Certificar en Dashboard</span>
                            <i class="bi bi-arrow-right-short fs-5"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- MODAL 2: GUÍA NORMATIVA INN (NCh3040 / NCh935 / OGUC) -->
    <!-- ========================================================================= -->
    <div class="modal fade modal-luxury" id="modalNormativa" tabindex="-1" aria-labelledby="modalNormativaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header modal-header-dark">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-book-half text-warning fs-4"></i>
                        <div>
                            <h5 class="modal-title fw-bold text-white mb-0" id="modalNormativaLabel">Marco Normativo de Protección Pasiva en Chile</h5>
                            <small class="text-white-50">Regulaciones INN, Minvu y OGUC</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body p-4 bg-light">
                    <div class="card border-0 p-3 mb-3 bg-white rounded-3 shadow-sm">
                        <h6 class="fw-bold text-danger"><i class="bi bi-file-earmark-ruled me-1"></i> 1. NCh3040.Of2007 (Inspección y Medición de Espesores)</h6>
                        <p class="text-sm text-muted mb-2">
                            Establece el protocolo oficial para la aplicación, inspección y medición de espesores de película seca en estructuras de acero mediante instrumentos electromagnéticos (SSPC-PA 2).
                        </p>
                        <div class="bg-light p-3 rounded-3 border">
                            <strong class="text-dark d-block mb-1 text-xs">Criterio de Aceptación (Regla 80-20):</strong>
                            <ul class="text-xs text-muted mb-0 ps-3">
                                <li><strong>Espesor Promedio:</strong> El promedio de todas las lecturas debe ser mayor o igual al espesor de especificación ($E_{prom} \ge E_{esp}$).</li>
                                <li><strong>Tolerancia Mínima:</strong> Ninguna lectura puntual puede ser menor al <strong>80%</strong> del espesor de diseño.</li>
                                <li><strong>Frecuencia:</strong> Máximo un <strong>20%</strong> de las lecturas individuales puede situarse entre el 80% y 100%.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="card border-0 p-3 mb-3 bg-white rounded-3 shadow-sm">
                        <h6 class="fw-bold text-primary"><i class="bi bi-fire me-1"></i> 2. NCh935/1 (Ensayo de Resistencia al Fuego)</h6>
                        <p class="text-sm text-muted mb-0">
                            Ensayo a escala real bajo la curva térmica estándar ISO 834. Determina el tiempo en minutos (F15, F30, F60, F90, F120) que el perfil de acero protegido resiste sin alcanzar la temperatura crítica de colapso ($538^\circ\text{C}$).
                        </p>
                    </div>

                    <div class="card border-0 p-3 bg-white rounded-3 shadow-sm">
                        <h6 class="fw-bold text-dark"><i class="bi bi-building me-1"></i> 3. OGUC Art. 4.3.3 / 4.3.4 (Exigencias de Resistencia)</h6>
                        <p class="text-sm text-muted mb-0">
                            Determina las exigencias de resistencia al fuego para elementos soportantes verticales (columnas), horizontales (vigas) y techumbres, según el destino del edificio, número de pisos y carga combustible.
                        </p>
                    </div>
                </div>
                <div class="modal-footer bg-white border-top">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Entendido</button>
                    <a href="{{ route('login') }}" class="btn btn-danger btn-sm fw-bold">Calcular en Dashboard</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- MODAL 3: LABORATORIOS DE ENSAYO Y MARCAS HOMOLOGADAS -->
    <!-- ========================================================================= -->
    <div class="modal fade modal-luxury" id="modalLaboratorios" tabindex="-1" aria-labelledby="modalLaboratoriosLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-header-dark">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-shield-check text-info fs-4"></i>
                        <div>
                            <h5 class="modal-title fw-bold text-white mb-0" id="modalLaboratoriosLabel">Laboratorios Oficiales de Ensayo en Chile</h5>
                            <small class="text-white-50">Acreditación INN bajo norma NCh-ISO 17025</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body p-4 bg-light">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="card border-0 p-3 bg-white h-100 rounded-3 text-center shadow-sm">
                                <div class="badge-luxury badge-navy-soft mx-auto mb-2">Universidad de Chile</div>
                                <h6 class="fw-bold text-dark">IDIEM</h6>
                                <p class="text-xs text-muted mb-0">Instituto de Investigaciones y Ensayes de Materiales.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 p-3 bg-white h-100 rounded-3 text-center shadow-sm">
                                <div class="badge-luxury badge-fire-soft mx-auto mb-2">P. U. Católica de Chile</div>
                                <h6 class="fw-bold text-dark">DICTUC</h6>
                                <p class="text-xs text-muted mb-0">Centro de Ensayos y Resistencia al Fuego.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 p-3 bg-white h-100 rounded-3 text-center shadow-sm">
                                <div class="badge-luxury badge-success-soft mx-auto mb-2">Ejército de Chile</div>
                                <h6 class="fw-bold text-dark">IDIC</h6>
                                <p class="text-xs text-muted mb-0">Instituto de Investigaciones y Control.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 p-3 mt-3 bg-white rounded-3 shadow-sm">
                        <h6 class="fw-bold text-dark mb-2"><i class="bi bi-layers text-danger me-1"></i> Esquema Certificado de Pintura (Tren de Pintura)</h6>
                        <ul class="text-xs text-muted ps-3 mb-0">
                            <li><strong>Imprimante:</strong> Anticorrosivo alquídico o epóxico tolerante ensayado (50 a 75 µm).</li>
                            <li><strong>Capa Intumescente:</strong> Base agua o base solvente según espesor calculado en la memoria técnica.</li>
                            <li><strong>Sello Topcoat:</strong> Esmalte de terminación compatible para protección ante humedad y rayos UV.</li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer bg-white border-top">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                    <a href="{{ route('login') }}" class="btn btn-danger btn-sm fw-bold">Entrar al Dashboard</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- MODAL 4: GUÍA DE EXPOSICIÓN AL FUEGO (P4C vs V4C vs V3C) -->
    <!-- ========================================================================= -->
    <div class="modal fade modal-luxury" id="modalExposicion" tabindex="-1" aria-labelledby="modalExposicionLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-header-dark">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-layers-half text-success fs-4"></i>
                        <div>
                            <h5 class="modal-title fw-bold text-white mb-0" id="modalExposicionLabel">Condiciones de Exposición Térmica</h5>
                            <small class="text-white-50">Ahorro y optimización de pintura según ubicación estructural</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body p-4 bg-light">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card border-0 p-3 bg-white h-100 rounded-3 shadow-sm">
                                <span class="badge bg-danger text-white mb-2" style="width: fit-content;">Pilar / Viga 4 Caras (P4C / V4C)</span>
                                <h6 class="fw-bold text-dark">Calentamiento 360°</h6>
                                <p class="text-xs text-muted mb-0">
                                    Elemento estructural aislado sin contacto directo con losas continuas. Todas sus caras externas absorben calor de forma simultánea, requiriendo el espesor pleno de intumescente.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 p-3 bg-white h-100 rounded-3 shadow-sm">
                                <span class="badge bg-success text-white mb-2" style="width: fit-content;">Viga 3 Caras (V3C con Losa)</span>
                                <h6 class="fw-bold text-dark">Ala Superior Protegida (Ahorro ~40%)</h6>
                                <p class="text-xs text-muted mb-0">
                                    Viga que soporta losa de hormigón armado o placa colaborante (deck). Al descontar el ala superior del perímetro expuesto ($P$), la masividad disminuye drásticamente, optimizando el consumo de pintura.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-white border-top">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#modalCalculadoraMasividad">
                        <i class="bi bi-calculator me-1"></i> Simular Diferencia en Vivo
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- MODAL 5: COMPARADOR DE PLANES Y PRECIOS -->
    <!-- ========================================================================= -->
    <div class="modal fade modal-luxury" id="modalPlanes" tabindex="-1" aria-labelledby="modalPlanesLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-header-dark">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-tags-fill text-warning fs-4"></i>
                        <div>
                            <h5 class="modal-title fw-bold text-white mb-0" id="modalPlanesLabel">Planes y Paquetes de Especificación</h5>
                            <small class="text-white-50">Créditos de perfiles para calculistas, constructoras y aplicadores</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body p-4 bg-light">
                    <div class="row g-4">
                        
                        <!-- PLAN BÁSICO -->
                        <div class="col-lg-4">
                            <div class="card border-0 p-4 bg-white rounded-4 shadow-sm h-100 text-center">
                                <span class="badge bg-light text-dark mb-2 mx-auto">Profesional Inicial</span>
                                <h4 class="fw-bold text-dark">Plan Básico</h4>
                                <div class="display-6 fw-bolder text-dark my-2">5 <small class="fs-6 text-muted">perfiles</small></div>
                                <p class="text-xs text-muted mb-4">Ideal para proyectos puntuales o ampliaciones estructurales.</p>
                                <ul class="text-xs text-start text-muted ps-3 mb-4">
                                    <li class="mb-1">Cálculo de masividad en 11 geometrías</li>
                                    <li class="mb-1">Exposición 3C y 4C</li>
                                    <li class="mb-1">Descarga de Fichas PDF oficiales</li>
                                </ul>
                                <a href="{{ route('register') }}" class="btn btn-outline-dark w-100 fw-bold mt-auto rounded-3">Crear Cuenta</a>
                            </div>
                        </div>

                        <!-- PLAN PRO -->
                        <div class="col-lg-4">
                            <div class="card border-2 border-danger p-4 bg-white rounded-4 shadow-lg h-100 text-center position-relative">
                                <span class="badge bg-danger text-white position-absolute top-0 start-50 translate-middle px-3 py-1">MÁS POPULAR</span>
                                <span class="badge bg-danger-subtle text-danger mb-2 mx-auto">Ingeniería & Cálculo</span>
                                <h4 class="fw-bold text-dark">Plan Profesional</h4>
                                <div class="display-6 fw-bolder text-danger my-2">50 <small class="fs-6 text-muted">perfiles</small></div>
                                <p class="text-xs text-muted mb-4">Para ingenieros calculistas y oficinas de arquitectura.</p>
                                <ul class="text-xs text-start text-muted ps-3 mb-4">
                                    <li class="mb-1">Gestión de múltiples proyectos simultáneos</li>
                                    <li class="mb-1">Cruce multi-marca de pinturas en Chile</li>
                                    <li class="mb-1">Memorias Técnicas completas con cortes 2D</li>
                                    <li class="mb-1">Soporte técnico preferente</li>
                                </ul>
                                <a href="{{ route('register') }}" class="btn btn-danger w-100 fw-bold mt-auto rounded-3 shadow">Comenzar Ahora</a>
                            </div>
                        </div>

                        <!-- PLAN EMPRESA -->
                        <div class="col-lg-4">
                            <div class="card border-0 p-4 bg-white rounded-4 shadow-sm h-100 text-center">
                                <span class="badge bg-dark text-white mb-2 mx-auto">Constructoras & ITO</span>
                                <h4 class="fw-bold text-dark">Plan Empresa</h4>
                                <div class="display-6 fw-bolder text-dark my-2">Ilimitado</div>
                                <p class="text-xs text-muted mb-4">Para grandes constructoras, aplicadores e inspecciones técnicas.</p>
                                <ul class="text-xs text-start text-muted ps-3 mb-4">
                                    <li class="mb-1">Perfiles ilimitados por año</li>
                                    <li class="mb-1">Múltiples usuarios por empresa</li>
                                    <li class="mb-1">Personalización con logotipo de la constructora</li>
                                    <li class="mb-1">Asesoría técnica en terreno</li>
                                </ul>
                                <a href="{{ route('register') }}" class="btn btn-outline-dark w-100 fw-bold mt-auto rounded-3">Contactar Ventas</a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer bg-white border-top">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                    <a href="{{ route('login') }}" class="btn btn-danger btn-sm fw-bold">Acceder al Dashboard</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 Bundle JS (Popper included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- MOTOR MATEMÁTICO REACTIVO Y CONTROLADORES JS PURO -->
    <script>
        (function () {
            'use strict';

            // Catálogo de Presets de Perfiles Chilenos
            const PRESETS = {
                HSR: [
                    { nombre: 'HN 30x44.1 (Soldado/Armado)', H: 300, B1: 150, B2: 150, e1: 9.0, e2: 9.0, t: 6.0 },
                    { nombre: 'IN 25x32.9 (Normal)', H: 250, B1: 125, B2: 125, e1: 8.0, e2: 8.0, t: 5.0 },
                    { nombre: 'HN 20x28.4', H: 200, B1: 100, B2: 100, e1: 8.0, e2: 8.0, t: 5.5 },
                    { nombre: 'IN 35x57.0', H: 350, B1: 150, B2: 150, e1: 11.0, e2: 11.0, t: 7.0 }
                ],
                HCR: [
                    { nombre: 'HEA 200 (Laminado Europeo)', H: 190, B1: 200, B2: 200, e1: 10.0, e2: 10.0, t: 6.5, r: 18.0 },
                    { nombre: 'HEB 200', H: 200, B1: 200, B2: 200, e1: 15.0, e2: 15.0, t: 9.0, r: 18.0 },
                    { nombre: 'IPE 240', H: 240, B1: 120, B2: 120, e1: 9.8, e2: 9.8, t: 6.2, r: 15.0 },
                    { nombre: 'IPN 200', H: 200, B1: 90, B2: 90, e1: 11.3, e2: 11.3, t: 7.5, r: 8.5 }
                ],
                R: [
                    { nombre: 'Tubo Rectangular 100x50x3.0', H: 100, B1: 50, e1: 3.0 },
                    { nombre: 'Tubo Rectangular 150x100x4.0', H: 150, B1: 100, e1: 4.0 },
                    { nombre: 'Tubo Cuadrado 100x100x3.0', H: 100, B1: 100, e1: 3.0 },
                    { nombre: 'Tubo Cuadrado 150x150x5.0', H: 150, B1: 150, e1: 5.0 }
                ],
                Circular: [
                    { nombre: 'Tubo Ø 114.3 x 3.2 mm (4" Sch10)', D: 114.3, e1: 3.2 },
                    { nombre: 'Tubo Ø 168.3 x 4.0 mm (6")', D: 168.3, e1: 4.0 },
                    { nombre: 'Tubo Ø 88.9 x 3.2 mm (3")', D: 88.9, e1: 3.2 },
                    { nombre: 'Tubo Ø 219.1 x 4.5 mm (8")', D: 219.1, e1: 4.5 }
                ],
                C: [
                    { nombre: 'Canal C 150x50x3.0', H: 150, B1: 50, e1: 3.0 },
                    { nombre: 'Canal C 100x50x2.0', H: 100, B1: 50, e1: 2.0 },
                    { nombre: 'Canal C 200x50x3.0', H: 200, B1: 50, e1: 3.0 }
                ],
                CA: [
                    { nombre: 'Costanera CA 100x50x15x2.0', H: 100, B1: 50, C: 15, e1: 2.0 },
                    { nombre: 'Costanera CA 125x50x15x2.0', H: 125, B1: 50, C: 15, e1: 2.0 },
                    { nombre: 'Costanera CA 150x50x15x3.0', H: 150, B1: 50, C: 15, e1: 3.0 },
                    { nombre: 'Costanera CA 200x50x20x3.0', H: 200, B1: 50, C: 20, e1: 3.0 }
                ],
                ICA: [
                    { nombre: 'Doble Costanera ICA 150x50x15x3.0', H: 150, B1: 50, C: 15, e1: 3.0 },
                    { nombre: 'Doble Costanera ICA 100x50x15x2.0', H: 100, B1: 50, C: 15, e1: 2.0 }
                ],
                OCA: [
                    { nombre: 'Costanera Cajón OCA 125x50x15x2.0', H: 125, B1: 50, C: 15, e1: 2.0 },
                    { nombre: 'Costanera Cajón OCA 150x50x15x3.0', H: 150, B1: 50, C: 15, e1: 3.0 }
                ],
                L: [
                    { nombre: 'Ángulo L 65x65x5.0', H: 65, B1: 65, e1: 5.0 },
                    { nombre: 'Ángulo L 50x50x4.0', H: 50, B1: 50, e1: 4.0 },
                    { nombre: 'Ángulo L 80x80x6.0', H: 80, B1: 80, e1: 6.0 }
                ],
                Z: [
                    { nombre: 'Perfil Z 150x50x20x2.0', H: 150, B1: 50, B2: 50, C: 20, e1: 2.0 },
                    { nombre: 'Perfil Z 200x60x20x3.0', H: 200, B1: 60, B2: 60, C: 20, e1: 3.0 }
                ]
            };

            const NOMBRES_GEOM = {
                HSR: 'HSR (Perfil H/I sin radio)',
                HCR: 'HCR (Perfil H/I con radio)',
                R: 'R (Tubo Rectangular / Cuadrado)',
                Circular: 'Circular (Tubo Cilíndrico)',
                C: 'C (Canal Simple)',
                CA: 'CA (Costanera Atiesada)',
                ICA: 'ICA (Doble Costanera)',
                OCA: 'OCA (Costanera en Cajón)',
                L: 'L (Ángulo Estructural)',
                Z: 'Z (Perfil Z Plegado)'
            };

            const CAMPOS_ACTIVOS = {
                HSR: ['H', 'B1', 'B2', 'e1', 'e2', 't'],
                HCR: ['H', 'B1', 'B2', 'e1', 'e2', 't', 'r'],
                R: ['H', 'B1', 'e1'],
                Circular: ['D', 'e1'],
                C: ['H', 'B1', 'e1'],
                CA: ['H', 'B1', 'C', 'e1'],
                ICA: ['H', 'B1', 'C', 'e1'],
                OCA: ['H', 'B1', 'C', 'e1'],
                L: ['H', 'B1', 'e1'],
                Z: ['H', 'B1', 'B2', 'C', 'e1']
            };

            let estadoSimulador = {
                geometria: 'HSR',
                exposicion: '4C'
            };

            // Cálculo Matemático de Área y Perímetro
            function calcularGeometria(geom, exp, vals) {
                const H = parseFloat(vals.H) || 0;
                const B1 = parseFloat(vals.B1) || 0;
                const B2 = parseFloat(vals.B2) || B1;
                const e1 = parseFloat(vals.e1) || 0;
                const e2 = parseFloat(vals.e2) || e1;
                const t = parseFloat(vals.t) || 0;
                const r = parseFloat(vals.r) || 0;
                const C = parseFloat(vals.C) || 0;
                const D = parseFloat(vals.D) || 0;
                const PI = Math.PI;
                const tan225 = Math.tan((22.5 * PI) / 180);

                let A = 0;
                let P = 0;

                if (exp === '3C') {
                    switch (geom) {
                        case 'HSR':
                            A = B1 * e1 + B2 * e2 + H * t - t * e1 - t * e2;
                            P = 2 * H + B1 + 2 * B2 - 2 * t;
                            break;
                        case 'HCR':
                            A = B1 * e1 + B2 * e2 + H * t - t * e1 - t * e2 + 4 * (r * r - (PI * r * r) / 4);
                            P = 2 * H + B1 + 2 * B2 - 2 * t + 2 * PI * r - 8 * r;
                            break;
                        case 'R':
                            A = 2 * e1 * (B1 + H - 8 * e1) + 3 * PI * (e1 * e1);
                            P = B1 + 2 * H - 12 * e1 + 4 * PI * e1;
                            break;
                        case 'Circular':
                            A = PI * D * e1 - PI * (e1 * e1);
                            P = PI * D;
                            break;
                        case 'C':
                            A = 2 * B1 * e1 + H * e1 - 8 * (e1 * e1) + (1.5 * PI * (e1 * e1));
                            P = 3 * B1 + 2 * H - 12 * e1 + 3 * PI * e1;
                            break;
                        case 'CA':
                            A = 2 * C * e1 + 2 * B1 * e1 + H * e1 - 16 * (e1 * e1) + 3 * PI * (e1 * e1);
                            P = 4 * C + 3 * B1 + 2 * H + 6 * PI * e1 - 26 * e1;
                            break;
                        case 'ICA':
                            A = 4 * C * e1 + 4 * B1 * e1 + 2 * H * e1 - 32 * (e1 * e1) + 6 * PI * (e1 * e1);
                            P = 8 * C + 6 * B1 + 2 * H - 44 * e1 + 10 * PI * e1;
                            break;
                        case 'OCA':
                            A = 4 * C * e1 + 4 * B1 * e1 + 2 * H * e1 - 32 * (e1 * e1) + 6 * PI * (e1 * e1);
                            P = 2 * B1 + 2 * H - 16 * e1 + 6 * PI * e1;
                            break;
                        case 'L':
                            A = H * e1 + B1 * e1 - 4 * (e1 * e1) + (0.75 * PI * (e1 * e1));
                            P = 2 * H + B1 - 4 * e1 + 6 * PI * e1;
                            break;
                        case 'Z':
                            A = (H + 2) * e1 + 2 * C * e1 + B1 * e1 + B2 * e1 + 2.25 * PI * (e1 * e1) - 8 * (e1 * e1) * tan225 - 8 * (e1 * e1);
                            P = 4 * C + 2 * B2 + B1 + 2 * H - 14 * e1 * tan225 - 12 * e1 + 4.5 * PI * e1;
                            break;
                    }
                } else {
                    switch (geom) {
                        case 'HSR':
                            A = B1 * e1 + B2 * e2 + H * t - t * e1 - t * e2;
                            P = 2 * H + 2 * B1 + 2 * B2 - 2 * t;
                            break;
                        case 'HCR':
                            A = B1 * e1 + B2 * e2 + H * t - t * e1 - t * e2 + 4 * (r * r - (PI * r * r) / 4);
                            P = 2 * H + 2 * B1 + 2 * B2 - 2 * t + 2 * PI * r - 8 * r;
                            break;
                        case 'R':
                            A = 2 * B1 * e1 + 2 * H * e1 - 16 * (e1 * e1) + 3 * PI * (e1 * e1);
                            P = 2 * B1 + 2 * H - 16 * e1 + 4 * PI * e1;
                            break;
                        case 'Circular':
                            A = PI * D * e1 - PI * (e1 * e1);
                            P = PI * D;
                            break;
                        case 'C':
                            A = 2 * B1 * e1 + H * e1 - 8 * (e1 * e1) + (1.5 * PI * (e1 * e1));
                            P = 4 * B1 + 2 * H - 14 * e1 + 3 * PI * e1;
                            break;
                        case 'CA':
                            A = 2 * C * e1 + 2 * B1 * e1 + H * e1 - 16 * (e1 * e1) + 3 * PI * (e1 * e1);
                            P = 4 * C + 4 * B1 + 2 * H + 6 * PI * e1 - 30 * e1;
                            break;
                        case 'ICA':
                            A = 4 * C * e1 + 4 * B1 * e1 + 2 * H * e1 - 32 * (e1 * e1) + 6 * PI * (e1 * e1);
                            P = 8 * C + 8 * B1 + 2 * H - 52 * e1 + 12 * PI * e1;
                            break;
                        case 'OCA':
                            A = 4 * C * e1 + 4 * B1 * e1 + 2 * H * e1 - 32 * (e1 * e1) + 6 * PI * (e1 * e1);
                            P = 4 * B1 + 2 * H - 24 * e1 + 8 * PI * e1;
                            break;
                        case 'L':
                            A = H * e1 + B1 * e1 - 4 * (e1 * e1) + (0.75 * PI * (e1 * e1));
                            P = 2 * H + 2 * B1 - 6 * e1 + 1.5 * PI * e1;
                            break;
                        case 'Z':
                            A = (H + 2) * e1 + 2 * C * e1 + B1 * e1 + B2 * e1 + 2.25 * PI * (e1 * e1) - 8 * (e1 * e1) * tan225 - 8 * (e1 * e1);
                            P = 4 * C + 2 * B1 + 2 * B2 + 2 * H - 16 * e1 * tan225 - 14 * e1 + 4.5 * PI * e1;
                            break;
                    }
                }

                A = Math.max(0, A);
                P = Math.max(0, P);
                const masividad = A > 0 ? Math.ceil((1000 * P) / A) : 0;

                return { A, P, masividad };
            }

            // Estimación de Espesores
            function estimarEspesores(M) {
                if (!M || M <= 0) {
                    return {
                        f30: { micras: 0, mils: 0, viable: false },
                        f60: { micras: 0, mils: 0, viable: false },
                        f90: { micras: 0, mils: 0, viable: false },
                        f120: { micras: 0, mils: 0, viable: false }
                    };
                }

                const f30Viable = M <= 450;
                const f30Micras = f30Viable ? Math.max(200, Math.round(180 + 1.25 * M)) : null;

                const f60Viable = M <= 400;
                const f60Micras = f60Viable ? Math.max(450, Math.round(380 + 3.45 * M)) : null;

                const f90Viable = M <= 320;
                const f90Micras = f90Viable ? Math.max(850, Math.round(750 + 5.80 * M)) : null;

                const f120Viable = M <= 240;
                const f120Micras = f120Viable ? Math.max(1400, Math.round(1350 + 7.60 * M)) : null;

                return {
                    f30: { micras: f30Micras, mils: f30Micras ? (f30Micras / 25.4).toFixed(1) : 'N/A', viable: f30Viable },
                    f60: { micras: f60Micras, mils: f60Micras ? (f60Micras / 25.4).toFixed(1) : 'N/A', viable: f60Viable },
                    f90: { micras: f90Micras, mils: f90Micras ? (f90Micras / 25.4).toFixed(1) : 'N/A', viable: f90Viable },
                    f120: { micras: f120Micras, mils: f120Micras ? (f120Micras / 25.4).toFixed(1) : 'N/A', viable: f120Viable }
                };
            }

            function actualizarVisibilidadInputs() {
                const activos = CAMPOS_ACTIVOS[estadoSimulador.geometria] || [];
                const todos = ['H', 'B1', 'B2', 'e1', 'e2', 't', 'r', 'C', 'D'];

                todos.forEach(campo => {
                    const box = document.getElementById('box_' + campo);
                    if (box) {
                        box.style.display = activos.includes(campo) ? 'block' : 'none';
                    }
                });

                const lblB1 = document.getElementById('lbl_B1');
                const lble1 = document.getElementById('lbl_e1');
                if (lblB1) {
                    lblB1.textContent = (estadoSimulador.geometria === 'HSR' || estadoSimulador.geometria === 'HCR' || estadoSimulador.geometria === 'Z')
                        ? 'Base Superior B1 (mm)'
                        : 'Ancho Base B (mm)';
                }
                if (lble1) {
                    lble1.textContent = (estadoSimulador.geometria === 'HSR' || estadoSimulador.geometria === 'HCR')
                        ? 'Espesor Ala e1 (mm)'
                        : 'Espesor e (mm)';
                }

                const selPreset = document.getElementById('selectPresetsChilenos');
                if (selPreset) {
                    selPreset.innerHTML = '<option value="">-- Selecciona un perfil preconfigurado --</option>';
                    const lista = PRESETS[estadoSimulador.geometria] || [];
                    lista.forEach((p, idx) => {
                        const opt = document.createElement('option');
                        opt.value = idx;
                        opt.textContent = p.nombre;
                        selPreset.appendChild(opt);
                    });
                }
            }

            function recalcularSimulador() {
                const vals = {
                    H: document.getElementById('inp_H') ? document.getElementById('inp_H').value : 0,
                    B1: document.getElementById('inp_B1') ? document.getElementById('inp_B1').value : 0,
                    B2: document.getElementById('inp_B2') ? document.getElementById('inp_B2').value : 0,
                    e1: document.getElementById('inp_e1') ? document.getElementById('inp_e1').value : 0,
                    e2: document.getElementById('inp_e2') ? document.getElementById('inp_e2').value : 0,
                    t: document.getElementById('inp_t') ? document.getElementById('inp_t').value : 0,
                    r: document.getElementById('inp_r') ? document.getElementById('inp_r').value : 0,
                    C: document.getElementById('inp_C') ? document.getElementById('inp_C').value : 0,
                    D: document.getElementById('inp_D') ? document.getElementById('inp_D').value : 0
                };

                const res = calcularGeometria(estadoSimulador.geometria, estadoSimulador.exposicion, vals);
                const esp = estimarEspesores(res.masividad);

                const elMasividad = document.getElementById('resMasividad');
                const elPerimetro = document.getElementById('resPerimetro');
                const elArea = document.getElementById('resArea');
                const elAreaCm2 = document.getElementById('resAreaCm2');
                const elGeomTag = document.getElementById('resGeomTag');
                const elNivel = document.getElementById('resMasividadNivel');

                if (elMasividad) elMasividad.textContent = res.masividad || '0';
                if (elPerimetro) elPerimetro.textContent = Math.round(res.P).toLocaleString('es-CL') + ' mm';
                if (elArea) elArea.textContent = Math.round(res.A).toLocaleString('es-CL') + ' mm²';
                if (elAreaCm2) elAreaCm2.textContent = '(' + (res.A / 100).toFixed(2) + ' cm²)';
                if (elGeomTag) elGeomTag.textContent = estadoSimulador.geometria + ' · ' + (estadoSimulador.exposicion === '3C' ? '3 Caras (V3C)' : '4 Caras (4C)');

                if (elNivel) {
                    if (res.masividad <= 120) {
                        elNivel.className = 'badge bg-success text-white fw-bold px-2 py-1';
                        elNivel.textContent = 'Baja Masividad (Favorable)';
                    } else if (res.masividad <= 250) {
                        elNivel.className = 'badge bg-warning text-dark fw-bold px-2 py-1';
                        elNivel.textContent = 'Masividad Media';
                    } else {
                        elNivel.className = 'badge bg-danger text-white fw-bold px-2 py-1';
                        elNivel.textContent = 'Alta Masividad (Exigente)';
                    }
                }

                renderItemEspesor('F30', esp.f30);
                renderItemEspesor('F60', esp.f60);
                renderItemEspesor('F90', esp.f90);
                renderItemEspesor('F120', esp.f120);

                const elResumen = document.getElementById('resTextoResumen');
                if (elResumen) {
                    const dimText = estadoSimulador.geometria === 'Circular'
                        ? `Ø ${vals.D} × ${vals.e1} mm`
                        : `${vals.H} × ${vals.B1} × ${vals.e1} mm`;

                    elResumen.innerHTML = `Perfil <strong>${estadoSimulador.geometria}</strong> (${dimText}) · Exposición: <strong>${estadoSimulador.exposicion === '3C' ? '3 Caras' : '4 Caras'}</strong> · Masividad: <strong>${res.masividad} m⁻¹</strong>.<br>` +
                        `Espesor certificado F60: <strong>${esp.f60.viable ? esp.f60.micras.toLocaleString('es-CL') + ' µm (' + esp.f60.mils + ' mils)' : 'Fuera de Rango'}</strong>.`;
                }
            }

            function renderItemEspesor(resistencia, data) {
                const elMicras = document.getElementById('res' + resistencia + 'Micras');
                const elMils = document.getElementById('res' + resistencia + 'Mils');
                const elBadge = document.getElementById('badge' + resistencia);

                if (elMicras) {
                    elMicras.textContent = data.viable ? data.micras.toLocaleString('es-CL') + ' µm' : 'Fuera Rango';
                    elMicras.className = data.viable ? 'fw-bolder text-dark mb-0' : 'fw-bold text-danger mb-0 fs-6';
                }
                if (elMils) {
                    elMils.textContent = data.viable ? data.mils + ' mils' : 'No Ensayado';
                }
                if (elBadge) {
                    elBadge.className = data.viable ? 'badge bg-success-subtle text-success mt-1' : 'badge bg-danger-subtle text-danger mt-1';
                    elBadge.textContent = data.viable ? 'Certificado' : 'Límite Superado';
                }
            }

            function aplicarPreset(p) {
                if (!p) return;
                if (p.H !== undefined && document.getElementById('inp_H')) document.getElementById('inp_H').value = p.H;
                if (p.B1 !== undefined && document.getElementById('inp_B1')) document.getElementById('inp_B1').value = p.B1;
                if (p.B2 !== undefined && document.getElementById('inp_B2')) document.getElementById('inp_B2').value = p.B2;
                if (p.e1 !== undefined && document.getElementById('inp_e1')) document.getElementById('inp_e1').value = p.e1;
                if (p.e2 !== undefined && document.getElementById('inp_e2')) document.getElementById('inp_e2').value = p.e2;
                if (p.t !== undefined && document.getElementById('inp_t')) document.getElementById('inp_t').value = p.t;
                if (p.r !== undefined && document.getElementById('inp_r')) document.getElementById('inp_r').value = p.r;
                if (p.C !== undefined && document.getElementById('inp_C')) document.getElementById('inp_C').value = p.C;
                if (p.D !== undefined && document.getElementById('inp_D')) document.getElementById('inp_D').value = p.D;
            }

            // Exponer para interacción global
            window.abrirSimuladorConPerfil = function (geom) {
                estadoSimulador.geometria = geom;
                const botonesGeom = document.querySelectorAll('.calc-geom-btn');
                botonesGeom.forEach(b => {
                    b.classList.remove('active', 'btn-dark', 'text-white');
                    b.classList.add('btn-outline-dark');
                    if (b.getAttribute('data-geom') === geom) {
                        b.classList.add('active', 'btn-dark', 'text-white');
                        b.classList.remove('btn-outline-dark');
                    }
                });

                const lblGeom = document.getElementById('lblTipoPerfilNombre');
                if (lblGeom) lblGeom.textContent = NOMBRES_GEOM[geom] || geom;

                actualizarVisibilidadInputs();
                const primerPreset = (PRESETS[geom] || [])[0];
                if (primerPreset) aplicarPreset(primerPreset);
                recalcularSimulador();

                const modal = new bootstrap.Modal(document.getElementById('modalCalculadoraMasividad'));
                modal.show();
            };

            window.cambiarExposicionGaleria = function (exp) {
                const btn4C = document.getElementById('btnToggle4C');
                const btn3C = document.getElementById('btnToggle3C');

                if (exp === '3_caras') {
                    btn3C.classList.add('active');
                    btn4C.classList.remove('active');
                } else {
                    btn4C.classList.add('active');
                    btn3C.classList.remove('active');
                }

                const imgs = document.querySelectorAll('.img-corte');
                imgs.forEach(img => {
                    const forma = img.getAttribute('data-forma');
                    if (forma) {
                        img.src = `./assets/img/Cortes/${exp}/${forma}.png`;
                        img.onerror = function() {
                            this.src = `/assets/img/Cortes/${exp}/${forma}.png`;
                        };
                    }
                });
            };

            // Inicializar Listeners
            document.addEventListener('DOMContentLoaded', function () {
                const botonesGeom = document.querySelectorAll('.calc-geom-btn');
                botonesGeom.forEach(btn => {
                    btn.addEventListener('click', function () {
                        botonesGeom.forEach(b => {
                            b.classList.remove('active', 'btn-dark', 'text-white');
                            b.classList.add('btn-outline-dark');
                        });
                        this.classList.add('active', 'btn-dark', 'text-white');
                        this.classList.remove('btn-outline-dark');
                        estadoSimulador.geometria = this.getAttribute('data-geom');

                        const lblGeom = document.getElementById('lblTipoPerfilNombre');
                        if (lblGeom) lblGeom.textContent = NOMBRES_GEOM[estadoSimulador.geometria] || estadoSimulador.geometria;

                        actualizarVisibilidadInputs();
                        const primerPreset = (PRESETS[estadoSimulador.geometria] || [])[0];
                        if (primerPreset) aplicarPreset(primerPreset);
                        recalcularSimulador();
                    });
                });

                const radiosExp = document.querySelectorAll('input[name="calcExposicion"]');
                radiosExp.forEach(r => {
                    r.addEventListener('change', function () {
                        estadoSimulador.exposicion = this.value;
                        const desc = document.getElementById('lblExposicionDesc');
                        if (desc) {
                            desc.textContent = this.value === '3C'
                                ? 'Viga bajo losa de hormigón (Ala superior protegida).'
                                : 'Columna o viga aislada con calentamiento simultáneo por 4 lados.';
                        }
                        recalcularSimulador();
                    });
                });

                const inputs = document.querySelectorAll('#contenedorInputs input');
                inputs.forEach(inp => {
                    inp.addEventListener('input', recalcularSimulador);
                    inp.addEventListener('change', recalcularSimulador);
                });

                const selPreset = document.getElementById('selectPresetsChilenos');
                if (selPreset) {
                    selPreset.addEventListener('change', function () {
                        const idx = parseInt(this.value, 10);
                        const lista = PRESETS[estadoSimulador.geometria] || [];
                        if (!isNaN(idx) && lista[idx]) {
                            aplicarPreset(lista[idx]);
                            recalcularSimulador();
                        }
                    });
                }

                const btnCopiar = document.getElementById('btnCopiarCalculo');
                if (btnCopiar) {
                    btnCopiar.addEventListener('click', function () {
                        const m = document.getElementById('resMasividad') ? document.getElementById('resMasividad').innerText : '';
                        const p = document.getElementById('resPerimetro') ? document.getElementById('resPerimetro').innerText : '';
                        const a = document.getElementById('resArea') ? document.getElementById('resArea').innerText : '';
                        const f60 = document.getElementById('resF60Micras') ? document.getElementById('resF60Micras').innerText : '';

                        const clipText = `[ESPECIFICACIÓN TÉCNICA PINTURA INTUMESCENTE - NCh3040]\n` +
                            `Geometría: ${NOMBRES_GEOM[estadoSimulador.geometria]}\n` +
                            `Exposición: ${estadoSimulador.exposicion === '3C' ? 'Viga 3 Caras (V3C)' : 'Pilar/Viga 4 Caras (4C)'}\n` +
                            `Área: ${a} | Perímetro: ${p}\n` +
                            `Masividad (P/A): ${m} m⁻¹\n` +
                            `Espesor Mínimo Estimado F60: ${f60}\n` +
                            `Generado en Especificador de Pintura Intumescente (https://pinturaintumescente.cl)`;

                        navigator.clipboard.writeText(clipText).then(() => {
                            const originalText = btnCopiar.innerHTML;
                            btnCopiar.innerHTML = '<i class="bi bi-check2-all text-success me-1"></i> ¡Copiado!';
                            setTimeout(() => {
                                btnCopiar.innerHTML = originalText;
                            }, 2000);
                        });
                    });
                }

                actualizarVisibilidadInputs();
                const primerPreset = (PRESETS['HSR'] || [])[0];
                if (primerPreset) aplicarPreset(primerPreset);
                recalcularSimulador();
            });
        })();
    </script>
</body>

</html>