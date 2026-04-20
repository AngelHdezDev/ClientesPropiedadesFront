<div class="filter-accordion-body">
    <div class="km-filter">
        <div class="km-inputs">
            <div class="km-input-group">
                <label>Mínimo</label>
                <div class="km-input-wrap">
                    <input type="text" id="kmMinInput" value="1Km" readonly>
                </div>
            </div>
            <div class="km-input-group">
                <label>Máximo</label>
                <div class="km-input-wrap">
                    <input type="text" id="kmMaxInput" value="500,000Km" readonly>
                </div>
            </div>
        </div>

        <!-- Slider doble -->
        <div class="km-slider-wrap">
            <div class="km-slider-track">
                <div class="km-slider-range" id="kmRange"></div>
            </div>
            <input type="range" id="kmMin" name="km_min" class="km-thumb km-thumb-min" min="0" max="500000" value="0"
                step="1000">
            <input type="range" id="kmMax" name="km_max" class="km-thumb km-thumb-max" min="0" max="500000"
                value="500000" step="1000">
        </div>
    </div>
</div>

<script>
    /**
 * Dual range slider — Kilometraje
 * Pegar antes de </body>
 */
    (function () {
        const MIN_KM = 0;
        const MAX_KM = 500000;
        const STEP = 1000;

        const inputMin = document.getElementById('kmMin');
        const inputMax = document.getElementById('kmMax');
        const labelMin = document.getElementById('kmMinInput');
        const labelMax = document.getElementById('kmMaxInput');
        const range = document.getElementById('kmRange');

        if (!inputMin) return; // guard por si la sección no está en la página

        function formatKm(val) {
            if (val <= MIN_KM) return '1Km';
            return Number(val).toLocaleString('es-MX') + 'Km';
        }

        function updateSlider() {
            const minVal = parseInt(inputMin.value);
            const maxVal = parseInt(inputMax.value);

            // Evitar cruce
            if (minVal >= maxVal) {
                inputMin.value = maxVal - STEP;
            }

            const minPct = ((parseInt(inputMin.value) - MIN_KM) / (MAX_KM - MIN_KM)) * 100;
            const maxPct = ((maxVal - MIN_KM) / (MAX_KM - MIN_KM)) * 100;

            range.style.left = minPct + '%';
            range.style.width = (maxPct - minPct) + '%';

            labelMin.value = formatKm(inputMin.value);
            labelMax.value = formatKm(maxVal);
        }

        inputMin.addEventListener('input', updateSlider);
        inputMax.addEventListener('input', updateSlider);

        // Sustituye la función applyKmFilter de tu script por esta:
        // Dentro de tu (function () { ... })()
        function applyKmFilter() {
            // CAMBIO: En lugar de form.submit(), llamamos a tu función global de AJAX
            if (typeof applyFilters === 'function') {
                applyFilters();
            }
        }

        inputMin.addEventListener('change', applyKmFilter);
        inputMax.addEventListener('change', applyKmFilter);

        // Init con valores del query string si existen
        const params = new URLSearchParams(window.location.search);
        if (params.get('km_min')) {
            inputMin.value = params.get('km_min');
        }
        if (params.get('km_max')) {
            inputMax.value = params.get('km_max');
        }

        updateSlider(); // render inicial
    })();
</script>

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/catalog/partials/filters/_accordion_km.css') }}">
@endpush