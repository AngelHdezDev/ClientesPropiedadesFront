@extends('layouts.app')

@section('title', '{{ $property->title}} | CTP Realty')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        /* ===== VARIABLES ORIGINALES CTP ===== */
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
            --gray-400: #ced4da;
            --gray-500: #adb5bd;
            --gray-600: #6c757d;
            --gray-700: #495057;
            --gray-800: #343a40;
            --gray-900: #212529;
            --shadow-sm: 0 2px 8px rgba(10, 37, 150, 0.08);
            --shadow-md: 0 8px 30px rgba(10, 37, 150, 0.12);
            --shadow-lg: 0 20px 50px rgba(10, 37, 150, 0.15);
            --shadow-xl: 0 30px 80px rgba(10, 37, 150, 0.2);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
            --radius-full: 50px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            line-height: 1.6;
            color: var(--gray-800);
            background: var(--gray-100);
            overflow-x: hidden;
        }

        /* ── Header ── */
        .header {
            background: var(--white);
            box-shadow: var(--shadow-sm);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .header.scrolled {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            box-shadow: var(--shadow-md);
        }

        .header-inner {
            max-width: 1400px;
            margin: 0 auto;
            padding: 12px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.02);
        }

        .logo img {
            height: 55px;
            width: auto;
            transition: height 0.3s ease;
        }

        .header.scrolled .logo img {
            height: 48px;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 32px;
            align-items: center;
        }

        .nav-menu a {
            text-decoration: none;
            color: var(--gray-700);
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            transition: all 0.3s ease;
            position: relative;
            padding: 8px 0;
        }

        .nav-menu a:hover {
            color: var(--ctp-blue);
        }

        .nav-menu a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--ctp-gold), var(--ctp-gold-dark));
            transition: all 0.3s ease;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .nav-menu a:hover::after {
            width: 100%;
        }

        .lang-selector {
            display: flex;
            gap: 6px;
            align-items: center;
            margin-left: 20px;
            padding-left: 20px;
            border-left: 1px solid var(--gray-300);
        }

        .lang-btn {
            background: none;
            border: 2px solid transparent;
            padding: 6px 12px;
            cursor: pointer;
            font-weight: 600;
            font-size: 11px;
            color: var(--gray-500);
            transition: all 0.3s ease;
            border-radius: var(--radius-full);
            letter-spacing: 0.5px;
        }

        .lang-btn:hover {
            color: var(--ctp-blue);
            background: var(--gray-100);
        }

        .lang-btn.active {
            background: var(--ctp-blue);
            color: var(--white);
            border-color: var(--ctp-blue);
        }

        

        /* ===== NUEVA GALERÍA EN GRID (estilo Airbnb/lujo) ===== */
        .gallery-section {
            margin-top: 79px;
            background: var(--white);
            padding: 0;
        }

        .gallery-container {
            max-width: 1440px;
            margin: 0 auto;
            padding: 0 40px;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            grid-template-rows: 280px 280px;
            gap: 8px;
            border-radius: var(--radius-xl);
            overflow: hidden;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            cursor: pointer;
            background: var(--gray-100);
        }

        .gallery-item:first-child {
            grid-row: 1 / 3;
            grid-column: 1 / 2;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .gallery-item::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, transparent 60%, rgba(0, 0, 0, 0.2) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover::after {
            opacity: 1;
        }

        .gallery-view-all {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background: var(--white);
            color: var(--gray-800);
            padding: 10px 18px;
            border-radius: var(--radius-full);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-md);
            z-index: 10;
            font-family: 'Montserrat', sans-serif;
        }

        .gallery-view-all:hover {
            background: var(--ctp-blue);
            color: var(--white);
            transform: translateY(-2px);
        }

        .gallery-placeholder {
            grid-column: 1 / -1;
            grid-row: 1 / 3;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--gray-100) 0%, var(--gray-200) 100%);
            gap: 20px;
            min-height: 400px;
            border-radius: var(--radius-xl);
        }

        .gallery-placeholder-icon {
            font-size: 64px;
            opacity: 0.3;
        }

        .gallery-placeholder-text {
            color: var(--gray-500);
            font-size: 15px;
            font-weight: 500;
        }

        .gallery-extra-buttons {
            max-width: 1440px;
            margin: 16px auto 0;
            padding: 0 40px;
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .gallery-btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--white);
            border: 1px solid var(--gray-300);
            border-radius: var(--radius-full);
            font-size: 13px;
            font-weight: 600;
            color: var(--gray-700);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .gallery-btn-outline:hover {
            background: var(--ctp-blue);
            border-color: var(--ctp-blue);
            color: var(--white);
            transform: translateY(-2px);
        }

        /* Lightbox Modal */
        .lightbox-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            z-index: 2000;
            display: none;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
        }

        .lightbox-content {
            position: relative;
            width: 90%;
            max-width: 1200px;
            height: 80vh;
        }

        .lightbox-close {
            position: absolute;
            top: -40px;
            right: 0;
            background: none;
            border: none;
            color: var(--white);
            font-size: 40px;
            cursor: pointer;
            z-index: 10;
            transition: transform 0.3s ease;
        }

        .lightbox-close:hover {
            transform: scale(1.1);
            color: var(--ctp-gold);
        }

        .lightbox-swiper {
            width: 100%;
            height: 100%;
        }

        .lightbox-swiper .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .lightbox-swiper .swiper-slide img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
        }

        .lightbox-swiper .swiper-button-next,
        .lightbox-swiper .swiper-button-prev {
            color: var(--white);
            background: rgba(255, 255, 255, 0.2);
            width: 48px;
            height: 48px;
            border-radius: 50%;
        }

        .lightbox-swiper .swiper-button-next:hover,
        .lightbox-swiper .swiper-button-prev:hover {
            background: var(--ctp-gold);
            color: var(--ctp-blue-dark);
        }

        .lightbox-counter {
            position: absolute;
            bottom: -40px;
            left: 50%;
            transform: translateX(-50%);
            color: var(--white);
            font-size: 14px;
            font-weight: 500;
            background: rgba(0, 0, 0, 0.6);
            padding: 6px 14px;
            border-radius: var(--radius-full);
        }

        /* ── Page Content ── */
        .page-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 50px 30px 100px;
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 40px;
            align-items: start;
        }

        /* Left column */
        .top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
        }

        .breadcrumb a {
            color: var(--gray-500);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .breadcrumb a:hover {
            color: var(--ctp-blue);
        }

        .breadcrumb span {
            color: var(--gray-400);
        }

        .breadcrumb .current {
            color: var(--gray-800);
            font-weight: 600;
        }

        .status-badges {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .badge {
            padding: 8px 18px;
            border-radius: var(--radius-full);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .badge-type {
            background: linear-gradient(135deg, var(--ctp-gold), var(--ctp-gold-dark));
            color: var(--ctp-blue-dark);
            box-shadow: 0 4px 15px rgba(241, 210, 41, 0.3);
        }

        .badge-sale {
            background: linear-gradient(135deg, var(--ctp-blue), var(--ctp-blue-light));
            color: var(--white);
        }

        .badge-rent {
            background: linear-gradient(135deg, #198754, #146c43);
            color: var(--white);
        }

        .badge-featured {
            background: linear-gradient(135deg, #dc3545, #b02a37);
            color: var(--white);
        }

        .property-header-block {
            background: var(--white);
            border-radius: var(--radius-xl);
            padding: 40px;
            box-shadow: var(--shadow-md);
            margin-bottom: 30px;
        }

        .property-price-big {
            font-size: 42px;
            font-weight: 800;
            color: var(--ctp-blue);
            margin-bottom: 10px;
            background: linear-gradient(135deg, var(--ctp-blue), var(--ctp-blue-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .property-title-big {
            font-size: 28px;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 16px;
        }

        .property-location-big {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--gray-600);
            font-size: 15px;
            margin-bottom: 30px;
            padding-bottom: 25px;
            border-bottom: 1px solid var(--gray-200);
        }

        .quick-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 2px;
            background: var(--gray-200);
            border-radius: var(--radius-lg);
            overflow: hidden;
        }

        .stat-item {
            background: var(--white);
            padding: 22px 15px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-value {
            font-size: 22px;
            font-weight: 800;
            color: var(--ctp-blue);
            line-height: 1.2;
        }

        .stat-label {
            font-size: 11px;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: 600;
        }

        .detail-section {
            background: var(--white);
            border-radius: var(--radius-xl);
            padding: 40px;
            box-shadow: var(--shadow-md);
            margin-bottom: 30px;
        }

        .detail-section-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--ctp-blue);
            margin-bottom: 25px;
            padding-bottom: 18px;
            border-bottom: 2px solid var(--gray-200);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .property-description {
            color: var(--gray-600);
            font-size: 15px;
            line-height: 2;
        }

        .property-description.clamped {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .btn-read-more {
            background: none;
            border: none;
            color: var(--ctp-blue);
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            margin-top: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 18px;
            background: var(--gray-100);
            border-radius: var(--radius-md);
        }

        .amenities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 12px;
        }

        .amenity-tag {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 16px;
            background: var(--gray-100);
            border-radius: var(--radius-md);
            font-size: 13px;
            font-weight: 600;
        }

        .map-container {
            height: 350px;
            border-radius: var(--radius-lg);
            overflow: hidden;
            background: var(--gray-200);
        }

        /* Sidebar */
        .property-sidebar {
            position: sticky;
            top: 100px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .price-card {
            background: var(--white);
            border-radius: var(--radius-xl);
            padding: 35px;
            box-shadow: var(--shadow-lg);
            border-top: 4px solid var(--ctp-gold);
        }

        .price-card-price {
            font-size: 36px;
            font-weight: 800;
            color: var(--ctp-blue);
        }

        .sidebar-facts {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin: 20px 0;
        }

        .btn-cta-primary,
        .btn-cta-whatsapp,
        .btn-cta-outline {
            width: 100%;
            padding: 16px;
            border-radius: var(--radius-md);
            font-weight: 700;
            text-align: center;
            display: block;
            margin-bottom: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-cta-primary {
            background: linear-gradient(135deg, var(--ctp-blue), var(--ctp-blue-light));
            color: var(--white);
        }

        .btn-cta-whatsapp {
            background: linear-gradient(135deg, #25d366, #128c7e);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-cta-outline {
            background: none;
            color: var(--ctp-blue);
            border: 2px solid var(--ctp-blue);
        }

        .agent-card {
            background: var(--white);
            border-radius: var(--radius-xl);
            padding: 30px;
            box-shadow: var(--shadow-md);
        }

        .contact-card {
            background: linear-gradient(135deg, var(--ctp-blue), var(--ctp-blue-dark));
            border-radius: var(--radius-xl);
            padding: 35px;
            color: var(--white);
        }

        .contact-form-input,
        .contact-form-textarea {
            width: 100%;
            padding: 14px;
            margin-bottom: 14px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: var(--radius-md);
            color: var(--white);
        }

        .btn-contact-send {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--ctp-gold), var(--ctp-gold-dark));
            color: var(--ctp-blue-dark);
            border: none;
            border-radius: var(--radius-md);
            font-weight: 700;
            cursor: pointer;
        }

        /* Mobile sticky bar */
        .mobile-sticky-bar {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: var(--white);
            padding: 16px 20px;
            z-index: 999;
            box-shadow: 0 -8px 30px rgba(0, 0, 0, 0.15);
        }

       

        /* Responsive */
        @media (max-width: 1200px) {
            .page-content {
                grid-template-columns: 1fr 360px;
                gap: 30px;
            }

            .gallery-grid {
                grid-template-columns: 1fr 1fr;
                grid-template-rows: 300px 200px 200px;
            }

            .gallery-item:first-child {
                grid-row: 1 / 2;
                grid-column: 1 / 3;
            }
        }

        @media (max-width: 992px) {
            .page-content {
                grid-template-columns: 1fr;
            }

            .property-sidebar {
                display: none;
            }

            .mobile-sticky-bar {
                display: block;
            }

            .gallery-grid {
                grid-template-rows: 250px 150px;
            }

            .gallery-item:nth-child(3),
            .gallery-item:nth-child(4),
            .gallery-item:nth-child(5) {
                display: none;
            }

           
        }

        @media (max-width: 768px) {
            .header-inner {
                padding: 12px 20px;
            }

            .nav-menu {
                display: none;
            }

            .gallery-section {
                margin-top: 74px;
            }

            .gallery-container,
            .gallery-extra-buttons {
                padding-left: 20px;
                padding-right: 20px;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
                grid-template-rows: 300px;
            }

            .gallery-item:first-child {
                grid-row: 1;
                grid-column: 1;
            }

            .gallery-item:not(:first-child) {
                display: none;
            }

            .page-content {
                padding: 30px 20px 80px;
            }

            .property-price-big {
                font-size: 32px;
            }

            .property-title-big {
                font-size: 22px;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

           

            .lightbox-content {
                width: 95%;
                height: 70vh;
            }
        }

        /* Dentro de tu <style> */
        #map-detail {
            height: 100%;
            width: 100%;
            display: block;
            /* Asegura que no se comporte como inline */
        }

        .leaflet-container img.leaflet-tile {
            max-width: none !important;
            max-height: none !important;
        }

        /* Evita que animaciones de entrada afecten al mapa */
        .map-container {
            overflow: hidden;
            position: relative;
            background: #f0f0f0;
            /* Color de fondo mientras carga */
        }
    </style>

@endpush

@section('content')

    <body>

        <!-- Header -->
      

        <!-- GALERÍA EN GRID (NUEVA) -->
        

        <section class="gallery-section">
            @if($property->images && $property->images->count() > 0)
                <div class="gallery-container">
                    <div class="gallery-grid">
                        @foreach($property->images->take(5) as $index => $img)
                            <div class="gallery-item" onclick="openLightbox({{ $index }})">
                                <img src="{{ $img->url }}" alt="{{ $property->title }} - foto {{ $loop->iteration }}"
                                    loading="{{ $loop->first ? 'eager' : 'lazy' }}">
                                @if($loop->first && $property->images->count() > 1)
                                    <button class="gallery-view-all">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2">
                                            <rect x="3" y="3" width="18" height="18" rx="2" />
                                            <circle cx="8.5" cy="8.5" r="1.5" />
                                            <polyline points="21 15 16 10 5 21" />
                                        </svg>
                                        Ver {{ $property->images->count() }} fotos
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                @if($property->video_url || $property->virtual_tour_url)
                    <div class="gallery-extra-buttons">
                        @if($property->video_url)
                            <a href="{{ $property->video_url }}" target="_blank" class="gallery-btn-outline">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polygon points="5 3 19 12 5 21 5 3" />
                                </svg>
                                Ver video
                            </a>
                        @endif
                        @if($property->virtual_tour_url)
                            <a href="{{ $property->virtual_tour_url }}" target="_blank" class="gallery-btn-outline">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <polygon points="10 8 16 12 10 16 10 8" />
                                </svg>
                                Tour virtual
                            </a>
                        @endif
                    </div>
                @endif
            @else
                <div class="gallery-container">
                    <div class="gallery-grid">
                        <div class="gallery-placeholder">
                            <span class="gallery-placeholder-icon">🏠</span>
                            <span class="gallery-placeholder-text">No hay imágenes disponibles</span>
                        </div>
                    </div>
                </div>
            @endif
        </section>

        <!-- LIGHTBOX MODAL -->
        <div id="lightboxModal" class="lightbox-modal">
            <div class="lightbox-content">
                <button class="lightbox-close">&times;</button>
                <div class="swiper lightbox-swiper">
                    <div class="swiper-wrapper">
                        @foreach($property->images as $img)
                            <div class="swiper-slide">
                                <img src="{{ $img->url }}" alt="{{ $property->title }}">
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="lightbox-counter"></div>
                </div>
            </div>
        </div>

        <!-- CONTENIDO PRINCIPAL (resto de la página) -->
        <div class="page-content">
            <div class="property-main">
                <div class="top-bar">
                    <input type="hidden" name="latitude" id="lat" value="{{ old('latitude', $property->latitude) }}">
                    <input type="hidden" name="longitude" id="lng" value="{{ old('longitude', $property->longitude) }}">
                    <div class="breadcrumb">
                        <a href="/">Inicio</a>
                        <span>›</span>
                        <a href="/propiedades">Propiedades</a>
                        <span>›</span>
                        <span class="current">{{ $property->title }}</span>
                    </div>
                    <div class="status-badges">
                        <span class="badge badge-type">{{ $property->type }}</span>
                        <span class="badge badge-sale">En {{ $property->contract_type }}</span>
                        @if ($property->is_featured == 1)
                            <span class="badge badge-featured">Destacado</span>
                        @endif
                    </div>
                </div>

                <div class="property-header-block">
                    <div class="property-price-big">${{ number_format($property->price, 0, ',', '.') }} <span>MXN</span>
                    </div>
                    <h1 class="property-title-big">{{ $property->title }}</h1>
                    <div class="property-location-big">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        {{ Str::limit($property->title, 40) }}
                    </div>
                    <div class="quick-stats">
                        <div class="stat-item">
                            <div class="stat-value">{{ $property->bedrooms }}</div>
                            <div class="stat-label">Recámaras</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ $property->bathrooms }}</div>
                            <div class="stat-label">Baños</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ $property->m2_construction }}</div>
                            <div class="stat-label">m² construidos</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ $property->parking_spots }}</div>
                            <div class="stat-label">Cajones</div>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <div class="detail-section-title">Descripción</div>
                    <div class="property-description clamped" id="propDesc">
                        {{ $property->description }}
                    </div>
                    <button class="btn-read-more" onclick="toggleDesc()">Leer más <svg width="16" height="16"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9" />
                        </svg></button>
                </div>

                <div class="detail-section">
                    <div class="detail-section-title">Características</div>
                    <div class="features-grid">
                        <div class="feature-item">
                            <div class="stat-icon">🏗️</div>
                            <div>
                                <div class="stat-label">Tipo</div>
                                <div class="stat-value">{{ $property->type }}</div>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="stat-icon">🛏️</div>
                            <div>
                                <div class="stat-label">Recámaras</div>
                                <div class="stat-value">{{ $property->bedrooms }}</div>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="stat-icon">🛁</div>
                            <div>
                                <div class="stat-label">Baños</div>
                                <div class="stat-value">{{ $property->bathrooms }}</div>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="stat-icon">📐</div>
                            <div>
                                <div class="stat-label">Construcción</div>
                                <div class="stat-value">{{ $property->m2_construction }}</div>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="stat-icon">🌳</div>
                            <div>
                                <div class="stat-label">Terreno</div>
                                <div class="stat-value">{{ $property->m2_land }}</div>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="stat-icon">🚗</div>
                            <div>
                                <div class="stat-label">Estacionamiento</div>
                                <div class="stat-value">{{ $property->parking_spots }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <div class="detail-section-title">Amenidades</div>
                    <div class="amenities-grid">
                        @foreach($property->amenities as $amenity)
                            <div class="amenity-item">
                                @if(str_contains($amenity->icon, 'bi-'))
                                    <i class="{{ $amenity->icon }}"></i>
                                @else
                                    <span>{{ $amenity->icon }}</span> {{-- Aquí se pintará el emoji 🌳 --}}
                                @endif
                                <span>{{ $amenity->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="detail-section">
                    <div class="detail-section-title">
                        <i class="bi bi-geo-alt"></i> Ubicación
                    </div>
                    <div class="map-container">
                        <div id="map-detail"></div>
                    </div>
                </div>
            </div>

            <aside class="property-sidebar">
                <div class="price-card">
                    <div class="price-card-price">${{ number_format($property->price, 0, ',', '.') }} <span>MXN</span></div>
                    <div class="sidebar-facts">
                        <div><span class="stat-value">{{ $property->bedrooms }}</span>
                            <div class="stat-label">Rec.</div>
                        </div>
                        <div><span class="stat-value">{{ $property->bathrooms }}</span>
                            <div class="stat-label">Baños</div>
                        </div>
                        <div><span class="stat-value">{{ $property->m2_construction }}</span>
                            <div class="stat-label">m²</div>
                        </div>
                        <div><span class="stat-value">{{ $property->parking_spots }}</span>
                            <div class="stat-label">Estac.</div>
                        </div>
                    </div>
                    <a href="tel:3336152664" class="btn-cta-primary">📞 Llamar ahora</a>
                    <a href="https://wa.me/523336152664" target="_blank" class="btn-cta-whatsapp">💬 WhatsApp</a>
                    <a href="#contactForm" class="btn-cta-outline">✉️ Enviar mensaje</a>
                </div>
                <div class="agent-card">
                    <div class="agent-title">Agente responsable </div>
                    <div class="agent-info">
                        {{-- Si existe el vendedor, muestra su avatar (o emoji) y su nombre --}}
                        <div class="agent-avatar">
                            {{ $property->seller ? '👤' : '🏢' }}
                        </div>
                        <div>
                            <div class="agent-name">
                                {{ $property->seller?->name ?? 'Oficina Central CTP' }}
                            </div>
                            <div class="agent-role">
                                {{ $property->seller ? 'Asesor Inmobiliario' : 'Atención a clientes' }}
                            </div>
                        </div>
                    </div>

                    {{-- El teléfono parece ser el de la oficina, así que lo dejamos fijo o podrías validarlo también --}}
                    <a href="tel:3336152664" class="agent-phone">📞 333 615 2664</a>
                </div>
                <div class="contact-card" id="contactForm">
                    <h4>¿Te interesa?</h4>
                    <p>Déjanos tus datos y te contactamos.</p>
                    <form>
                        <input type="text" class="contact-form-input" placeholder="Tu nombre" required>
                        <input type="tel" class="contact-form-input" placeholder="Tu teléfono" required>
                        <input type="email" class="contact-form-input" placeholder="Tu email">
                        <textarea class="contact-form-textarea" placeholder="Me interesa esta propiedad..."></textarea>
                        <button type="submit" class="btn-contact-send">Enviar mensaje</button>
                    </form>
                </div>
            </aside>
        </div>

        <!-- Mobile sticky bar -->
        <div class="mobile-sticky-bar">
            <div class="msb-price">$ <small>MXN</small></div>
            <div class="msb-btns" style="display:flex; gap:12px; margin-top:12px;">
                <a href="tel:3336152664" class="msb-btn-primary"
                    style="flex:1; background:var(--ctp-blue); color:white; padding:14px; border-radius:12px; text-align:center; text-decoration:none;">📞
                    Llamar</a>
                <a href="https://wa.me/523336152664" target="_blank" class="msb-btn-wa"
                    style="flex:1; background:#25d366; color:white; padding:14px; border-radius:12px; text-align:center; text-decoration:none;">💬
                    WhatsApp</a>
            </div>
        </div>

        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            // Header scroll effect
            window.addEventListener('scroll', () => document.getElementById('header').classList.toggle('scrolled', window.scrollY > 50));

            // Toggle description
            function toggleDesc() {
                const desc = document.getElementById('propDesc');
                const btn = document.querySelector('.btn-read-more');
                desc.classList.toggle('clamped');
                btn.innerHTML = desc.classList.contains('clamped')
                    ? 'Leer más <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>'
                    : 'Leer menos <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="transform:rotate(180deg)"><polyline points="6 9 12 15 18 9"/></svg>';
            }

            // Lightbox logic
            let lightboxSwiper = null;
            function openLightbox(initialIndex = 0) {
                const modal = document.getElementById('lightboxModal');
                if (!modal) return;
                if (lightboxSwiper) lightboxSwiper.destroy(true, true);
                lightboxSwiper = new Swiper('.lightbox-swiper', {
                    loop: true,
                    navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
                    initialSlide: initialIndex,
                    on: { slideChange: function () { document.querySelector('.lightbox-counter').textContent = (this.realIndex + 1) + ' / {{ $property->images->count() }}'; } }
                });
                document.querySelector('.lightbox-counter').textContent = (initialIndex + 1) + ' / {{ $property->images->count() }}';
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }
            function closeLightbox() {
                const modal = document.getElementById('lightboxModal');
                if (modal) {
                    modal.style.display = 'none';
                    document.body.style.overflow = '';
                    if (lightboxSwiper) { lightboxSwiper.destroy(true, true); lightboxSwiper = null; }
                }
            }
            document.addEventListener('DOMContentLoaded', () => {
                const modal = document.getElementById('lightboxModal');
                const closeBtn = modal?.querySelector('.lightbox-close');
                closeBtn?.addEventListener('click', closeLightbox);
                modal?.addEventListener('click', (e) => { if (e.target === modal) closeLightbox(); });
                document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && modal?.style.display === 'flex') closeLightbox(); });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const lat = {{ $property->latitude }};
                const lng = {{ $property->longitude }};

                const map = L.map('map-detail', {
                    dragging: !L.Browser.mobile,
                    scrollWheelZoom: false,
                    touchZoom: true,
                    fadeAnimation: true
                }).setView([lat, lng], 16);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap'
                }).addTo(map);

                L.marker([lat, lng]).addTo(map)
                    .bindPopup('<b>{{ $property->title }}</b><br>{{ $property->neighborhood }}')
                    .openPopup();

                // 1. Ejecución inmediata tras carga de ventana
                window.onload = () => {
                    map.invalidateSize();
                };

                // 2. Ejecución de seguridad con un pequeño delay
                setTimeout(() => {
                    map.invalidateSize(true);
                }, 600);
            });
        </script>

    </body>

@endsection