<div class="filter-accordion-body">
    <div class="km-filter">
        <div class="km-inputs">
            <div class="km-input-group">
                <label>Precio Mínimo</label>
                <div class="km-input-wrap">
                    <input type="text" id="priceMinInput" value="$50,000" readonly>
                </div>
            </div>
            <div class="km-input-group">
                <label>Precio Máximo</label>
                <div class="km-input-wrap">
                    <input type="text" id="priceMaxInput" value="$3,500,000" readonly>
                </div>
            </div>
        </div>

        <!-- Slider doble -->
        <div class="km-slider-wrap">
            <div class="km-slider-track">
                <div class="km-slider-range" id="priceRange"></div>
            </div>
            <input type="range" id="priceMin" name="price_min" class="km-thumb km-thumb-min" min="50000" max="3500000"
                value="50000" step="1000">
            <input type="range" id="priceMax" name="price_max" class="km-thumb km-thumb-max" min="50000" max="3500000"
                value="3500000" step="1000">
        </div>
    </div>
</div>

<script>
    (function () {
        const MIN_PRECIO = 50000;  // Cambiado de 0 a 50000
        const MAX_PRECIO = 3500000;
        const STEP = 1000;

        const inputMin = document.getElementById('priceMin');
        const inputMax = document.getElementById('priceMax');
        const labelMin = document.getElementById('priceMinInput');
        const labelMax = document.getElementById('priceMaxInput');
        const range = document.getElementById('priceRange');

        if (!inputMin || !inputMax || !labelMin || !labelMax || !range) return;

        function formatPrecio(val) {
            if (val <= MIN_PRECIO) return '$50,000';  // Mostrar mínimo correcto
            if (val >= MAX_PRECIO) return '$3,500,000';
            return '$' + Number(val).toLocaleString('es-MX');
        }

        function updateSlider() {
            let minVal = parseInt(inputMin.value);
            let maxVal = parseInt(inputMax.value);

            // Validar que no se crucen y respetar mínimo de 50000
            if (minVal < MIN_PRECIO) {
                minVal = MIN_PRECIO;
                inputMin.value = minVal;
            }
            if (maxVal < MIN_PRECIO) {
                maxVal = MIN_PRECIO + STEP;
                inputMax.value = maxVal;
            }

            if (minVal > maxVal - STEP) {
                minVal = Math.max(MIN_PRECIO, maxVal - STEP);
                inputMin.value = minVal;
            }
            if (maxVal < minVal + STEP) {
                maxVal = Math.min(MAX_PRECIO, minVal + STEP);
                inputMax.value = maxVal;
            }

            const minPct = ((minVal - MIN_PRECIO) / (MAX_PRECIO - MIN_PRECIO)) * 100;
            const maxPct = ((maxVal - MIN_PRECIO) / (MAX_PRECIO - MIN_PRECIO)) * 100;

            range.style.left = minPct + '%';
            range.style.width = (maxPct - minPct) + '%';

            labelMin.value = formatPrecio(minVal);
            labelMax.value = formatPrecio(maxVal);
        }

        inputMin.addEventListener('input', updateSlider);
        inputMax.addEventListener('input', updateSlider);

        function applyPriceFilter() {
            // CAMBIO: En lugar de form.submit(), llamamos a tu función global
            if (typeof applyFilters === 'function') {
                applyFilters();
            }
        }

        inputMin.addEventListener('change', applyPriceFilter);
        inputMax.addEventListener('change', applyPriceFilter);

        // Inicializar con valores del query string si existen
        const params = new URLSearchParams(window.location.search);
        let minValue = MIN_PRECIO;
        let maxValue = MAX_PRECIO;

        if (params.get('price_min')) {
            minValue = Math.max(MIN_PRECIO, Math.min(MAX_PRECIO, parseInt(params.get('price_min'))));
            inputMin.value = minValue;
        }
        if (params.get('price_max')) {
            maxValue = Math.max(MIN_PRECIO, Math.min(MAX_PRECIO, parseInt(params.get('price_max'))));
            inputMax.value = maxValue;
        }

        // Validar que min no sea mayor que max y respetar mínimo
        if (minValue >= maxValue) {
            inputMin.value = MIN_PRECIO;
            inputMax.value = MAX_PRECIO;
        }

        updateSlider();
    })();
</script>

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/catalog/partials/filters/_accordion_price.css') }}">
@endpush