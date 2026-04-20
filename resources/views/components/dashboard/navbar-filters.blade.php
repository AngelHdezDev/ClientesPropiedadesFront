{{-- ===== NAVBAR FILTERS ===== --}}
<nav class="navbar-filters">

    {{-- Filtros desktop --}}
    <div class="filter-links desktop-only">
        <a href="#" class="filter-link" onclick="toggleMarcaDropdown(this); return false;">
            Marca y modelo <i class="bi bi-chevron-down" style="font-size:0.7rem"></i>
        </a>
        <a href="#" class="filter-link">
            Tipo de auto <i class="bi bi-chevron-down" style="font-size:0.7rem"></i>
        </a>
        <a href="#" class="filter-link" onclick="toggleAñoDropdown(this); return false;">
            Año <i class="bi bi-chevron-down" style="font-size:0.7rem"></i>
        </a>
        <a href="#" class="filter-link" onclick="togglePrecioDropdown(); return false;">
            Precio <i class="bi bi-chevron-down" style="font-size:0.7rem"></i>
        </a>
    </div>


    {{-- Dropdown desktop --}}
    <div class="marca-dropdown" id="marcaDropdown">

        <div class="marca-dropdown-inner">

            <button class="nav-arrow prev" id="prevBtn" onclick="moveSlider(-1)" disabled>
                <i class="bi bi-chevron-left"></i>
            </button>

            <div class="slider-window">
                <div class="slider-track" id="marcaSlider">
                    @foreach($marcas as $marca)
                                        <div class="marca-col">
                                            <div class="marca-col-header">
                                                <img src="{{ config('app.admin_storage') . $marca->imagen }}" alt="{{ $marca->nombre }}"
                                                    onerror="this.style.display='none'">
                                                <span class="marca-col-name">{{ $marca->nombre }}</span>
                                            </div>
                                            <ul class="modelo-list">
                                                @foreach($marca->autos->take(5) as $autoAgrupado)
                                                                        <li>
                                                                            <a href="{{ route('autos.index', [
                                                        'marcas[]' => $marca->id_marca,
                                                        'modelos[]' => $autoAgrupado->modelo
                                                    ]) }}">
                                                                                {{ $autoAgrupado->modelo }}
                                                                            </a>
                                                                            <span class="modelo-count">({{ $autoAgrupado->total }})</span>
                                                                        </li>
                                                @endforeach
                                            </ul>
                                            {{-- Enlace "Ver todos" solo con filtro de marca --}}
                                            <a href="{{ route('autos.index', [
                            'marcas[]' => $marca->id_marca
                        ]) }}" class="ver-todos-modelo">
                                                Ver todos <i class="bi bi-chevron-right"></i>
                                            </a>
                                        </div>
                    @endforeach
                </div>
            </div>

            <button class="nav-arrow next" id="nextBtn" onclick="moveSlider(1)">
                <i class="bi bi-chevron-right"></i>
            </button>

        </div>

        <div class="slider-pagination" id="sliderPagination"></div>

    </div>

    {{-- Dropdown de Año (Estilo Popover) --}}
    <div class="marca-dropdown" id="añoDropdown">
        <div class="year-grid">
            @php
                $currentYear = date('Y');
                $years = range($currentYear, $currentYear - 10);
            @endphp

            @foreach($years as $year)
                <a href="{{ route('autos.index', ['years[]' => $year]) }}" class="year-pill">
                    {{ $year }}
                </a>
            @endforeach

            <a href="{{ route('autos.index') }}" class="year-view-all">
                Ver todos <i class="bi bi-chevron-right"></i>
            </a>
        </div>
    </div>


    <div class="marca-dropdown" id="precioDropdown">

        <p class="precio-dropdown-label">Precio de contado:</p>

        <div class="precio-grid">
            @php
                $rangos = [
                    ['min' => 100000, 'max' => 200000, 'label' => '$100,000 - 200,000'],
                    ['min' => 200000, 'max' => 300000, 'label' => '$200,000 - 300,000'],
                    ['min' => 300000, 'max' => 400000, 'label' => '$300,000 - 400,000'],
                    ['min' => 400000, 'max' => 500000, 'label' => '$400,000 - 500,000'],
                    ['min' => 500000, 'max' => 600000, 'label' => '$500,000 - 600,000'],
                    ['min' => 600000, 'max' => 700000, 'label' => '$600,000 - 700,000'],
                    ['min' => 700000, 'max' => 800000, 'label' => '$700,000 - 800,000'],
                    ['min' => 800000, 'max' => 900000, 'label' => '$800,000 - 900,000'],
                    ['min' => 1000000, 'max' => 9999999, 'label' => '$1,000,000 y más'],
                ];
            @endphp

            @foreach($rangos as $rango)
                        <a href="{{ route('autos.index', [
                    'price_min' => $rango['min'],
                    'price_max' => $rango['max']
                ]) }}" class="precio-pill">
                            {{ $rango['label'] }}
                        </a>
            @endforeach
        </div>

        <a href="{{ route('autos.index') }}" class="precio-view-all">
            Ver todos <i class="bi bi-chevron-right"></i>
        </a>

    </div>


</nav>

{{-- Panel móvil + backdrops --}}
@include('Dashboard.partials._navbarMobile')