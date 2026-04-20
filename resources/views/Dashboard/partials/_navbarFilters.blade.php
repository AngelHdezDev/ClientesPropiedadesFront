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
        <a href="#" class="filter-link">
            Año <i class="bi bi-chevron-down" style="font-size:0.7rem"></i>
        </a>
        <a href="#" class="filter-link">
            Precio <i class="bi bi-chevron-down" style="font-size:0.7rem"></i>
        </a>
        <a href="#" class="filter-link">
            Ubicación <i class="bi bi-chevron-down" style="font-size:0.7rem"></i>
        </a>
    </div>

    <span class="referral-text">¡Refiere a tus amigos y gana $5,000!</span>

    {{-- Dropdown desktop --}}
    <div class="marca-dropdown" id="marcaDropdown">

        {{-- Slider + flechas --}}
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
                                        {{-- Enviamos marca y modelo como array para que el filtro lo reconozca --}}
                                        <a
                                            href="{{ route('autos', ['marcas[]' => $marca->id_marca, 'modelos[]' => $autoAgrupado->modelo]) }}">
                                            {{ $autoAgrupado->modelo }}
                                        </a>
                                        <span class="modelo-count">({{ $autoAgrupado->total }})</span>
                                    </li>
                                @endforeach
                            </ul>

                            {{-- Enlace para ver todos los de una marca específica --}}
                            {{-- Cambia el href del bucle de modelos --}}
                            <a
                                href="{{ route('/autos', ['marca' => $marca->nombre, 'modelo' => $autoAgrupado->modelo]) }}">
                                {{ $autoAgrupado->modelo }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <button class="nav-arrow next" id="nextBtn" onclick="moveSlider(1)">
                <i class="bi bi-chevron-right"></i>
            </button>

        </div>

        {{-- Paginación pegada al borde inferior --}}
        <div class="slider-pagination" id="sliderPagination"></div>

    </div>

</nav>

{{-- Panel móvil + backdrops --}}
@include('Dashboard.partials._navbarMobile')