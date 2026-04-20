@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/catalog.css') }}" rel="stylesheet">
@endpush

@section('content')
    @include('Dashboard.partials._navbarTop')
    <x-dashboard.navbar-filters />
    @include('catalog.partials._search_bar')
    @include('catalog.partials._brands')

    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeMobileSidebar()"></div>

    <div class="catalog-layout">

        @include('catalog.partials._filter_offers')

        <main class="catalog-main">
            @include('catalog.partials._toolbar')
            <div class="active-filters-container d-flex align-items-center gap-2 mb-3">
                <div id="activeFiltersList" class="d-flex flex-wrap gap-2"></div>
                <button id="btnResetFilters" onclick="clearAllFilters()" class="btn btn-link text-danger p-0"
                    style="display:none; font-size: 13px;">
                    Reiniciar filtros
                </button>
            </div>
            <div id="carsGridContainer">
                @include('catalog.partials._cars_grid')
            </div>
        </main>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/catalog.js') }}"></script>
@endpush