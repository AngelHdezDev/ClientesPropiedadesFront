<div class="catalog-toolbar">
    <button class="btn-toggle-filters" id="toggleFiltersBtn" onclick="toggleFilters()">
        Ocultar filtros <i class="bi bi-sliders"></i>
    </button>
    <div class="sort-wrap">
        <span>Ordenar por:</span>
        <div class="sort-dropdown-wrap">
            <button class="sort-btn" onclick="toggleSort()">
                @if(request('sort') == 'price_asc') Menor precio
                @elseif(request('sort') == 'price_desc') Mayor precio
                @else Más nuevos
                @endif
                <i class="bi bi-chevron-down" style="font-size:0.75rem"></i>
            </button>
            <div class="sort-dropdown" id="sortDropdown">
                <div class="sort-dropdown-label">Ordenar por</div>

                <div class="sort-option {{ request('sort') == 'price_asc' ? 'active' : '' }}"
                    onclick="selectSort(this, 'price_asc')">Menor precio</div>

                <div class="sort-option {{ request('sort') == 'price_desc' ? 'active' : '' }}"
                    onclick="selectSort(this, 'price_desc')">Mayor precio</div>

                <div class="sort-option {{ request('sort') == 'latest' || !request('sort') ? 'active' : '' }}"
                    onclick="selectSort(this, 'latest')">Más nuevos</div>
            </div>
        </div>
    </div>
</div>