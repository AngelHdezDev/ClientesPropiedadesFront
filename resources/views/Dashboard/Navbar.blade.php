<!-- Navbar filters - sticky -->
<nav class="navbar-filters">

    <!-- Filtros desktop -->
    <div class="filter-links desktop-only">
        <a href="#" class="filter-link" onclick="toggleMarcaDropdown(this); return false;">
            Marca y modelo <i class="bi bi-chevron-down" style="font-size:0.7rem"></i>
        </a>
        <a href="#" class="filter-link">Tipo de auto <i class="bi bi-chevron-down" style="font-size:0.7rem"></i></a>
        <a href="#" class="filter-link">Año <i class="bi bi-chevron-down" style="font-size:0.7rem"></i></a>
        <a href="#" class="filter-link">Precio <i class="bi bi-chevron-down" style="font-size:0.7rem"></i></a>
        <a href="#" class="filter-link">Ubicación <i class="bi bi-chevron-down" style="font-size:0.7rem"></i></a>
    </div>

    <span class="referral-text">¡Refiere a tus amigos y gana $5,000!</span>

    <!-- Dropdown desktop — grid multi-fila, sin paginación -->
    <div class="marca-dropdown" id="marcaDropdown">
        <div class="marca-dropdown-inner">
            <div class="marca-cols">
                @foreach($marcas as $marca)
                    <div class="marca-col">
                        <div class="marca-col-header">
                            <img src="{{ config('app.admin_storage') . $marca->imagen }}"
                                 alt="{{ $marca->nombre }}"
                                 onerror="this.style.display='none'">
                            <span class="marca-col-name">{{ $marca->nombre }}</span>
                        </div>
                        <ul class="modelo-list">
                            @foreach($marca->autos as $autoAgrupado)
                                <li>
                                    <a href="{{ route('dashboard', ['marca' => $marca->nombre, 'modelo' => $autoAgrupado->modelo]) }}">
                                        {{ $autoAgrupado->modelo }}
                                    </a>
                                    <span class="modelo-count">({{ $autoAgrupado->total }})</span>
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('dashboard', ['marca' => $marca->nombre]) }}" class="ver-todos-modelo">
                            Ver todos <i class="bi bi-chevron-right" style="font-size:0.7rem"></i>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</nav>

<!-- Panel lateral de filtros para móvil -->
<div class="mobile-filters-panel" id="mobileFiltersPanel">
    <div class="mobile-filters-header">
        <h3>Filtros</h3>
        <button class="mobile-filters-close" onclick="toggleMobileMenu()">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>
    <div class="mobile-filters-content">

        <!-- Marca y modelo -->
        <div class="mobile-filter-group">
            <div class="mobile-filter-group-header" onclick="toggleMobileSubmenu(this)">
                <span>Marca y modelo</span>
                <i class="bi bi-chevron-down"></i>
            </div>
            <div class="mobile-filter-submenu">
                <div class="mobile-marca-list">
                    @foreach($marcas as $marca)
                        <div class="mobile-marca-item">
                            <div class="mobile-marca-header" onclick="toggleMobileModelos(this)">
                                <img src="{{ config('app.admin_storage') . $marca->imagen }}"
                                     alt="{{ $marca->nombre }}"
                                     onerror="this.style.display='none'">
                                <span>{{ $marca->nombre }}</span>
                                <i class="bi bi-chevron-down"></i>
                            </div>
                            <div class="mobile-modelos-list">
                                @foreach($marca->autos as $autoAgrupado)
                                    <a href="{{ route('dashboard', ['marca' => $marca->nombre, 'modelo' => $autoAgrupado->modelo]) }}">
                                        {{ $autoAgrupado->modelo }} ({{ $autoAgrupado->total }})
                                    </a>
                                @endforeach
                                <a href="{{ route('dashboard', ['marca' => $marca->nombre]) }}"
                                   style="color:var(--dalton-blue);font-weight:700;">
                                    Ver todos →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('dashboard') }}" class="mobile-ver-todos">Ver todas las marcas</a>
            </div>
        </div>

        <!-- Tipo de auto -->
        <div class="mobile-filter-group">
            <div class="mobile-filter-group-header" onclick="toggleMobileSubmenu(this)">
                <span>Tipo de auto</span>
                <i class="bi bi-chevron-down"></i>
            </div>
            <div class="mobile-filter-submenu">
                <label class="mobile-checkbox"><input type="checkbox"> SUV</label>
                <label class="mobile-checkbox"><input type="checkbox"> Sedán</label>
                <label class="mobile-checkbox"><input type="checkbox"> Hatchback</label>
                <label class="mobile-checkbox"><input type="checkbox"> Pickup</label>
                <label class="mobile-checkbox"><input type="checkbox"> Coupé</label>
                <label class="mobile-checkbox"><input type="checkbox"> Convertible</label>
            </div>
        </div>

        <!-- Año -->
        <div class="mobile-filter-group">
            <div class="mobile-filter-group-header" onclick="toggleMobileSubmenu(this)">
                <span>Año</span>
                <i class="bi bi-chevron-down"></i>
            </div>
            <div class="mobile-filter-submenu">
                <label class="mobile-radio"><input type="radio" name="year"> 2024</label>
                <label class="mobile-radio"><input type="radio" name="year"> 2023</label>
                <label class="mobile-radio"><input type="radio" name="year"> 2022</label>
                <label class="mobile-radio"><input type="radio" name="year"> 2021</label>
                <label class="mobile-radio"><input type="radio" name="year"> 2020</label>
                <label class="mobile-radio"><input type="radio" name="year"> 2019</label>
            </div>
        </div>

        <!-- Precio -->
        <div class="mobile-filter-group">
            <div class="mobile-filter-group-header" onclick="toggleMobileSubmenu(this)">
                <span>Precio</span>
                <i class="bi bi-chevron-down"></i>
            </div>
            <div class="mobile-filter-submenu">
                <div class="mobile-price-range">
                    <input type="range" min="0" max="1000000" step="10000" value="500000">
                    <div class="mobile-price-inputs">
                        <input type="number" placeholder="Mín" value="0">
                        <input type="number" placeholder="Máx" value="1000000">
                    </div>
                    <div class="mobile-price-presets">
                        <button class="price-preset">$0 - $200k</button>
                        <button class="price-preset">$200k - $400k</button>
                        <button class="price-preset">$400k - $600k</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ubicación -->
        <div class="mobile-filter-group">
            <div class="mobile-filter-group-header" onclick="toggleMobileSubmenu(this)">
                <span>Ubicación</span>
                <i class="bi bi-chevron-down"></i>
            </div>
            <div class="mobile-filter-submenu">
                <select class="mobile-select">
                    <option>Todas las ubicaciones</option>
                    <option>Ciudad de México</option>
                    <option>Monterrey</option>
                    <option>Guadalajara</option>
                    <option>Puebla</option>
                    <option>Querétaro</option>
                </select>
            </div>
        </div>

    </div>
    <div class="mobile-filters-footer">
        <button class="mobile-btn mobile-btn-outline" onclick="clearMobileFilters()">Limpiar</button>
        <button class="mobile-btn mobile-btn-primary" onclick="applyMobileFilters()">Aplicar</button>
    </div>
</div>

<!-- Backdrops -->
<div class="dropdown-backdrop" id="dropdownBackdrop" onclick="closeDropdown()"></div>
<div class="mobile-backdrop"   id="mobileBackdrop"   onclick="toggleMobileMenu()"></div>


<style>
/* =============================================
   NAVBAR FILTERS
   ============================================= */
.navbar-filters {
    background: white;
    border-bottom: 1px solid var(--dalton-border);
    padding: 0 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
    top: 52px;
    z-index: 1000;
    width: 100%;
}

.desktop-only {
    display: flex;
    flex: 1;
    margin-right: 20px;
}

.filter-link {
    padding: 14px 16px;
    font-size: 0.82rem;
    font-weight: 600;
    color: var(--dalton-text);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 5px;
    border-bottom: 2px solid transparent;
    transition: all 0.2s;
    white-space: nowrap;
    cursor: pointer;
}
.filter-link:hover {
    color: var(--dalton-red);
    border-bottom-color: var(--dalton-red);
}
.filter-link.active {
    color: var(--dalton-red) !important;
    border-bottom-color: var(--dalton-red) !important;
    background: none !important;
}

.referral-text {
    font-size: 0.78rem;
    font-weight: 700;
    white-space: nowrap;
    color: var(--dalton-text);
    flex-shrink: 0;
}

/* =============================================
   DROPDOWN DESKTOP — GRID MULTI-FILA
   ============================================= */
.marca-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border-radius: 0 0 16px 16px;
    box-shadow: 0 12px 40px rgba(0,0,0,0.12);
    border: 1px solid var(--dalton-border);
    border-top: none;
    z-index: 999;
    display: none;
}
.marca-dropdown.open {
    display: block;
    animation: slideDown 0.2s ease-out;
}
@keyframes slideDown {
    from { opacity: 0; transform: translateY(-8px); }
    to   { opacity: 1; transform: translateY(0); }
}

.marca-dropdown-inner {
    padding: 24px 32px 24px;
    /* scroll si hay muchas marcas */
    max-height: 75vh;
    overflow-y: auto;
}

/* Grid que fluye automáticamente en filas — SIN translateX, SIN paginación */
.marca-cols {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    border: 1.5px solid var(--dalton-border);
    border-radius: 14px;
    /* overflow visible para que fluya en múltiples filas */
    overflow: hidden;
}

.marca-col {
    padding: 18px 20px 16px;
    border-right: 1px solid var(--dalton-border);
    border-bottom: 1px solid var(--dalton-border);
}

/* Sin borde derecho en la 6ta columna de cada fila */
.marca-col:nth-child(6n) {
    border-right: none;
}

/* Sin borde inferior en los últimos 6 elementos (última fila) */
.marca-col:last-child,
.marca-col:nth-last-child(2),
.marca-col:nth-last-child(3),
.marca-col:nth-last-child(4),
.marca-col:nth-last-child(5),
.marca-col:nth-last-child(6) {
    border-bottom: none;
}

.marca-col-header {
    display: flex;
    align-items: center;
    gap: 8px;
    padding-bottom: 12px;
    margin-bottom: 12px;
    border-bottom: 1px solid var(--dalton-border);
}
.marca-col-header img {
    width: 32px;
    height: 24px;
    object-fit: contain;
}
.marca-col-name {
    font-size: 0.9rem;
    font-weight: 800;
}

.modelo-list {
    list-style: none;
    padding: 0;
    margin: 0 0 12px;
}
.modelo-list li {
    padding: 5px 0;
    display: flex;
    align-items: baseline;
    gap: 4px;
}
.modelo-list a {
    font-size: 0.82rem;
    font-weight: 600;
    color: var(--dalton-text);
    text-decoration: none;
    transition: color 0.15s;
}
.modelo-list a:hover { color: var(--dalton-blue); }

.modelo-count {
    font-size: 0.75rem;
    color: var(--dalton-muted);
    white-space: nowrap;
}

.ver-todos-modelo {
    font-size: 0.8rem;
    font-weight: 700;
    color: var(--dalton-blue);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}
.ver-todos-modelo:hover { text-decoration: underline; }

/* Backdrops */
.dropdown-backdrop {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.3);
    z-index: 998;
}
.dropdown-backdrop.open { display: block; }

/* =============================================
   PANEL MÓVIL
   ============================================= */
.mobile-filters-panel {
    position: fixed;
    top: 0;
    right: -100%;
    width: 85%;
    max-width: 400px;
    height: 100vh;
    background: white;
    z-index: 1002;
    transition: right 0.3s ease-in-out;
    display: flex;
    flex-direction: column;
    box-shadow: -2px 0 10px rgba(0,0,0,0.12);
}
.mobile-filters-panel.open { right: 0; }

.mobile-filters-header {
    padding: 20px;
    border-bottom: 1px solid var(--dalton-border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-shrink: 0;
}
.mobile-filters-header h3 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 800;
}
.mobile-filters-close {
    background: none;
    border: none;
    font-size: 1.3rem;
    cursor: pointer;
    color: var(--dalton-text);
    padding: 4px;
}

.mobile-filters-content {
    flex: 1;
    overflow-y: auto;
    padding: 16px;
}

.mobile-filter-group {
    margin-bottom: 10px;
    border: 1px solid var(--dalton-border);
    border-radius: 10px;
    overflow: hidden;
}
.mobile-filter-group-header {
    padding: 14px 16px;
    background: #f8f9fa;
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    font-weight: 600;
    font-size: 0.9rem;
    transition: background 0.15s;
}
.mobile-filter-group-header:hover { background: #e9ecef; }
.mobile-filter-group-header i { transition: transform 0.25s; font-size: 0.8rem; }
.mobile-filter-group-header.active i { transform: rotate(180deg); }

.mobile-filter-submenu {
    display: none;
    padding: 14px 16px;
    background: white;
    border-top: 1px solid var(--dalton-border);
}
.mobile-filter-submenu.open { display: block; }

/* Marcas acordeón */
.mobile-marca-list { max-height: 340px; overflow-y: auto; }
.mobile-marca-item { margin-bottom: 6px; }

.mobile-marca-header {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    background: #f8f9fa;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    font-size: 0.87rem;
}
.mobile-marca-header img {
    width: 24px;
    height: 18px;
    object-fit: contain;
    flex-shrink: 0;
}
.mobile-marca-header i {
    margin-left: auto;
    transition: transform 0.25s;
    font-size: 0.72rem;
    color: var(--dalton-muted);
}
.mobile-marca-header.active i { transform: rotate(180deg); }

.mobile-modelos-list {
    display: none;
    padding: 4px 10px 8px 46px;
}
.mobile-modelos-list.open { display: block; }
.mobile-modelos-list a {
    display: block;
    padding: 7px 0;
    color: var(--dalton-text);
    text-decoration: none;
    font-size: 0.84rem;
    border-bottom: 1px solid var(--dalton-border);
    transition: color 0.15s;
}
.mobile-modelos-list a:last-child { border-bottom: none; }
.mobile-modelos-list a:hover { color: var(--dalton-blue); }

.mobile-ver-todos {
    display: block;
    padding: 10px;
    text-align: center;
    color: var(--dalton-blue);
    text-decoration: none;
    font-weight: 700;
    font-size: 0.85rem;
    margin-top: 6px;
}

/* Checkboxes y radios */
.mobile-checkbox, .mobile-radio {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 0;
    cursor: pointer;
    font-size: 0.87rem;
}
.mobile-checkbox input, .mobile-radio input {
    width: 18px;
    height: 18px;
    cursor: pointer;
    flex-shrink: 0;
}

/* Precio */
.mobile-price-range { padding: 6px 0; }
.mobile-price-range input[type=range] { width: 100%; margin-bottom: 12px; }
.mobile-price-inputs { display: flex; gap: 10px; margin-bottom: 12px; }
.mobile-price-inputs input {
    flex: 1;
    padding: 8px 10px;
    border: 1px solid var(--dalton-border);
    border-radius: 6px;
    font-family: 'Manrope', sans-serif;
    font-size: 0.85rem;
}
.mobile-price-presets { display: flex; flex-wrap: wrap; gap: 8px; }
.price-preset {
    flex: 1 1 calc(33.33% - 8px);
    padding: 8px;
    background: #f8f9fa;
    border: 1px solid var(--dalton-border);
    border-radius: 6px;
    font-size: 0.76rem;
    cursor: pointer;
    transition: background 0.15s;
    font-family: 'Manrope', sans-serif;
}
.price-preset:hover { background: #e9ecef; }

/* Select ubicación */
.mobile-select {
    width: 100%;
    padding: 11px 12px;
    border: 1px solid var(--dalton-border);
    border-radius: 8px;
    background: white;
    font-size: 0.87rem;
    font-family: 'Manrope', sans-serif;
}

/* Footer del panel */
.mobile-filters-footer {
    padding: 16px 20px;
    border-top: 1px solid var(--dalton-border);
    display: flex;
    gap: 10px;
    flex-shrink: 0;
}
.mobile-btn {
    flex: 1;
    padding: 13px;
    border: none;
    border-radius: 8px;
    font-weight: 700;
    cursor: pointer;
    font-size: 0.9rem;
    font-family: 'Manrope', sans-serif;
    transition: all 0.15s;
}
.mobile-btn-primary { background: var(--dalton-red); color: white; }
.mobile-btn-primary:hover { background: #c8001a; }
.mobile-btn-outline {
    background: white;
    border: 1.5px solid var(--dalton-border);
    color: var(--dalton-text);
}
.mobile-btn-outline:hover { background: #f8f9fa; }

.mobile-backdrop {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.5);
    z-index: 1001;
}
.mobile-backdrop.open { display: block; }

/* =============================================
   RESPONSIVE
   ============================================= */

/* Tablet — 3 columnas */
@media screen and (max-width: 1200px) {
    .marca-cols { grid-template-columns: repeat(3, 1fr); }

    /* Resetear bordes de 6 columnas */
    .marca-col:nth-child(6n) { border-right: 1px solid var(--dalton-border); }
    .marca-col:nth-last-child(-n+6) { border-bottom: 1px solid var(--dalton-border); }

    /* Aplicar bordes para 3 columnas */
    .marca-col:nth-child(3n) { border-right: none; }
    .marca-col:last-child,
    .marca-col:nth-last-child(2),
    .marca-col:nth-last-child(3) { border-bottom: none; }

    .marca-dropdown-inner { padding: 20px 24px; }
}

@media screen and (max-width: 992px) {
    .navbar-filters { padding: 0 16px; }
    .referral-text { font-size: 0.7rem; max-width: 140px; text-align: right; }
}

/* Mobile — ocultar filtros desktop, mostrar panel hamburguesa */
@media screen and (max-width: 768px) {
    .navbar-filters { top: 0; padding: 0 16px; display: none; }
    .dropdown-backdrop { display: none !important; }
    .marca-dropdown   { display: none !important; }
}

@media screen and (max-width: 576px) {
    .mobile-filters-panel { width: 90%; }
}
:root {
            --dalton-red: #e30613;
            --dalton-blue: #0056b3;
            --dalton-text: #333;
            --dalton-muted: #888;
            --dalton-border: #e0e0e0;
        }

        body { font-family: 'Manrope', sans-serif; margin: 0; background: #f4f4f4; }

        /* NAVBAR FILTERS */
        .navbar-filters {
            background: white;
            border-bottom: 1px solid var(--dalton-border);
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1000;
            height: 60px;
        }

        .filter-links { display: flex; gap: 10px; }
        
        .filter-link {
            padding: 10px 15px;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--dalton-text);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: 0.2s;
        }

        .filter-link:hover, .filter-link.active { color: var(--dalton-red); }

        /* DROPDOWN CAROUSEL */
        .marca-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            display: none;
            z-index: 1001;
            border-bottom: 2px solid var(--dalton-red);
        }

        .marca-dropdown.open { display: block; animation: fadeIn 0.3s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }

        .marca-dropdown-inner {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 60px;
            position: relative;
        }

        /* Viewport & Slider */
        .marca-carousel-viewport {
            width: 100%;
            overflow: hidden;
            border: 1px solid var(--dalton-border);
            border-radius: 12px;
        }

        .marca-slider {
            display: flex;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .marca-col {
            flex: 0 0 16.6666%; /* 6 columnas exactas */
            min-width: 16.6666%;
            padding: 25px;
            box-sizing: border-box;
            border-right: 1px solid #f0f0f0;
            background: white;
        }

        .marca-col-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
            padding-bottom: 12px;
            border-bottom: 1px solid #eee;
        }

        .marca-col-header img { width: 32px; height: auto; object-fit: contain; }
        .marca-col-name { font-weight: 800; font-size: 0.95rem; }

        .modelo-list { list-style: none; padding: 0; margin: 0 0 15px; }
        .modelo-list li { margin-bottom: 8px; display: flex; justify-content: space-between; }
        .modelo-list a { font-size: 0.85rem; color: #555; text-decoration: none; font-weight: 600; }
        .modelo-list a:hover { color: var(--dalton-red); }
        .modelo-count { font-size: 0.8rem; color: #bbb; }

        .ver-todos-link {
            font-size: 0.8rem;
            font-weight: 800;
            color: var(--dalton-blue);
            text-decoration: none;
            margin-top: auto;
        }

        /* CONTROLES */
        .nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 1px solid #ddd;
            background: white;
            cursor: pointer;
            z-index: 10;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .nav-btn:hover { background: #f8f8f8; border-color: #999; }
        .nav-btn.prev { left: 10px; }
        .nav-btn.next { right: 10px; }
        .nav-btn:disabled { opacity: 0; pointer-events: none; }

        .carousel-dots {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 25px;
        }
        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #ddd;
            cursor: pointer;
            transition: 0.3s;
        }
        .dot.active { background: var(--dalton-red); width: 25px; border-radius: 5px; }

        .dropdown-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.2);
            z-index: 999;
        }
        .dropdown-backdrop.open { display: block; }
</style>


<script>
/* =============================================
   DROPDOWN DESKTOP
   ============================================= */
function toggleMarcaDropdown(btn) {
    if (window.innerWidth <= 768) {
        toggleMobileMenu();
        return;
    }

    const dropdown = document.getElementById('marcaDropdown');
    const backdrop = document.getElementById('dropdownBackdrop');
    const isOpen   = dropdown.classList.contains('open');

    closeDropdown();

    if (!isOpen) {
        dropdown.classList.add('open');
        backdrop.classList.add('open');
        btn.classList.add('active');
        const icon = btn.querySelector('i');
        if (icon) { icon.className = 'bi bi-chevron-up'; icon.style.fontSize = '0.7rem'; }
    }
}

function closeDropdown() {
    const dropdown = document.getElementById('marcaDropdown');
    const backdrop = document.getElementById('dropdownBackdrop');
    if (!dropdown) return;

    dropdown.classList.remove('open');
    backdrop.classList.remove('open');

    document.querySelectorAll('.filter-link').forEach(b => {
        b.classList.remove('active');
        const icon = b.querySelector('i');
        if (icon) { icon.className = 'bi bi-chevron-down'; icon.style.fontSize = '0.7rem'; }
    });
}

/* =============================================
   PANEL MÓVIL
   ============================================= */
function toggleMobileMenu() {
    const panel   = document.getElementById('mobileFiltersPanel');
    const backdrop = document.getElementById('mobileBackdrop');
    panel.classList.toggle('open');
    backdrop.classList.toggle('open');
    document.body.style.overflow = panel.classList.contains('open') ? 'hidden' : '';
}

function toggleMobileSubmenu(header) {
    header.classList.toggle('active');
    header.nextElementSibling.classList.toggle('open');
}

function toggleMobileModelos(header) {
    header.classList.toggle('active');
    header.nextElementSibling.classList.toggle('open');
}

function clearMobileFilters() {
    document.querySelectorAll('.mobile-filters-panel input[type="checkbox"], .mobile-filters-panel input[type="radio"]')
        .forEach(i => i.checked = false);
    document.querySelectorAll('.mobile-filters-panel input[type="range"]')
        .forEach(i => i.value = i.min || 0);
    document.querySelectorAll('.mobile-filters-panel input[type="number"]')
        .forEach(i => i.value = '');
}

function applyMobileFilters() {
    toggleMobileMenu();
}

/* Cerrar con Escape */
document.addEventListener('keydown', e => {
    if (e.key !== 'Escape') return;
    closeDropdown();
    const panel = document.getElementById('mobileFiltersPanel');
    if (panel && panel.classList.contains('open')) toggleMobileMenu();
});

/* Al agrandar ventana, cerrar panel móvil */
window.addEventListener('resize', () => {
    if (window.innerWidth > 768) {
        const panel   = document.getElementById('mobileFiltersPanel');
        const backdrop = document.getElementById('mobileBackdrop');
        if (panel && panel.classList.contains('open')) {
            panel.classList.remove('open');
            backdrop.classList.remove('open');
            document.body.style.overflow = '';
        }
    }
});
</script>