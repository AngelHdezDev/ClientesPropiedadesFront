@extends('layouts.app')

@section('title', 'Autos - VMS')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
    <!-- ===== TOP NAVBAR ===== -->
    @include('Dashboard.partials._navbarTop')
    <!-- ===== NAVBAR Filter ===== -->
    <x-dashboard.navbar-filters />

    <!-- ===== HERO ===== -->
    @include('Dashboard.partials._hero')

    <!-- ===== TIPO DE AUTO — SVGs inline, sin imágenes externas, sin layout shift ===== -->
    @include('Dashboard.partials._typeCars')
    <div class="section-divider"></div>

    <!-- ===== TU AUTO SEGÚN TU NECESIDAD ===== -->
    @include('Dashboard.partials._carNeeds')
    <div class="section-divider"></div>

    <!-- ===== TENEMOS TU MARCA FAVORITA ===== -->
    <x-dashboard.favorite-brands />
    <!-- ===== HERRAMIENTAS DE COMPRA ===== -->
    <!-- @include('Dashboard.partials._herramientasSection') -->
    <!-- ===== REFERRAL BANNER ===== -->
    <!-- @include('Dashboard.partials._referralBanner') -->
    <!-- ===== NUESTRAS UBICACIONES ===== -->
    @include('Dashboard.partials._ubications')
    <!-- ===== TESTIMONIALES ===== -->
    @include('Dashboard.partials._testimonial')

    <div class="section-divider"></div>

    <!-- ===== CATÁLOGO DE MARCAS ===== -->
    <x-dashboard.brand-catalog />
    <!-- ===== FOOTER ===== -->
    @include('Dashboard.partials._footer')
    <!-- ===== COOKIE BANNER ===== -->
    <div class="cookie-banner" id="cookieBanner">
        <p>🍪 <a href="#">Aviso de Cookies</a> Utilizamos cookies para brindarte la mejor experiencia en nuestro sitio web.
            Si continúas usando nuestro sitio web, acepta el uso de cookies en <a href="#">Aviso de privacidad</a></p>
        <button class="btn-aceptar" onclick="document.getElementById('cookieBanner').style.display='none'">Aceptar</button>
    </div>

@endsection

