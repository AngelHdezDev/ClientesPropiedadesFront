{{-- ===== PANEL MÓVIL ===== --}}
<div class="mobile-filters-panel" id="mobileFiltersPanel">

    <div class="mobile-filters-header">
        <h3>Filtros</h3>
        <button class="mobile-filters-close" onclick="toggleMobileMenu()">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <div class="mobile-filters-content">
        {{-- Marca y modelo --}}
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
                                <img src="{{ config('app.admin_storage') . $marca->imagen }}" alt="{{ $marca->nombre }}"
                                    onerror="this.style.display='none'">
                                <span>{{ $marca->nombre }}</span>
                                <i class="bi bi-chevron-down"></i>
                            </div>

                            <div class="mobile-modelos-list">
                                {{-- Integración de los modelos con su respectivo contador --}}
                                @foreach($marca->autos->take(5) as $autoAgrupado)
                                                        <a href="{{ route('autos.index', [
                                        'marcas[]' => $marca->id_marca,
                                        'modelos[]' => $autoAgrupado->modelo
                                    ]) }}">
                                                            {{ $autoAgrupado->modelo }}
                                                            <span class="modelo-count" style="font-size: 0.8rem; opacity: 0.7;">
                                                                ({{ $autoAgrupado->total }})
                                                            </span>
                                                        </a>
                                @endforeach

                                {{-- Enlace "Ver todos" ajustado a la ruta correcta --}}
                                <a href="{{ route('autos.index', ['marcas[]' => $marca->id_marca]) }}"
                                    style="color:var(--dalton-blue); font-weight:700; border-top: 1px solid rgba(0,0,0,0.05); margin-top: 5px; padding-top: 10px;">
                                    Ver todos <i class="bi bi-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('autos.index') }}" class="mobile-ver-todos">Ver todas las marcas</a>
            </div>
        </div>

        {{-- Tipo de auto --}}
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

        {{-- Año --}}
        <div class="mobile-filter-group">
            <div class="mobile-filter-group-header" onclick="toggleMobileSubmenu(this)">
                <span>Año</span>
                <i class="bi bi-chevron-down"></i>
            </div>
            <div class="mobile-filter-submenu">
                @php
                    $currentYear = date('Y');
                    // Generamos el rango de años dinámicamente como en el desktop
                    $years = range($currentYear, $currentYear - 10);
                @endphp

                @foreach($years as $year)
                    <label class="mobile-radio">
                        <input type="radio" name="anios[]" value="{{ $year }}"
                            onchange="window.location.href='{{ route('autos.index') }}?years[]={{ $year }}'">
                        {{ $year }}
                    </label>
                @endforeach

                {{-- Opción para restablecer o ver todos --}}
                <a href="{{ route('autos.index') }}"
                    style="display: block; padding: 10px 0; color: var(--blue); font-weight: 600; text-decoration: none; font-size: 0.9rem;">
                    Ver todos <i class="bi bi-chevron-right"></i>
                </a>
            </div>
        </div>
        {{-- Precio --}}
        <div class="mobile-filter-group">
            <div class="mobile-filter-group-header" onclick="toggleMobileSubmenu(this)">
                <span>Precio</span>
                <i class="bi bi-chevron-down"></i>
            </div>
            <div class="mobile-filter-submenu">
                <div class="mobile-price-range">
                    {{-- Inputs manuales existentes --}}
                    {{-- Presets dinámicos con la lógica de escritorio --}}
                    <div class="mobile-price-presets"
                        style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-top: 15px;">
                        @php
                            $rangos = [
                                ['min' => 100000, 'max' => 200000, 'label' => '$100k - 200k'],
                                ['min' => 200000, 'max' => 300000, 'label' => '$200k - 300k'],
                                ['min' => 300000, 'max' => 400000, 'label' => '$300k - 400k'],
                                ['min' => 400000, 'max' => 500000, 'label' => '$400k - 500k'],
                                ['min' => 500000, 'max' => 600000, 'label' => '$500k - 600k'],
                                ['min' => 1000000, 'max' => 9999999, 'label' => '$1M+'],
                            ];
                        @endphp

                        @foreach($rangos as $rango)
                            <button type="button" class="price-preset"
                                onclick="window.location.href='{{ route('autos.index', ['price_min' => $rango['min'], 'price_max' => $rango['max']]) }}'"
                                style="padding: 8px; font-size: 0.8rem; border-radius: 8px; border: 1px solid #eee; background: #fff;">
                                {{ $rango['label'] }}
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Enlace Ver todos --}}
                <a href="{{ route('autos.index') }}"
                    style="display: block; padding: 15px 0 5px; color: var(--blue); font-weight: 600; text-decoration: none; font-size: 0.9rem;">
                    Ver todos los precios <i class="bi bi-chevron-right"></i>
                </a>
            </div>
        </div>


    </div>
</div>

{{-- Backdrops --}}
<div class="dropdown-backdrop" id="dropdownBackdrop" onclick="closeDropdown()"></div>
<div class="mobile-backdrop" id="mobileBackdrop" onclick="toggleMobileMenu()"></div>