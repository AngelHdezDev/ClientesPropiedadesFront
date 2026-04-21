@extends('layouts.app')

@section('title', 'CTP Realty | Constructora y Bienes Raíces en Guadalajara')

@push('styles')
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

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Montserrat', sans-serif;
            line-height: 1.6;
            color: var(--gray-800);
            background: var(--gray-100);
            overflow-x: hidden;
        }

        /* ── Header (igual al home) ── */
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
            background: rgba(255,255,255,0.98);
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
        .logo { display: flex; align-items: center; gap: 15px; }
        .logo img { height: 60px; width: auto; }

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
        .nav-menu a:hover,
        .nav-menu a.active { color: var(--ctp-blue); }
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
        .nav-menu a:hover::after,
        .nav-menu a.active::after { width: 100%; }

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
        .lang-btn:hover { color: var(--ctp-blue); }
        .lang-btn.active {
            background: var(--ctp-blue);
            color: var(--white);
            border-color: var(--ctp-blue);
        }

        /* ── Page Hero / Banner ── */
        .page-hero {
            margin-top: 90px;
            background: linear-gradient(135deg, var(--ctp-blue) 0%, var(--ctp-blue-dark) 100%);
            padding: 60px 30px;
            position: relative;
            overflow: hidden;
        }
        .page-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: rgba(241, 210, 41, 0.06);
            pointer-events: none;
        }
        .page-hero-inner {
            max-width: 1400px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 15px;
            font-size: 13px;
        }
        .breadcrumb a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: color 0.2s;
        }
        .breadcrumb a:hover { color: var(--ctp-gold); }
        .breadcrumb span { color: rgba(255,255,255,0.4); }
        .breadcrumb .current { color: var(--ctp-gold); font-weight: 600; }

        .page-hero h1 {
            font-size: 42px;
            font-weight: 800;
            color: var(--white);
            margin-bottom: 10px;
        }
        .page-hero h1 span { color: var(--ctp-gold); }
        .page-hero p {
            color: rgba(255,255,255,0.8);
            font-size: 16px;
        }
        .results-count {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.2);
            color: var(--white);
            padding: 8px 18px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            margin-top: 15px;
        }
        .results-count strong { color: var(--ctp-gold); }

        /* ── Main Layout ── */
        .catalog-layout {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 30px 80px;
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 30px;
            align-items: start;
        }

        /* ── Sidebar Filters ── */
        .sidebar {
            position: sticky;
            top: 110px;
        }
        .sidebar-card {
            background: var(--white);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(10, 37, 150, 0.07);
            margin-bottom: 20px;
        }
        .sidebar-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--ctp-blue);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .sidebar-title button {
            background: none;
            border: none;
            color: var(--gray-600);
            font-size: 12px;
            cursor: pointer;
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
            transition: color 0.2s;
        }
        .sidebar-title button:hover { color: var(--ctp-blue); }

        .filter-group { margin-bottom: 25px; }
        .filter-group:last-child { margin-bottom: 0; }

        .filter-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--gray-600);
            margin-bottom: 12px;
            display: block;
        }
        .filter-select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--gray-200);
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Montserrat', sans-serif;
            color: var(--gray-800);
            background: var(--white);
            transition: border-color 0.3s;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236c757d' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
        }
        .filter-select:focus {
            outline: none;
            border-color: var(--ctp-blue);
        }

        .filter-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--gray-200);
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Montserrat', sans-serif;
            color: var(--gray-800);
            transition: border-color 0.3s;
        }
        .filter-input:focus {
            outline: none;
            border-color: var(--ctp-blue);
        }

        /* Price range dual inputs */
        .price-range {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            align-items: center;
        }
        .price-range span {
            text-align: center;
            color: var(--gray-600);
            font-size: 12px;
        }

        /* Checkbox Pills */
        .checkbox-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .pill-label {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            border: 2px solid var(--gray-200);
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-600);
            cursor: pointer;
            transition: all 0.2s;
            user-select: none;
        }
        .pill-label:hover {
            border-color: var(--ctp-blue);
            color: var(--ctp-blue);
        }
        .pill-label input { display: none; }
        .pill-label.checked {
            background: var(--ctp-blue);
            border-color: var(--ctp-blue);
            color: var(--white);
        }

        /* Bedrooms/Bathrooms row */
        .number-pills {
            display: flex;
            gap: 8px;
        }
        .num-pill {
            flex: 1;
            text-align: center;
            padding: 10px;
            border: 2px solid var(--gray-200);
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            color: var(--gray-600);
            cursor: pointer;
            transition: all 0.2s;
            user-select: none;
        }
        .num-pill:hover {
            border-color: var(--ctp-blue);
            color: var(--ctp-blue);
        }
        .num-pill input { display: none; }
        .num-pill.checked {
            background: var(--ctp-blue);
            border-color: var(--ctp-blue);
            color: var(--white);
        }

        .btn-filter {
            width: 100%;
            padding: 15px;
            background: var(--ctp-blue);
            color: var(--white);
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            font-family: 'Montserrat', sans-serif;
            transition: all 0.3s;
        }
        .btn-filter:hover {
            background: var(--ctp-blue-light);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(10, 37, 150, 0.25);
        }
        .btn-reset {
            width: 100%;
            padding: 12px;
            background: none;
            color: var(--gray-600);
            border: 2px solid var(--gray-200);
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Montserrat', sans-serif;
            margin-top: 10px;
            transition: all 0.3s;
        }
        .btn-reset:hover {
            border-color: var(--gray-600);
            color: var(--gray-800);
        }

        /* Active filters badges */
        .active-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 20px;
        }
        .filter-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--ctp-blue);
            color: var(--white);
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
        }
        .filter-badge button {
            background: none;
            border: none;
            color: rgba(255,255,255,0.7);
            cursor: pointer;
            font-size: 14px;
            line-height: 1;
            padding: 0;
            transition: color 0.2s;
        }
        .filter-badge button:hover { color: var(--white); }

        /* ── Toolbar (sort + view mode) ── */
        .toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
            gap: 15px;
            flex-wrap: wrap;
        }
        .toolbar-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .sort-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--gray-600);
            white-space: nowrap;
        }
        .sort-select {
            padding: 10px 16px;
            border: 2px solid var(--gray-200);
            border-radius: 10px;
            font-size: 13px;
            font-family: 'Montserrat', sans-serif;
            color: var(--gray-800);
            cursor: pointer;
            transition: border-color 0.3s;
            background: var(--white);
        }
        .sort-select:focus {
            outline: none;
            border-color: var(--ctp-blue);
        }
        .view-toggle {
            display: flex;
            gap: 6px;
        }
        .view-btn {
            width: 40px;
            height: 40px;
            border: 2px solid var(--gray-200);
            border-radius: 10px;
            background: var(--white);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            transition: all 0.2s;
        }
        .view-btn.active {
            background: var(--ctp-blue);
            border-color: var(--ctp-blue);
            color: var(--white);
        }
        .view-btn:hover:not(.active) {
            border-color: var(--ctp-blue);
        }

        /* ── Properties Grid ── */
        .properties-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }
        .properties-grid.list-view {
            grid-template-columns: 1fr;
        }

        .property-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.07);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            text-decoration: none;
            color: inherit;
        }
        .property-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(10, 37, 150, 0.15);
        }

        /* List view card */
        .properties-grid.list-view .property-card {
            flex-direction: row;
        }
        .properties-grid.list-view .property-image {
            width: 280px;
            min-width: 280px;
            height: 200px;
        }
        .properties-grid.list-view .property-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .property-image {
            height: 220px;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%);
        }
        .property-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .property-card:hover .property-image img {
            transform: scale(1.05);
        }
        .property-image-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #bcccdc;
            opacity: 0.6;
        }

        /* Badges */
        .property-badges {
            position: absolute;
            top: 15px;
            left: 15px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .badge {
            padding: 5px 14px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .badge-type {
            background: var(--ctp-gold);
            color: var(--ctp-blue-dark);
        }
        .badge-status-sale {
            background: var(--ctp-blue);
            color: var(--white);
        }
        .badge-status-rent {
            background: #198754;
            color: var(--white);
        }
        .badge-featured {
            background: rgba(241, 210, 41, 0.95);
            color: var(--ctp-blue-dark);
        }

        /* Favorite button */
        .btn-fav {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 36px;
            height: 36px;
            background: rgba(255,255,255,0.9);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 18px;
            transition: all 0.2s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        .btn-fav:hover {
            transform: scale(1.15);
            background: var(--white);
        }
        .btn-fav.active { color: #e74c3c; }

        .property-content { padding: 22px; }

        .property-price {
            font-size: 22px;
            font-weight: 800;
            color: var(--ctp-blue);
            margin-bottom: 6px;
        }
        .property-price span {
            font-size: 13px;
            font-weight: 500;
            color: var(--gray-600);
        }

        .property-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--gray-800);
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .property-location {
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--gray-600);
            font-size: 13px;
            margin-bottom: 16px;
        }

        .property-features {
            display: flex;
            gap: 16px;
            padding-top: 16px;
            border-top: 1px solid var(--gray-200);
        }
        .property-feature {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            color: var(--gray-600);
            font-weight: 500;
        }

        /* ── Pagination ── */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 50px;
        }
        .page-btn {
            width: 42px;
            height: 42px;
            border: 2px solid var(--gray-200);
            border-radius: 10px;
            background: var(--white);
            font-size: 14px;
            font-weight: 600;
            font-family: 'Montserrat', sans-serif;
            color: var(--gray-600);
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }
        .page-btn:hover {
            border-color: var(--ctp-blue);
            color: var(--ctp-blue);
        }
        .page-btn.active {
            background: var(--ctp-blue);
            border-color: var(--ctp-blue);
            color: var(--white);
        }
        .page-btn.disabled {
            opacity: 0.4;
            cursor: default;
            pointer-events: none;
        }

        /* ── Empty state ── */
        .empty-state {
            text-align: center;
            padding: 80px 30px;
            background: var(--white);
            border-radius: 20px;
        }
        .empty-state .icon { font-size: 60px; margin-bottom: 20px; }
        .empty-state h3 {
            font-size: 22px;
            font-weight: 700;
            color: var(--ctp-blue);
            margin-bottom: 10px;
        }
        .empty-state p {
            color: var(--gray-600);
            font-size: 15px;
            margin-bottom: 25px;
        }

        /* ── Footer (igual al home) ── */
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
        .footer-brand img { height: 70px; margin-bottom: 20px; }
        .footer-brand p {
            color: var(--gray-600);
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 20px;
        }
        .footer-social { display: flex; gap: 15px; }
        .social-link {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
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
        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: 12px; }
        .footer-links a {
            color: var(--gray-600);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }
        .footer-links a:hover { color: var(--ctp-gold); }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 30px;
            text-align: center;
            color: var(--gray-600);
            font-size: 14px;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* ── Responsive ── */
        @media (max-width: 1100px) {
            .catalog-layout {
                grid-template-columns: 280px 1fr;
            }
        }
        @media (max-width: 900px) {
            .catalog-layout {
                grid-template-columns: 1fr;
            }
            .sidebar {
                position: static;
            }
            .sidebar-card { display: none; }
            .sidebar-card.mobile-open { display: block; }
            .mobile-filter-btn {
                display: flex !important;
            }
            .footer-content {
                grid-template-columns: 1fr 1fr;
            }
        }
        @media (max-width: 768px) {
            .nav-menu { display: none; }
            .page-hero h1 { font-size: 28px; }
            .properties-grid { grid-template-columns: 1fr; }
            .properties-grid.list-view .property-card { flex-direction: column; }
            .properties-grid.list-view .property-image { width: 100%; min-width: 0; }
            .catalog-layout { padding: 20px 15px 60px; }
            .footer-content { grid-template-columns: 1fr; gap: 40px; }
        }

        /* Mobile filter toggle (visible only on mobile) */
        .mobile-filter-btn {
            display: none;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            background: var(--ctp-blue);
            color: var(--white);
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Montserrat', sans-serif;
            cursor: pointer;
            margin-bottom: 20px;
            width: 100%;
            justify-content: center;
        }

        /* Ajuste para que las amenidades no ocupen demasiado espacio vertical */
        .checkbox-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            max-height: 250px; /* Limita la altura */
            overflow-y: auto;  /* Agrega scroll si hay demasiadas */
            padding-right: 5px;
        }

        /* Estilo del scrollbar para que se vea limpio */
        .checkbox-pills::-webkit-scrollbar {
            width: 4px;
        }
        .checkbox-pills::-webkit-scrollbar-thumb {
            background: var(--gray-300);
            border-radius: 10px;
        }
    </style>
@endpush


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propiedades | CTP Realty</title>
    <meta name="description" content="Explora todas las propiedades disponibles en CTP Realty - Casas, departamentos, terrenos y locales comerciales en Guadalajara.">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    
</head>

<body>
    <!-- Page Hero -->
    <section class="page-hero">
        <div class="page-hero-inner">
            <div class="breadcrumb">
                <a href="/">Inicio</a>
                <span>›</span>
                <span class="current">Propiedades</span>
            </div>
            <h1>Todas las <span>Propiedades</span></h1>
            <p>Encuentra tu lugar ideal entre nuestra selección exclusiva en Guadalajara</p>
            <div class="results-count">
                <strong>{{ $properties->total() }}</strong> propiedades encontradas
            </div>
        </div>
    </section>

    <!-- Catalog Layout -->
    <div class="catalog-layout">

        <!-- Sidebar -->
        <aside class="sidebar">

            <!-- Mobile toggle -->
            <button class="mobile-filter-btn" onclick="toggleMobileFilters()">
                🔍 Filtros de búsqueda
            </button>

            <form method="GET" action="/propiedades" id="filterForm">

                <div class="sidebar-card" id="filterSidebar">
                    <div class="sidebar-title">
                        Filtros
                        <button type="button" onclick="resetFilters()">Limpiar todo</button>
                    </div>

                    <!-- Búsqueda libre -->
                    <div class="filter-group">
                        <label class="filter-label">Buscar</label>
                        <input type="text" name="q" class="filter-input"
                            placeholder="Colonia, zona, desarrollo..."
                            value="{{ request('q') }}">
                    </div>

                    <!-- Tipo de operación -->
                    <div class="filter-group">
                        <label class="filter-label">Operación</label>
                        <div class="checkbox-pills">
                            <label class="pill-label {{ request('tipo_operacion') == 'venta' ? 'checked' : '' }}">
                                <input type="radio" name="tipo_operacion" value="venta"
                                    {{ request('tipo_operacion') == 'venta' ? 'checked' : '' }}>
                                Venta
                            </label>
                            <label class="pill-label {{ request('tipo_operacion') == 'renta' ? 'checked' : '' }}">
                                <input type="radio" name="tipo_operacion" value="renta"
                                    {{ request('tipo_operacion') == 'renta' ? 'checked' : '' }}>
                                Renta
                            </label>
                            <label class="pill-label {{ !request('tipo_operacion') ? 'checked' : '' }}">
                                <input type="radio" name="tipo_operacion" value=""
                                    {{ !request('tipo_operacion') ? 'checked' : '' }}>
                                Todos
                            </label>
                        </div>
                    </div>

                    <!-- Tipo de propiedad -->
                    <div class="filter-group">
                        <label class="filter-label">Tipo de propiedad</label>
                        <select name="tipo_propiedad" class="filter-select">
                            <option value="">Todos los tipos</option>
                            <option value="casa" {{ request('tipo_propiedad') == 'casa' ? 'selected' : '' }}>Casa</option>
                            <option value="departamento" {{ request('tipo_propiedad') == 'departamento' ? 'selected' : '' }}>Departamento</option>
                            <option value="terreno" {{ request('tipo_propiedad') == 'terreno' ? 'selected' : '' }}>Terreno</option>
                            <option value="local_comercial" {{ request('tipo_propiedad') == 'local_comercial' ? 'selected' : '' }}>Local Comercial</option>
                            <!-- <option value="oficina" {{ request('tipo_propiedad') == 'oficina' ? 'selected' : '' }}>Oficina</option> -->
                        </select>
                    </div>

                    <!-- Precio -->
                    <div class="filter-group">
                        <label class="filter-label">Rango de precio (MXN)</label>
                        <div class="price-range">
                            <input type="number" name="precio_min" class="filter-input"
                                placeholder="Mín." value="{{ request('precio_min') }}"
                                style="padding: 10px 12px; font-size: 13px;">
                            
                            <input type="number" name="precio_max" class="filter-input"
                                placeholder="Máx." value="{{ request('precio_max') }}"
                                style="padding: 10px 12px; font-size: 13px;">
                        </div>
                    </div>

                    <!-- Recámaras -->
                    <div class="filter-group">
                        <label class="filter-label">Recámaras</label>
                        <div class="number-pills">
                            @foreach([1,2,3,4,'5+'] as $n)
                            <label class="num-pill {{ request('recamaras') == $n ? 'checked' : '' }}">
                                <input type="radio" name="recamaras" value="{{ $n }}"
                                    {{ request('recamaras') == $n ? 'checked' : '' }}>
                                {{ $n }}
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Baños -->
                    <div class="filter-group">
                        <label class="filter-label">Baños</label>
                        <div class="number-pills">
                            @foreach([1,2,3,'4+'] as $n)
                            <label class="num-pill {{ request('bathrooms') == $n ? 'checked' : '' }}">
                                <input type="radio" name="bathrooms" value="{{ $n }}"
                                    {{ request('bathrooms') == $n ? 'checked' : '' }}>
                                {{ $n }}
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Colonia / Zona -->
                    <div class="filter-group">
                        <label class="filter-label">Zona / Colonia</label>
                        <select name="zona" class="filter-select">
                            <option value="">Todas las zonas</option>
                            @foreach($zonas as $zona)
                                <option value="{{ $zona }}" {{ request('zona') == $zona ? 'selected' : '' }}>
                                    {{ $zona }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Amenidades</label>
                        <div class="checkbox-pills">
                            @foreach($amenities as $amenity)
                                @php 
                                    $isChecked = is_array(request('amenities')) && in_array($amenity->id, request('amenities'));
                                @endphp
                                <label class="pill-label {{ $isChecked ? 'checked' : '' }}">
                                    <input type="checkbox" name="amenities[]" value="{{ $amenity->id }}" {{ $isChecked ? 'checked' : '' }}>
                                    {{ $amenity->icon }}{{ $amenity->name }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn-filter">Aplicar filtros</button>
                    <button type="button" class="btn-reset" onclick="resetFilters()">Limpiar filtros</button>
                </div>

            </form>
        </aside>

        <!-- Main content -->
        <main>

            <!-- Active filter badges -->
            @if(request()->hasAny(['q','tipo_operacion','tipo_propiedad','precio_min','precio_max','recamaras','banos','zona']))
            <div class="active-filters" id="activeFilters">
                @if(request('q'))
                    <span class="filter-badge">
                        "{{ request('q') }}"
                        <button onclick="removeFilter('q')">×</button>
                    </span>
                @endif
                @if(request('tipo_operacion'))
                    <span class="filter-badge">
                        {{ ucfirst(request('tipo_operacion')) }}
                        <button onclick="removeFilter('tipo_operacion')">×</button>
                    </span>
                @endif
                @if(request('tipo_propiedad'))
                    <span class="filter-badge">
                        {{ ucfirst(str_replace('_', ' ', request('tipo_propiedad'))) }}
                        <button onclick="removeFilter('tipo_propiedad')">×</button>
                    </span>
                @endif
                @if(request('recamaras'))
                    <span class="filter-badge">
                        {{ request('recamaras') }} rec.
                        <button onclick="removeFilter('recamaras')">×</button>
                    </span>
                @endif
                @if(request('banos'))
                    <span class="filter-badge">
                        {{ request('banos') }} baños
                        <button onclick="removeFilter('banos')">×</button>
                    </span>
                @endif
                @if(request('zona'))
                    <span class="filter-badge">
                        {{ request('zona') }}
                        <button onclick="removeFilter('zona')">×</button>
                    </span>
                @endif
                @if(request('amenities') && is_array(request('amenities')))
                    @foreach(request('amenities') as $amenityId)
                        @php
                            $amenity = $amenities->firstWhere('id', (int)$amenityId);
                        @endphp
                        
                        @if($amenity)
                            <span class="filter-badge">
                                {{ $amenity->name }}
                                {{-- Pasamos la llave 'amenities[]' y el ID específico --}}
                                <button type="button" onclick="removeFilter('amenities[]', '{{ $amenityId }}')">×</button>
                            </span>
                        @endif
                    @endforeach
                @endif
            </div>
            @endif

            <!-- Toolbar -->
            <div class="toolbar">
                <div class="toolbar-left">
                    <span class="sort-label">Ordenar por:</span>
                    <select class="sort-select" name="orden" onchange="applySort(this.value)">
                        <option value="reciente" {{ request('orden') == 'reciente' ? 'selected' : '' }}>Más recientes</option>
                        <option value="precio_asc" {{ request('orden') == 'precio_asc' ? 'selected' : '' }}>Precio: menor a mayor</option>
                        <option value="precio_desc" {{ request('orden') == 'precio_desc' ? 'selected' : '' }}>Precio: mayor a menor</option>
                        <option value="superficie_desc" {{ request('orden') == 'superficie_desc' ? 'selected' : '' }}>Mayor superficie</option>
                    </select>
                </div>
                <div class="view-toggle">
                    <button class="view-btn active" id="btnGrid" onclick="setView('grid')" title="Vista cuadrícula">⊞</button>
                    <button class="view-btn" id="btnList" onclick="setView('list')" title="Vista lista">☰</button>
                </div>
            </div>

            <!-- Grid -->
            @if($properties->count() > 0)
            <div class="properties-grid" id="propertiesGrid">

                @foreach($properties as $prop)
                <a href="/propiedad/{{ $prop->slug }}" class="property-card">

                    <div class="property-image">
                        @if($prop->thumbnail)
                            <img src="{{ $prop->thumbnail_url }}" alt="{{ $prop->title }}" loading="lazy">
                        @else
                            <div class="property-image-placeholder">🏠</div>
                        @endif

                        <div class="property-badges">
                            @if($prop->tipo_propiedad)
                                <span class="badge badge-type">{{ ucfirst($prop->tipo_propiedad) }}</span>
                            @endif
                            @if($prop->tipo_operacion == 'venta')
                                <span class="badge badge-status-sale">Venta</span>
                            @elseif($prop->tipo_operacion == 'renta')
                                <span class="badge badge-status-rent">Renta</span>
                            @endif
                        </div>

                        
                    </div>

                    <div class="property-content">
                        <div class="property-price">
                            ${{ number_format($prop->price, 0) }}
                            <span>MXN</span>
                        </div>
                        <h3 class="property-title">{{ $prop->title }}</h3>
                        <p class="property-location">
                            📍 {{ $prop->neighborhood ?? $prop->city }}, {{ $prop->city }}, {{ $prop->state }}
                        </p>
                        <div class="property-features">
                            @if($prop->bedrooms)
                                <span class="property-feature">🛏️ {{ $prop->bedrooms }} rec.</span>
                            @endif
                            @if($prop->bathrooms)
                                <span class="property-feature">🛁 {{ $prop->bathrooms }} baños</span>
                            @endif
                            @if($prop->square_meters)
                                <span class="property-feature">📐 {{ number_format($prop->square_meters) }} m²</span>
                            @endif
                        </div>
                    </div>
                </a>
                @endforeach

            </div>

            <!-- Pagination -->
            <div class="pagination">
                {{-- Previous --}}
                @if($properties->onFirstPage())
                    <span class="page-btn disabled">‹</span>
                @else
                    <a href="{{ $properties->previousPageUrl() }}" class="page-btn">‹</a>
                @endif

                {{-- Pages --}}
                @for($i = 1; $i <= $properties->lastPage(); $i++)
                    @if($i == $properties->currentPage())
                        <span class="page-btn active">{{ $i }}</span>
                    @elseif($i == 1 || $i == $properties->lastPage() || abs($i - $properties->currentPage()) <= 2)
                        <a href="{{ $properties->url($i) }}" class="page-btn">{{ $i }}</a>
                    @elseif(abs($i - $properties->currentPage()) == 3)
                        <span class="page-btn disabled" style="border:none; background:none;">…</span>
                    @endif
                @endfor

                {{-- Next --}}
                @if($properties->hasMorePages())
                    <a href="{{ $properties->nextPageUrl() }}" class="page-btn">›</a>
                @else
                    <span class="page-btn disabled">›</span>
                @endif
            </div>

            @else
            <div class="empty-state">
                <div class="icon">🔍</div>
                <h3>No encontramos propiedades</h3>
                <p>Intenta ajustar los filtros para ver más resultados.</p>
                <a href="/propiedades" style="display:inline-flex; align-items:center; gap:8px; padding:14px 30px; background:var(--ctp-blue); color:#fff; border-radius:50px; font-weight:700; font-size:14px; text-decoration:none; text-transform:uppercase; letter-spacing:1px;">
                    Ver todas las propiedades
                </a>
            </div>
            @endif

        </main>
    </div>

    
    <script>
    // 1. Header scroll
    window.addEventListener('scroll', () => {
        const header = document.getElementById('header');
        if (header) {
            header.classList.toggle('scrolled', window.scrollY > 100);
        }
    });

    // 2. Lógica Maestra para Pills (Radios y Checkboxes)
    document.querySelectorAll('.pill-label input, .num-pill input').forEach(input => {
        
        // Estado inicial para Radios (para poder desmarcarlos)
        if (input.type === 'radio' && input.checked) {
            input.dataset.wasChecked = 'true';
        }

        input.addEventListener('click', function(e) {
            if (this.type === 'radio') {
                if (this.dataset.wasChecked === 'true') {
                    // DESMARCAR RADIO
                    this.checked = false;
                    this.dataset.wasChecked = 'false';
                    this.parentElement.classList.remove('checked');
                } else {
                    // MARCAR RADIO Y LIMPIAR HERMANOS
                    const name = this.getAttribute('name');
                    document.querySelectorAll(`input[name="${name}"]`).forEach(r => {
                        r.dataset.wasChecked = 'false';
                        r.parentElement.classList.remove('checked');
                    });
                    this.dataset.wasChecked = 'true';
                    this.parentElement.classList.add('checked');
                }
            }
        });

        input.addEventListener('change', function() {
            if (this.type === 'checkbox') {
                const label = this.closest('.pill-label');
                if (this.checked) {
                    label.classList.add('checked');
                } else {
                    label.classList.remove('checked');
                }
            }
        });
    });

    // 3. View toggle
    function setView(mode) {
        const grid = document.getElementById('propertiesGrid');
        const btnGrid = document.getElementById('btnGrid');
        const btnList = document.getElementById('btnList');
        if (!grid) return;

        if (mode === 'list') {
            grid.classList.add('list-view');
            if(btnList) btnList.classList.add('active');
            if(btnGrid) btnGrid.classList.remove('active');
        } else {
            grid.classList.remove('list-view');
            if(btnGrid) btnGrid.classList.add('active');
            if(btnList) btnList.classList.remove('active');
        }
        localStorage.setItem('ctpView', mode);
    }

    const savedView = localStorage.getItem('ctpView');
    if (savedView) setView(savedView);

    // 4. Ordenamiento
    function applySort(value) {
        const url = new URL(window.location.href);
        url.searchParams.set('orden', value);
        url.searchParams.delete('page');
        window.location.href = url.toString();
    }

    // 5. Eliminar un filtro específico
    function removeFilter(key, value = null) {
        const url = new URL(window.location.href);
        if (value !== null) {
            const params = url.searchParams.getAll(key);
            url.searchParams.delete(key);
            params.forEach(val => {
                if (val != value) url.searchParams.append(key, val);
            });
        } else {
            url.searchParams.delete(key);
        }
        url.searchParams.delete('page');
        window.location.href = url.toString();
    }

    // 6. Resetear filtros
    function resetFilters() {
        window.location.href = window.location.pathname;
    }

    // 7. Mobile filters
    function toggleMobileFilters() {
        const sidebar = document.getElementById('filterSidebar');
        if (sidebar) {
            sidebar.classList.toggle('mobile-open');
            sidebar.style.display = sidebar.classList.contains('mobile-open') ? 'block' : '';
        }
    }

    // 8. Favorite toggle
    function toggleFav(e, id) {
        e.preventDefault();
        const btn = e.currentTarget;
        btn.classList.toggle('active');
        btn.textContent = btn.classList.contains('active') ? '♥' : '♡';
    }
    </script>
</body>
</html>