<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTP Realty | Constructora y Bienes Raíces en Guadalajara</title>
    <meta name="description"
        content="CTP Realty - Constructora y bienes raíces en Guadalajara, Jalisco. Encuentra tu hogar ideal con los mejores desarrollos inmobiliarios.">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        :root {
            --ctp-blue: #0a2596;
            --ctp-blue-dark: #051a6e;
            --ctp-blue-light: #1e3bc7;
            --ctp-gold: #f1d229;
            --ctp-gold-light: #f5e066;
            --ctp-gold-dark: #c9a91f;
            --white: #ffffff;
            --gray-100: #f8f9fa;
            --gray-200: #e9ecef;
            --gray-300: #dee2e6;
            --gray-600: #6c757d;
            --gray-800: #343a40;
            --gray-900: #212529;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            line-height: 1.6;
            color: var(--gray-800);
            overflow-x: hidden;
        }

        /* Header */
        .header {
            background: var(--white);
            box-shadow: 0 2px 20px rgba(10, 37, 150, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .header.scrolled {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
        }

        .header-inner {
            max-width: 1400px;
            margin: 0 auto;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo img {
            height: 60px;
            width: auto;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 35px;
            align-items: center;
        }

        .nav-menu a {
            text-decoration: none;
            color: var(--gray-800);
            font-weight: 500;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-menu a:hover {
            color: var(--ctp-blue);
        }

        .nav-menu a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--ctp-gold);
            transition: width 0.3s ease;
        }

        .nav-menu a:hover::after {
            width: 100%;
        }

        /* Language Selector */
        .lang-selector {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-left: 20px;
            padding-left: 20px;
            border-left: 1px solid var(--gray-300);
        }

        .lang-btn {
            background: none;
            border: 2px solid transparent;
            padding: 5px 12px;
            cursor: pointer;
            font-weight: 600;
            font-size: 12px;
            color: var(--gray-600);
            transition: all 0.3s ease;
            border-radius: 20px;
        }

        .lang-btn:hover {
            color: var(--ctp-blue);
        }

        .lang-btn.active {
            background: var(--ctp-blue);
            color: var(--white);
            border-color: var(--ctp-blue);
        }

        /* Hero Section */
        .hero {
            margin-top: 90px;
            background: linear-gradient(135deg, var(--ctp-blue) 0%, var(--ctp-blue-dark) 100%);
            min-height: 90vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><rect fill="%23f1d229" fill-opacity="0.05" x="0" y="0" width="100" height="100"/></svg>');
            opacity: 0.3;
        }

        .hero-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 60px 30px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .hero-text h1 {
            font-size: 56px;
            font-weight: 800;
            color: var(--white);
            line-height: 1.1;
            margin-bottom: 20px;
        }

        .hero-text h1 span {
            color: var(--ctp-gold);
        }

        .hero-text p {
            font-size: 18px;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 30px;
            line-height: 1.8;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 15px 35px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-primary {
            background: var(--ctp-gold);
            color: var(--ctp-blue-dark);
        }

        .btn-primary:hover {
            background: var(--ctp-gold-light);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(241, 210, 41, 0.3);
        }

        .btn-outline {
            background: transparent;
            color: var(--white);
            border: 2px solid var(--white);
        }

        .btn-outline:hover {
            background: var(--white);
            color: var(--ctp-blue);
        }

        .hero-image {
            position: relative;
        }

        .hero-image img {
            width: 100%;
            border-radius: 20px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
        }

        .floating-card {
            position: absolute;
            background: var(--white);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .floating-card.card-1 {
            bottom: -20px;
            left: -30px;
            animation: float 3s ease-in-out infinite;
        }

        .floating-card.card-2 {
            top: 20px;
            right: -20px;
            animation: float 3s ease-in-out infinite 0.5s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .stat-number {
            font-size: 32px;
            font-weight: 800;
            color: var(--ctp-blue);
        }

        .stat-label {
            font-size: 12px;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Search Box */
        .search-box {
            background: var(--white);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(10, 37, 150, 0.15);
            margin-top: -80px;
            position: relative;
            z-index: 10;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .search-tabs {
            display: flex;
            gap: 30px;
            margin-bottom: 25px;
            border-bottom: 2px solid var(--gray-200);
        }

        .search-tab {
            padding: 15px 0;
            background: none;
            border: none;
            font-weight: 600;
            color: var(--gray-600);
            cursor: pointer;
            position: relative;
            font-size: 14px;
            text-transform: uppercase;
        }

        .search-tab.active {
            color: var(--ctp-blue);
        }

        .search-tab.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--ctp-gold);
        }

        .search-form {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto;
            gap: 20px;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            padding: 15px 20px;
            border: 2px solid var(--gray-200);
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
            font-family: 'Montserrat', sans-serif;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--ctp-blue);
        }

        /* Features Section */
        .section {
            padding: 100px 30px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-subtitle {
            color: var(--ctp-gold);
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 15px;
        }

        .section-title {
            font-size: 42px;
            font-weight: 800;
            color: var(--ctp-blue);
            margin-bottom: 20px;
        }

        .section-description {
            color: var(--gray-600);
            font-size: 16px;
            max-width: 600px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background: var(--white);
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            border-color: var(--ctp-gold);
            box-shadow: 0 20px 40px rgba(10, 37, 150, 0.1);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--ctp-blue) 0%, var(--ctp-blue-light) 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 36px;
            color: var(--ctp-gold);
        }

        .feature-card h3 {
            font-size: 20px;
            font-weight: 700;
            color: var(--ctp-blue);
            margin-bottom: 15px;
        }

        .feature-card p {
            color: var(--gray-600);
            font-size: 14px;
            line-height: 1.8;
        }

        /* Properties Section */
        .properties-section {
            background: var(--gray-100);
        }

        .properties-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }

        .property-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .property-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(10, 37, 150, 0.15);
        }

        .property-image {
            height: 250px;
            background: linear-gradient(135deg, var(--gray-300) 0%, var(--gray-200) 100%);
            position: relative;
            overflow: hidden;
        }

        .property-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: var(--ctp-gold);
            color: var(--ctp-blue-dark);
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .property-content {
            padding: 30px;
        }

        .property-price {
            font-size: 24px;
            font-weight: 800;
            color: var(--ctp-blue);
            margin-bottom: 10px;
        }

        .property-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--gray-800);
            margin-bottom: 10px;
        }

        .property-location {
            color: var(--gray-600);
            font-size: 14px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .property-features {
            display: flex;
            gap: 20px;
            padding-top: 20px;
            border-top: 1px solid var(--gray-200);
        }

        .property-feature {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--gray-600);
        }

        /* Contact Section */
        .contact-section {
            background: linear-gradient(135deg, var(--ctp-blue) 0%, var(--ctp-blue-dark) 100%);
            color: var(--white);
        }

        .contact-section .section-subtitle {
            color: var(--ctp-gold);
        }

        .contact-section .section-title {
            color: var(--white);
        }

        .contact-section .section-description {
            color: rgba(255, 255, 255, 0.8);
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-top: 50px;
        }

        .contact-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .contact-card:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-5px);
        }

        .contact-icon {
            width: 70px;
            height: 70px;
            background: var(--ctp-gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 28px;
            color: var(--ctp-blue);
        }

        .contact-card h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .contact-card p {
            font-size: 14px;
            opacity: 0.9;
            line-height: 1.8;
        }

        .contact-card a {
            color: var(--ctp-gold);
            text-decoration: none;
            font-weight: 600;
        }

        /* Footer */
        .footer {
            background: var(--gray-900);
            color: var(--white);
            padding: 80px 30px 30px;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 60px;
            margin-bottom: 60px;
        }

        .footer-brand img {
            height: 70px;
            margin-bottom: 20px;
        }

        .footer-brand p {
            color: var(--gray-600);
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .footer-social {
            display: flex;
            gap: 15px;
        }

        .social-link {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: var(--ctp-gold);
            color: var(--ctp-blue);
        }

        .footer-column h4 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 25px;
            color: var(--white);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: var(--gray-600);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--ctp-gold);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 30px;
            text-align: center;
            color: var(--gray-600);
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .hero-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .hero-text h1 {
                font-size: 42px;
            }

            .hero-buttons {
                justify-content: center;
            }

            .search-form {
                grid-template-columns: 1fr;
            }

            .footer-content {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }

            .hero-text h1 {
                font-size: 32px;
            }

            .section-title {
                font-size: 28px;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .floating-card {
                display: none;
            }
        }

        /* Utility Classes */
        .text-center {
            text-align: center;
        }

        .mt-20 {
            margin-top: 20px;
        }

        .mb-20 {
            margin-bottom: 20px;
        }

        .swiper {
            width: 100%;
            padding: 20px 0 50px 0;
        }

        .property-card {
            height: 100%;
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header" id="header">
        <div class="header-inner">
            <a href="#" class="logo">
                <img src="Logo.png" alt="CTP Realty Logo">
            </a>

            <nav>
                <ul class="nav-menu">
                    <li><a href="#inicio" data-i18n="nav.home">Inicio</a></li>
                    <li><a href="#propiedades" data-i18n="nav.properties">Propiedades</a></li>
                    <li><a href="#servicios" data-i18n="nav.services">Servicios</a></li>
                    <li><a href="#nosotros" data-i18n="nav.about">Nosotros</a></li>
                    <li><a href="#contacto" data-i18n="nav.contact">Contacto</a></li>

                    <li class="lang-selector">
                        <button class="lang-btn active" onclick="changeLanguage('es')">ES</button>
                        <button class="lang-btn" onclick="changeLanguage('en')">EN</button>
                        <button class="lang-btn" onclick="changeLanguage('fr')">FR</button>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="inicio">
        <div class="hero-content">
            <div class="hero-text">
                <h1 data-i18n="hero.title">Encuentra tu <span>Hogar Ideal</span> con CTP Realty</h1>
                <p data-i18n="hero.subtitle">Somos una constructora y empresa de bienes raíces comprometida con hacer
                    realidad tus sueños. Más de 15 años de experiencia en Guadalajara construyendo el futuro.</p>
                <div class="hero-buttons">
                    <a href="#propiedades" class="btn btn-primary" data-i18n="hero.cta1">Ver Propiedades</a>
                    <a href="#contacto" class="btn btn-outline" data-i18n="hero.cta2">Contáctanos</a>
                </div>
            </div>
            <div class="hero-image">
                <div style="background: @if($hero_path) url('{{ $hero_path }}') @else linear-gradient(135deg, #f1d229 0%, #e5c520 100%) @endif; 
                background-size: cover; 
                background-position: center; 
                height: 500px; 
                border-radius: 20px; 
                display: flex; 
                align-items: center; 
                justify-content: center; 
                font-size: 120px; 
                color: #0a2596;
                position: relative;
                overflow: hidden;">

                    @if(!$hero_path)
                        🏗️
                    @endif

                    @if($hero_path)
                        <div
                            style="position: absolute; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.2);">
                        </div>
                    @endif
                </div>

                <div class="floating-card card-1">
                    <div class="stat-number">500+</div>
                    <div class="stat-label" data-i18n="stats.properties">Propiedades</div>
                </div>
                <div class="floating-card card-2">
                    <div class="stat-number">15+</div>
                    <div class="stat-label" data-i18n="stats.years">Años de Experiencia</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Box -->
    <div class="search-box">
        <div class="search-tabs">
            <button class="search-tab active" data-i18n="search.buy">Comprar</button>
            <button class="search-tab" data-i18n="search.rent">Rentar</button>
            <button class="search-tab" data-i18n="search.developments">Desarrollos</button>
        </div>
        <form class="search-form">
            <div class="form-group">
                <label data-i18n="search.location">Ubicación</label>
                <input type="text" class="form-control" placeholder="¿Dónde quieres vivir?"
                    data-i18n-placeholder="search.locationPlaceholder">
            </div>
            <div class="form-group">
                <label data-i18n="search.type">Tipo de Propiedad</label>
                <select class="form-control">
                    <option data-i18n="search.allTypes">Todos los tipos</option>
                    <option data-i18n="search.house">Casa</option>
                    <option data-i18n="search.apartment">Departamento</option>
                    <option data-i18n="search.land">Terreno</option>
                    <option data-i18n="search.commercial">Comercial</option>
                </select>
            </div>
            <div class="form-group">
                <label data-i18n="search.price">Precio</label>
                <select class="form-control">
                    <option data-i18n="search.anyPrice">Cualquier precio</option>
                    <option>$500,000 - $1,000,000 MXN</option>
                    <option>$1,000,000 - $2,000,000 MXN</option>
                    <option>$2,000,000 - $5,000,000 MXN</option>
                    <option data-i18n="search.plus5m">+ $5,000,000 MXN</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" data-i18n="search.button">Buscar</button>
        </form>
    </div>

    <!-- Features Section -->
    <section class="section" id="servicios">
        <div class="section-header">
            <p class="section-subtitle" data-i18n="features.subtitle">Nuestros Servicios</p>
            <h2 class="section-title" data-i18n="features.title">¿Por qué elegir CTP Realty?</h2>
            <p class="section-description" data-i18n="features.description">Ofrecemos un servicio integral de bienes
                raíces con los más altos estándares de calidad y profesionalismo en Guadalajara.</p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">🏠</div>
                <h3 data-i18n="features.propiedades.title">Propiedades Exclusivas</h3>
                <p data-i18n="features.propiedades.desc">Acceso a las mejores propiedades en las zonas más privilegiadas
                    de Guadalajara y el Área Metropolitana.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">🏗️</div>
                <h3 data-i18n="features.construccion.title">Construcción</h3>
                <p data-i18n="features.construccion.desc">Desarrollamos proyectos residenciales y comerciales con los
                    más altos estándares de calidad.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">📋</div>
                <h3 data-i18n="features.gestion.title">Gestión Integral</h3>
                <p data-i18n="features.gestion.desc">Te acompañamos en todo el proceso: desde la búsqueda hasta la
                    escrituración de tu propiedad.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">💰</div>
                <h3 data-i18n="features.financiamiento.title">Financiamiento</h3>
                <p data-i18n="features.financiamiento.desc">Asesoría personalizada para obtener el mejor crédito
                    hipotecario según tus necesidades.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">🔧</div>
                <h3 data-i18n="features.mantenimiento.title">Mantenimiento</h3>
                <p data-i18n="features.mantenimiento.desc">Servicios de mantenimiento y remodelación para mantener tu
                    propiedad en óptimas condiciones.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">🌟</div>
                <h3 data-i18n="features.garantia.title">Garantía de Calidad</h3>
                <p data-i18n="features.garantia.desc">Todas nuestras propiedades cuentan con garantía y certificados de
                    calidad.</p>
            </div>
        </div>
    </section>

    <!-- Properties Section -->
    <section class="section properties-section" id="propiedades">
        <div class="section-header">
            <p class="section-subtitle" data-i18n="properties.subtitle">Propiedades Destacadas</p>
            <h2 class="section-title" data-i18n="properties.title">Encuentra tu lugar perfecto</h2>
            <p class="section-description" data-i18n="properties.description">Explora nuestra selección de propiedades
                exclusivas en las mejores zonas de Guadalajara.</p>
        </div>

       <div class="properties-container">
    @if($featured_properties->count() > 3)
        {{-- Swiper --}}
        <div class="swiper featuredSwiper">
            <div class="swiper-wrapper">
                @foreach($featured_properties as $prop)
                    <div class="swiper-slide">
                        {{-- Enlace que envuelve toda la tarjeta --}}
                        <a href="/propiedad/{{ $prop->slug }}" class="property-link">
                            <div class="property-card">
                                <div class="property-image"
                                    style="background: @if($prop->thumbnail) url('{{ $prop->thumbnail_url }}') @else linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%) @endif; background-size: cover; background-position: center;">
                                    
                                    @if(!$prop->thumbnail)
                                        <div style="width:100%; height:100%; display: flex; align-items: center; justify-content: center; font-size: 3rem; color: #bcccdc; opacity: 0.6;">
                                            🏠
                                        </div>
                                    @endif
                                    
                                    <span class="property-badge" data-i18n="badge.featured">Destacado</span>
                                </div>
                                
                                <div class="property-content">
                                    <div class="property-price">${{ number_format($prop->price, 0) }} MXN</div>
                                    <h3 class="property-title">{{ $prop->title }}</h3>
                                    <p class="property-location">📍 {{ $prop->city }}, {{ $prop->state }}</p>
                                    <div class="property-features">
                                        <span class="property-feature">🛏️ {{ $prop->bedrooms }} Recámaras</span>
                                        <span class="property-feature">🛁 {{ $prop->bathrooms }} Baños</span>
                                        <span class="property-feature">📐 {{ $prop->square_meters }} m²</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    @else
        {{-- Grid normal --}}
        <div class="properties-grid">
            @foreach($featured_properties as $prop)
                {{-- Enlace que envuelve toda la tarjeta --}}
                <a href="/propiedad/{{ $prop->slug }}" class="property-link">
                    <div class="property-card">
                        <div class="property-image"
                            style="background: @if($prop->thumbnail) url('{{ $prop->thumbnail_url }}') @else linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%) @endif; background-size: cover; background-position: center;">
                            
                            @if(!$prop->thumbnail)
                                <div style="width:100%; height:100%; display: flex; align-items: center; justify-content: center; font-size: 3rem; color: #bcccdc; opacity: 0.6;">
                                    🏠
                                </div>
                            @endif

                            <span class="property-badge" data-i18n="badge.featured">Destacado</span>
                        </div>
                        <div class="property-content">
                            <div class="property-price">${{ number_format($prop->price, 0) }} MXN</div>
                            <h3 class="property-title">{{ $prop->title }}</h3>
                            <p class="property-location">📍 {{ $prop->city }}, {{ $prop->state }}</p>
                            <div class="property-features">
                                <span class="property-feature">🛏️ {{ $prop->bedrooms }} Recámaras</span>
                                <span class="property-feature">🛁 {{ $prop->bathrooms }} Baños</span>
                                <span class="property-feature">📐 {{ $prop->square_meters }} m²</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
       </div>

        <div class="text-center mt-20">
            <a href="/propiedades" class="btn btn-primary" data-i18n="properties.viewAll">Ver todas las propiedades</a>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section contact-section" id="contacto">
        <div class="section-header">
            <p class="section-subtitle" data-i18n="contact.subtitle">Contacto</p>
            <h2 class="section-title" data-i18n="contact.title">Estamos aquí para ayudarte</h2>
            <p class="section-description" data-i18n="contact.description">Visítanos en nuestras oficinas o contáctanos.
                Nuestro equipo de expertos está listo para atenderte.</p>
        </div>

        <div class="contact-grid">
            <div class="contact-card">
                <div class="contact-icon">📍</div>
                <h3 data-i18n="contact.address.title">Dirección</h3>
                <p>Calle La Ley 2647<br>Guadalajara, Jalisco<br>México</p>
            </div>

            <div class="contact-card">
                <div class="contact-icon">📞</div>
                <h3 data-i18n="contact.phone.title">Teléfono</h3>
                <p><a href="tel:3336152664">333 615 2664</a><br><span data-i18n="contact.phone.hours">Lun - Vie: 9:00 -
                        18:00</span></p>
            </div>

            <div class="contact-card">
                <div class="contact-icon">✉️</div>
                <h3 data-i18n="contact.email.title">Email</h3>
                <p><a href="mailto:contacto@ctpconstructora.mx">contacto@ctpconstructora.mx</a><br><span
                        data-i18n="contact.email.response">Respuesta en 24h</span></p>
            </div>

            <div class="contact-card">
                <div class="contact-icon">💬</div>
                <h3 data-i18n="contact.whatsapp.title">WhatsApp</h3>
                <p><a href="https://wa.me/523336152664">333 615 2664</a><br><span
                        data-i18n="contact.whatsapp.message">Escríbenos ahora</span></p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-brand">
                <img src="Logo.png" alt="CTP Realty Logo">
                <p data-i18n="footer.description">CTP Realty es una empresa líder en bienes raíces y construcción en
                    Guadalajara, comprometida con la excelencia y satisfacción de nuestros clientes desde 2009.</p>
                <div class="footer-social">
                    <a href="#" class="social-link">f</a>
                    <a href="#" class="social-link">in</a>
                    <a href="#" class="social-link">ig</a>
                    <a href="#" class="social-link">yt</a>
                </div>
            </div>

            <div class="footer-column">
                <h4 data-i18n="footer.links.title">Enlaces Rápidos</h4>
                <ul class="footer-links">
                    <li><a href="#inicio" data-i18n="footer.links.home">Inicio</a></li>
                    <li><a href="#propiedades" data-i18n="footer.links.properties">Propiedades</a></li>
                    <li><a href="#servicios" data-i18n="footer.links.services">Servicios</a></li>
                    <li><a href="#nosotros" data-i18n="footer.links.about">Nosotros</a></li>
                    <li><a href="#contacto" data-i18n="footer.links.contact">Contacto</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h4 data-i18n="footer.services.title">Servicios</h4>
                <ul class="footer-links">
                    <li><a href="#" data-i18n="footer.services.sales">Venta de Propiedades</a></li>
                    <li><a href="#" data-i18n="footer.services.rentals">Rentas</a></li>
                    <li><a href="#" data-i18n="footer.services.construction">Construcción</a></li>
                    <li><a href="#" data-i18n="footer.services.management">Administración</a></li>
                    <li><a href="#" data-i18n="footer.services.consulting">Asesoría</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h4 data-i18n="footer.legal.title">Legal</h4>
                <ul class="footer-links">
                    <li><a href="#" data-i18n="footer.legal.privacy">Aviso de Privacidad</a></li>
                    <li><a href="#" data-i18n="footer.legal.terms">Términos y Condiciones</a></li>
                    <li><a href="#" data-i18n="footer.legal.cookies">Política de Cookies</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2024 CTP Realty. <span data-i18n="footer.rights">Todos los derechos reservados.</span></p>
        </div>
    </footer>

    <script>
        // Translations
        const translations = {
            es: {
                "nav.home": "Inicio",
                "nav.properties": "Propiedades",
                "nav.services": "Servicios",
                "nav.about": "Nosotros",
                "nav.contact": "Contacto",
                "hero.title": "Encuentra tu <span>Hogar Ideal</span> con CTP Realty",
                "hero.subtitle": "Somos una constructora y empresa de bienes raíces comprometida con hacer realidad tus sueños. Más de 15 años de experiencia en Guadalajara construyendo el futuro.",
                "hero.cta1": "Ver Propiedades",
                "hero.cta2": "Contáctanos",
                "stats.properties": "Propiedades",
                "stats.years": "Años de Experiencia",
                "search.buy": "Comprar",
                "search.rent": "Rentar",
                "search.developments": "Desarrollos",
                "search.location": "Ubicación",
                "search.locationPlaceholder": "¿Dónde quieres vivir?",
                "search.type": "Tipo de Propiedad",
                "search.allTypes": "Todos los tipos",
                "search.house": "Casa",
                "search.apartment": "Departamento",
                "search.land": "Terreno",
                "search.commercial": "Comercial",
                "search.price": "Precio",
                "search.anyPrice": "Cualquier precio",
                "search.plus5m": "+ $5,000,000 MXN",
                "search.button": "Buscar",
                "features.subtitle": "Nuestros Servicios",
                "features.title": "¿Por qué elegir CTP Realty?",
                "features.description": "Ofrecemos un servicio integral de bienes raíces con los más altos estándares de calidad y profesionalismo en Guadalajara.",
                "features.propiedades.title": "Propiedades Exclusivas",
                "features.propiedades.desc": "Acceso a las mejores propiedades en las zonas más privilegiadas de Guadalajara y el Área Metropolitana.",
                "features.construccion.title": "Construcción",
                "features.construccion.desc": "Desarrollamos proyectos residenciales y comerciales con los más altos estándares de calidad.",
                "features.gestion.title": "Gestión Integral",
                "features.gestion.desc": "Te acompañamos en todo el proceso: desde la búsqueda hasta la escrituración de tu propiedad.",
                "features.financiamiento.title": "Financiamiento",
                "features.financiamiento.desc": "Asesoría personalizada para obtener el mejor crédito hipotecario según tus necesidades.",
                "features.mantenimiento.title": "Mantenimiento",
                "features.mantenimiento.desc": "Servicios de mantenimiento y remodelación para mantener tu propiedad en óptimas condiciones.",
                "features.garantia.title": "Garantía de Calidad",
                "features.garantia.desc": "Todas nuestras propiedades cuentan con garantía y certificados de calidad.",
                "properties.subtitle": "Propiedades Destacadas",
                "properties.title": "Encuentra tu lugar perfecto",
                "properties.description": "Explora nuestra selección de propiedades exclusivas en las mejores zonas de Guadalajara.",
                "badge.featured": "Destacado",
                "badge.new": "Nuevo",
                "badge.sale": "Venta",
                "property1.title": "Residencia Moderna en Providencia",
                "property2.title": "Departamento de Lujo en Chapultepec",
                "property3.title": "Casa en Coto Privado Valle Real",
                "properties.viewAll": "Ver todas las propiedades",
                "contact.subtitle": "Contacto",
                "contact.title": "Estamos aquí para ayudarte",
                "contact.description": "Visítanos en nuestras oficinas o contáctanos. Nuestro equipo de expertos está listo para atenderte.",
                "contact.address.title": "Dirección",
                "contact.phone.title": "Teléfono",
                "contact.phone.hours": "Lun - Vie: 9:00 - 18:00",
                "contact.email.title": "Email",
                "contact.email.response": "Respuesta en 24h",
                "contact.whatsapp.title": "WhatsApp",
                "contact.whatsapp.message": "Escríbenos ahora",
                "footer.description": "CTP Realty es una empresa líder en bienes raíces y construcción en Guadalajara, comprometida con la excelencia y satisfacción de nuestros clientes desde 2009.",
                "footer.links.title": "Enlaces Rápidos",
                "footer.links.home": "Inicio",
                "footer.links.properties": "Propiedades",
                "footer.links.services": "Servicios",
                "footer.links.about": "Nosotros",
                "footer.links.contact": "Contacto",
                "footer.services.title": "Servicios",
                "footer.services.sales": "Venta de Propiedades",
                "footer.services.rentals": "Rentas",
                "footer.services.construction": "Construcción",
                "footer.services.management": "Administración",
                "footer.services.consulting": "Asesoría",
                "footer.legal.title": "Legal",
                "footer.legal.privacy": "Aviso de Privacidad",
                "footer.legal.terms": "Términos y Condiciones",
                "footer.legal.cookies": "Política de Cookies",
                "footer.rights": "Todos los derechos reservados."
            },
            en: {
                "nav.home": "Home",
                "nav.properties": "Properties",
                "nav.services": "Services",
                "nav.about": "About",
                "nav.contact": "Contact",
                "hero.title": "Find your <span>Dream Home</span> with CTP Realty",
                "hero.subtitle": "We are a construction and real estate company committed to making your dreams come true. Over 15 years of experience in Guadalajara building the future.",
                "hero.cta1": "View Properties",
                "hero.cta2": "Contact Us",
                "stats.properties": "Properties",
                "stats.years": "Years of Experience",
                "search.buy": "Buy",
                "search.rent": "Rent",
                "search.developments": "Developments",
                "search.location": "Location",
                "search.locationPlaceholder": "Where do you want to live?",
                "search.type": "Property Type",
                "search.allTypes": "All types",
                "search.house": "House",
                "search.apartment": "Apartment",
                "search.land": "Land",
                "search.commercial": "Commercial",
                "search.price": "Price",
                "search.anyPrice": "Any price",
                "search.plus5m": "+ $5,000,000 MXN",
                "search.button": "Search",
                "features.subtitle": "Our Services",
                "features.title": "Why choose CTP Realty?",
                "features.description": "We offer comprehensive real estate services with the highest standards of quality and professionalism in Guadalajara.",
                "features.propiedades.title": "Exclusive Properties",
                "features.propiedades.desc": "Access to the best properties in the most privileged areas of Guadalajara and the Metropolitan Area.",
                "features.construccion.title": "Construction",
                "features.construccion.desc": "We develop residential and commercial projects with the highest quality standards.",
                "features.gestion.title": "Comprehensive Management",
                "features.gestion.desc": "We accompany you throughout the process: from search to property registration.",
                "features.financiamiento.title": "Financing",
                "features.financiamiento.desc": "Personalized advice to get the best mortgage according to your needs.",
                "features.mantenimiento.title": "Maintenance",
                "features.mantenimiento.desc": "Maintenance and remodeling services to keep your property in optimal conditions.",
                "features.garantia.title": "Quality Guarantee",
                "features.garantia.desc": "All our properties come with warranty and quality certificates.",
                "properties.subtitle": "Featured Properties",
                "properties.title": "Find your perfect place",
                "properties.description": "Explore our selection of exclusive properties in the best areas of Guadalajara.",
                "badge.featured": "Featured",
                "badge.new": "New",
                "badge.sale": "For Sale",
                "property1.title": "Modern Residence in Providencia",
                "property2.title": "Luxury Apartment in Chapultepec",
                "property3.title": "House in Private Valle Real",
                "properties.viewAll": "View all properties",
                "contact.subtitle": "Contact",
                "contact.title": "We are here to help you",
                "contact.description": "Visit our offices or contact us. Our team of experts is ready to assist you.",
                "contact.address.title": "Address",
                "contact.phone.title": "Phone",
                "contact.phone.hours": "Mon - Fri: 9:00 - 18:00",
                "contact.email.title": "Email",
                "contact.email.response": "Response in 24h",
                "contact.whatsapp.title": "WhatsApp",
                "contact.whatsapp.message": "Message us now",
                "footer.description": "CTP Realty is a leading real estate and construction company in Guadalajara, committed to excellence and customer satisfaction since 2009.",
                "footer.links.title": "Quick Links",
                "footer.links.home": "Home",
                "footer.links.properties": "Properties",
                "footer.links.services": "Services",
                "footer.links.about": "About",
                "footer.links.contact": "Contact",
                "footer.services.title": "Services",
                "footer.services.sales": "Property Sales",
                "footer.services.rentals": "Rentals",
                "footer.services.construction": "Construction",
                "footer.services.management": "Management",
                "footer.services.consulting": "Consulting",
                "footer.legal.title": "Legal",
                "footer.legal.privacy": "Privacy Notice",
                "footer.legal.terms": "Terms and Conditions",
                "footer.legal.cookies": "Cookie Policy",
                "footer.rights": "All rights reserved."
            },
            fr: {
                "nav.home": "Accueil",
                "nav.properties": "Propriétés",
                "nav.services": "Services",
                "nav.about": "À propos",
                "nav.contact": "Contact",
                "hero.title": "Trouvez votre <span>Chez-vous Idéal</span> avec CTP Realty",
                "hero.subtitle": "Nous sommes une entreprise de construction et immobilière engagée à réaliser vos rêves. Plus de 15 ans d'expérience à Guadalajara en construisant l'avenir.",
                "hero.cta1": "Voir les Propriétés",
                "hero.cta2": "Contactez-nous",
                "stats.properties": "Propriétés",
                "stats.years": "Années d'Expérience",
                "search.buy": "Acheter",
                "search.rent": "Louer",
                "search.developments": "Développements",
                "search.location": "Emplacement",
                "search.locationPlaceholder": "Où voulez-vous vivre?",
                "search.type": "Type de Propriété",
                "search.allTypes": "Tous les types",
                "search.house": "Maison",
                "search.apartment": "Appartement",
                "search.land": "Terrain",
                "search.commercial": "Commercial",
                "search.price": "Prix",
                "search.anyPrice": "Tout prix",
                "search.plus5m": "+ $5,000,000 MXN",
                "search.button": "Rechercher",
                "features.subtitle": "Nos Services",
                "features.title": "Pourquoi choisir CTP Realty?",
                "features.description": "Nous offrons des services immobiliers complets avec les plus hauts standards de qualité et de professionnalisme à Guadalajara.",
                "features.propiedades.title": "Propriétés Exclusives",
                "features.propiedades.desc": "Accès aux meilleures propriétés dans les zones les plus privilégiées de Guadalajara et de la Zone Métropolitaine.",
                "features.construccion.title": "Construction",
                "features.construccion.desc": "Nous développons des projets résidentiels et commerciaux avec les plus hauts standards de qualité.",
                "features.gestion.title": "Gestion Intégrale",
                "features.gestion.desc": "Nous vous accompagnons tout au long du processus: de la recherche à l'enregistrement de la propriété.",
                "features.financiamiento.title": "Financement",
                "features.financiamiento.desc": "Conseils personnalisés pour obtenir le meilleur prêt hypothécaire selon vos besoins.",
                "features.mantenimiento.title": "Entretien",
                "features.mantenimiento.desc": "Services d'entretien et de rénovation pour garder votre propriété en conditions optimales.",
                "features.garantia.title": "Garantie de Qualité",
                "features.garantia.desc": "Toutes nos propriétés sont accompagnées d'une garantie et de certificats de qualité.",
                "properties.subtitle": "Propriétés en Vedette",
                "properties.title": "Trouvez votre endroit parfait",
                "properties.description": "Explorez notre sélection de propriétés exclusives dans les meilleures zones de Guadalajara.",
                "badge.featured": "En Vedette",
                "badge.new": "Nouveau",
                "badge.sale": "À Vendre",
                "property1.title": "Résidence Moderne à Providencia",
                "property2.title": "Appartement de Luxe à Chapultepec",
                "property3.title": "Maison en Coto Privé Valle Real",
                "properties.viewAll": "Voir toutes les propriétés",
                "contact.subtitle": "Contact",
                "contact.title": "Nous sommes là pour vous aider",
                "contact.description": "Visitez nos bureaux ou contactez-nous. Notre équipe d'experts est prête à vous aider.",
                "contact.address.title": "Adresse",
                "contact.phone.title": "Téléphone",
                "contact.phone.hours": "Lun - Ven: 9:00 - 18:00",
                "contact.email.title": "Email",
                "contact.email.response": "Réponse en 24h",
                "contact.whatsapp.title": "WhatsApp",
                "contact.whatsapp.message": "Écrivez-nous maintenant",
                "footer.description": "CTP Realty est une entreprise leader en immobilier et construction à Guadalajara, engagée envers l'excellence et la satisfaction client depuis 2009.",
                "footer.links.title": "Liens Rapides",
                "footer.links.home": "Accueil",
                "footer.links.properties": "Propriétés",
                "footer.links.services": "Services",
                "footer.links.about": "À propos",
                "footer.links.contact": "Contact",
                "footer.services.title": "Services",
                "footer.services.sales": "Vente de Propriétés",
                "footer.services.rentals": "Locations",
                "footer.services.construction": "Construction",
                "footer.services.management": "Gestion",
                "footer.services.consulting": "Conseil",
                "footer.legal.title": "Légal",
                "footer.legal.privacy": "Avis de Confidentialité",
                "footer.legal.terms": "Conditions Générales",
                "footer.legal.cookies": "Politique des Cookies",
                "footer.rights": "Tous droits réservés."
            }
        };

        let currentLang = 'es';

        function changeLanguage(lang) {
            currentLang = lang;

            // Update buttons
            document.querySelectorAll('.lang-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            // Update all elements with data-i18n
            document.querySelectorAll('[data-i18n]').forEach(element => {
                const key = element.getAttribute('data-i18n');
                if (translations[lang][key]) {
                    if (element.innerHTML.includes('<')) {
                        // If element has HTML, preserve it
                        const text = translations[lang][key];
                        element.innerHTML = text;
                    } else {
                        element.textContent = translations[lang][key];
                    }
                }
            });

            // Update placeholders
            document.querySelectorAll('[data-i18n-placeholder]').forEach(element => {
                const key = element.getAttribute('data-i18n-placeholder');
                if (translations[lang][key]) {
                    element.placeholder = translations[lang][key];
                }
            });

            // Update HTML lang attribute
            document.documentElement.lang = lang;
        }

        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.getElementById('header');
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.featuredSwiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            pagination: { el: '.swiper-pagination', clickable: true },
            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
            // Aquí está la magia: configuramos los cortes de pantalla
            breakpoints: {
                768: { slidesPerView: 2 }, // Tablets: 2 cards
                1024: { slidesPerView: 3 } // Desktop: 3 cards
            }
        });
    </script>
</body>

</html>