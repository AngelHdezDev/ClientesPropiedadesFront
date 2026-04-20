@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

<nav class="navbar-top">
    <button class="btn-mobile-menu" onclick="toggleMobileMenu()">
        <i class="bi bi-list"></i>
    </button>

    <a href="/dashboard" class="logo">
        <svg width="28" height="28" viewBox="0 0 28 28" fill="none">
            <path d="M7 21 C7 13 13 5 21 5" stroke="#e8001c" stroke-width="3" stroke-linecap="round" />
            <circle cx="21" cy="5" r="4" fill="#e8001c" />
        </svg>
        <span class="logo-text">CarAdmin<span> C&C</span></span>
    </a>

</nav>

@push('scripts')
    <script src="{{ asset('js/partials/navbar.js') }}"></script>
@endpush