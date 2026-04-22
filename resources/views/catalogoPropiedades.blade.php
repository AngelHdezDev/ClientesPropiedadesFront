@extends('layouts.app')

@section('title', 'CTP Realty | Constructora y Bienes Raíces en Guadalajara')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/catalogoPropiedades.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
@endpush

@section('content')

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


@endsection


