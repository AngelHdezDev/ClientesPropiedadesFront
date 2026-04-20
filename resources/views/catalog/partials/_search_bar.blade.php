

<div class="search-bar-wrap">
    {{-- Cambiamos el form para que no recargue y ejecute applyFilters al dar Enter --}}
    <div class="search-bar">
        <input type="text" id="mainSearchInput" name="search" value="{{ request('search') }}"
               placeholder="Buscar por Marca / Modelo / Año / Color"
               onkeyup="if(event.key === 'Enter') applyFilters()">

        <button type="button" class="btn-buscar" onclick="applyFilters()">
            <span>Buscar</span> <i class="bi bi-search"></i>
        </button>
    </div>
</div>