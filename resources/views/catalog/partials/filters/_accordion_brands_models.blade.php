<div class="filter-accordion-body" id="marcasAccordionBody">

    {{-- Buscador interno --}}
    <div class="marca-search-wrap">
        <input type="text" id="marcaSearchInput" class="marca-search-input" placeholder="Buscar marca..."
            oninput="filterMarcas(this.value)" autocomplete="off">
        <i class="bi bi-search marca-search-icon"></i>
    </div>

    {{-- Lista de marcas con scroll --}}
    <div class="marca-scroll-container">
        <ul class="marca-list" id="marcaList">
            @foreach($marcas->where('autos_count', '>', 0) as $marca)
                <li class="marca-item" data-marca="{{ strtolower($marca->nombre) }}">
                    <div class="marca-row">
                        <label class="marca-check-label">
                            {{-- Dentro de tu loop de marcas en _accordion_brands_models.blade.php --}}
                            <input type="checkbox" name="marcas[]" value="{{ $marca->id_marca }}" class="marca-checkbox"
                                onchange="applyFilters()" {{ in_array($marca->id_marca, (array) request('marcas', [])) ? 'checked' : '' }}>

                            @if($marca->imagen)
                                <img src="{{ $marca->getImagen }}" alt="{{ $marca->nombre }}" class="marca-logo-sm"
                                    onerror="this.style.display='none'">
                            @else
                                <span class="marca-logo-sm"></span>
                            @endif

                            <span class="marca-nombre">{{ $marca->nombre }}</span>
                            <span class="marca-count">({{ $marca->autos_count }})</span>
                        </label>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

</div>

<script>
    // Función de búsqueda: muestra solo las marcas que coinciden
    function filterMarcas(query) {
        const q = query.toLowerCase().trim();
        const items = document.querySelectorAll('#marcaList .marca-item');
        items.forEach(item => {
            const marca = item.dataset.marca || '';
            if (marca.includes(q)) {
                item.style.display = ''; // mostrar
            } else {
                item.style.display = 'none'; // ocultar
            }
        });
    }

    // Aplica los filtros seleccionados (recarga con los parámetros)


    // Al cargar la página, aseguramos que todas las marcas sean visibles
    document.addEventListener('DOMContentLoaded', function () {
        const items = document.querySelectorAll('#marcaList .marca-item');
        items.forEach(item => item.style.display = '');
    });

    document.addEventListener('click', function (e) {
        // Si el clic fue en un link de paginación dentro de nuestro contenedor
        if (e.target.closest('#carsGridContainer .pagination a')) {
            e.preventDefault(); // Detenemos la recarga de página
            const url = e.target.closest('a').href;

            fetch(url, { headers: { "X-Requested-With": "XMLHttpRequest" } })
                .then(res => res.text())
                .then(html => {
                    document.getElementById('carsGridContainer').innerHTML = html;
                    window.scrollTo(0, 0);
                });
        }
    });

</script>

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/catalog/partials/filters/_accordion_brands_models.css') }}">
@endpush