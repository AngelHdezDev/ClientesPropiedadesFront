var sidebarOpen = true;
var isMobile = () => window.innerWidth <= 992;

/* ==========================================
   INTERFAZ Y NAVEGACIÓN
   ========================================== */

function toggleFilters() {
    if (isMobile()) { openMobileSidebar(); return; }
    var sidebar = document.getElementById('sidebar');
    var grid = document.getElementById('carsGrid');
    var btn = document.getElementById('toggleFiltersBtn');
    sidebarOpen = !sidebarOpen;

    if (sidebarOpen) {
        sidebar.classList.remove('hidden');
        grid.classList.add('sidebar-open');
        btn.innerHTML = 'Ocultar filtros <i class="bi bi-sliders"></i>';
    } else {
        sidebar.classList.add('hidden');
        grid.classList.remove('sidebar-open');
        btn.innerHTML = 'Mostrar filtros <i class="bi bi-sliders"></i>';
    }
}

function openMobileSidebar() {
    document.getElementById('sidebar').classList.add('mobile-open');
    document.getElementById('sidebarOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeMobileSidebar() {
    document.getElementById('sidebar').classList.remove('mobile-open');
    document.getElementById('sidebarOverlay').classList.remove('open');
    document.body.style.overflow = '';
}

function toggleAccordion(btn) {
    btn.classList.toggle('open');
    var content = btn.nextElementSibling;
    if (content && content.classList.contains('filter-accordion-content')) {
        content.style.maxHeight = content.style.maxHeight ? null : content.scrollHeight + "px";
    }
}

/* ==========================================
   ORDENAMIENTO (SORT)
   ========================================== */

function toggleSort() { document.getElementById('sortDropdown').classList.toggle('open'); }

function selectSort(el, value) {
    document.querySelectorAll('.sort-option').forEach(o => o.classList.remove('active'));
    el.classList.add('active');

    // 1. Obtenemos el texto limpio de la opción seleccionada
    const text = el.textContent.trim();

    // 2. Actualizamos el botón principal (sin cortar el texto a menos que sea muy largo)
    const sortBtn = document.querySelector('.sort-btn');
    if (sortBtn) {
        sortBtn.innerHTML = `${text} <i class="bi bi-chevron-down" style="font-size:0.75rem"></i>`;
    }

    document.getElementById('sortDropdown').classList.remove('open');

    // 3. Actualizamos el input que viajará por AJAX
    const hiddenInput = document.getElementById('hiddenSort');
    if (hiddenInput) {
        hiddenInput.value = value;
    }

    // 4. Disparamos la petición al servidor
    if (typeof applyFilters === 'function') {
        applyFilters();
    }
}

/* ==========================================
   MOTOR DE FILTRADO (AJAX)
   ========================================== */

function applyFilters() {
    const filterForm = document.getElementById('filterForm');
    if (!filterForm) return;

    const formData = new FormData(filterForm);

    // Sincronizar con el buscador de texto superior si existe
    const mainSearch = document.getElementById('mainSearchInput');
    if (mainSearch) formData.set('search', mainSearch.value);

    const queryString = new URLSearchParams(formData).toString();

    // Actualizar URL sin recargar
    window.history.pushState({}, '', `${window.location.pathname}?${queryString}`);

    const container = document.getElementById('carsGridContainer');
    container.style.opacity = '0.5';

    fetch(`${window.location.pathname}?${queryString}`, {
        headers: { "X-Requested-With": "XMLHttpRequest" }
    })
        .then(response => response.text())
        .then(html => {
            container.innerHTML = html;
            container.style.opacity = '1';

            renderActiveFilters();

            // Scroll suave al inicio de los resultados
            const rect = container.getBoundingClientRect();
        })
        .catch(error => console.error('Error Dalton Filters:', error));
}

/* ==========================================
   BADGES (FILTROS ACTIVOS)
   ========================================== */

function renderActiveFilters() {
    const list = document.getElementById('activeFiltersList');
    const resetBtn = document.getElementById('btnResetFilters');
    const checkboxes = document.querySelectorAll('#filterForm input[type="checkbox"]:checked');

    if (!list) return;
    list.innerHTML = '';

    // 1. Badges de Checkboxes (Marcas, Ofertas, Años)
    checkboxes.forEach(cb => {
        let labelText = "";
        if (cb.classList.contains('marca-checkbox')) {
            labelText = cb.closest('.marca-row').querySelector('.marca-nombre').innerText;
        } else if (cb.name === 'years[]') {
            labelText = "Año: " + cb.value;
        } else if (cb.name === 'nuevo' || cb.name === 'consignacion') {
            labelText = cb.parentElement.innerText.trim().replace('⭐', '');
        }

        if (labelText) {
            const badge = document.createElement('div');
            badge.className = 'filter-badge';
            badge.innerHTML = `${labelText} <i class="bi bi-x" onclick="removeSingleFilter('${cb.name}', '${cb.value}')"></i>`;
            list.appendChild(badge);
        }
    });

    // 2. Badge de PRECIO
    const pMin = document.getElementById('priceMin'), pMax = document.getElementById('priceMax');
    if (pMin && pMax && (pMin.value > 50000 || pMax.value < 3500000)) {
        const badge = document.createElement('div');
        badge.className = 'filter-badge';
        badge.innerHTML = `Precio: $${parseInt(pMin.value).toLocaleString()} - $${parseInt(pMax.value).toLocaleString()} <i class="bi bi-x" onclick="resetPriceSlider()"></i>`;
        list.appendChild(badge);
    }

    // 3. Badge de KILOMETRAJE (Nueva lógica)
    const kMin = document.getElementById('kmMin'), kMax = document.getElementById('kmMax');
    if (kMin && kMax && (kMin.value > 0 || kMax.value < 500000)) {
        const badge = document.createElement('div');
        badge.className = 'filter-badge';
        badge.innerHTML = `Km: ${parseInt(kMin.value).toLocaleString()} - ${parseInt(kMax.value).toLocaleString()} <i class="bi bi-x" onclick="resetKmSlider()"></i>`;
        list.appendChild(badge);
    }

    // BADGE PARA EL BUSCADOR
    const mainSearch = document.getElementById('mainSearchInput');
    if (mainSearch && mainSearch.value.trim() !== '') {
        const badge = document.createElement('div');
        badge.className = 'filter-badge badge-search'; // Puedes darle un color distinto si quieres
        badge.innerHTML = `Búsqueda: "${mainSearch.value}" <i class="bi bi-x" onclick="clearSearchInput()"></i>`;
        list.appendChild(badge);
    }

    // Mostrar/Ocultar botón de Reiniciar Todo
    const priceChanged = (pMin?.value > 50000 || pMax?.value < 3500000);
    const searchHasValue = mainSearch && mainSearch.value.trim() !== '';
    const kmChanged = (kMin?.value > 0 || kMax?.value < 500000);
    if (resetBtn) resetBtn.style.display = (checkboxes.length > 0 || priceChanged || kmChanged || searchHasValue) ? 'inline-block' : 'none';


}

function removeSingleFilter(name, val) {
    const cb = document.querySelector(`input[name="${name}"][value="${val}"]`);
    
    if (cb) {
        cb.checked = false;

        // 1. Limpiar visual de años si aplica
        if (name === 'years[]') {
            const pill = cb.closest('.year-pill');
            if (pill) pill.classList.remove('active');
        }

        // 2. FORZAR SINCRONIZACIÓN DE LA BARRA SUPERIOR
        // Como el cambio es por código, el listener 'change' no se activa solo
        if (typeof syncBarWithSidebar === 'function') {
            syncBarWithSidebar();
        }
    }

    applyFilters();
}

function resetPriceSlider() {
    const pMin = document.getElementById('priceMin');
    const pMax = document.getElementById('priceMax');

    if (pMin && pMax) {
        pMin.value = 50000;
        pMax.value = 3500000;

        // Disparamos manualmente el evento input para que el CSS del slider se actualice
        pMin.dispatchEvent(new Event('input'));
        pMax.dispatchEvent(new Event('input'));

        applyFilters();
    }
}

function resetKmSlider() {
    const kMin = document.getElementById('kmMin');
    const kMax = document.getElementById('kmMax');

    if (kMin && kMax) {
        kMin.value = 0;
        kMax.value = 500000;

        // Disparamos 'input' para que el CSS del slider se actualice (la barra azul)
        kMin.dispatchEvent(new Event('input'));
        kMax.dispatchEvent(new Event('input'));

        applyFilters();
    }
}

function clearSearchInput() {
    const mainSearch = document.getElementById('mainSearchInput');
    if (mainSearch) {
        mainSearch.value = '';
        applyFilters(); // Refresca los resultados por AJAX
    }
}

// Actualiza tu clearAllFilters para que también limpie los KM
function clearAllFilters() {
    console.log("Iniciando limpieza total de filtros...");
    const form = document.getElementById('filterForm');
    
    // 1. En lugar de solo reset(), desmarcamos manualmente para asegurar el estado
    if (form) {
        form.reset();
        // Forzamos que todos los checkboxes de marcas se vean desmarcados
        form.querySelectorAll('input[type="checkbox"]').forEach(cb => {
            cb.checked = false;
        });
    }

    // 2. Limpieza de URL (FUNDAMENTAL para quitar el ?marca=Bugatti)
    // Esto evita que al recargar el AJAX, el controlador vuelva a leer el fantasma de la URL
    const url = new URL(window.location.href);
    url.search = ''; // Borra todos los parámetros (?...)
    window.history.replaceState({}, '', url);

    // 3. Limpiar visual de años
    document.querySelectorAll('.year-pill').forEach(pill => pill.classList.remove('active'));

    // 4. Sincronizar barra superior (esto apagará los botones azules de arriba)
    if (typeof syncBarWithSidebar === 'function') {
        syncBarWithSidebar();
    }

    // 5. Limpiar búsqueda de texto
    const mainSearch = document.getElementById('mainSearchInput');
    if (mainSearch) {
        mainSearch.value = ''; 
    }

    // 6. Reset Sliders (Precio y KM)
    if (typeof resetPriceSlider === 'function') {
        resetPriceSlider();
    }
    
    const kMin = document.getElementById('kmMin'), kMax = document.getElementById('kmMax');
    if (kMin && kMax) {
        kMin.value = 0; 
        kMax.value = 500000;
        kMin.dispatchEvent(new Event('input'));
        kMax.dispatchEvent(new Event('input'));
    }

    // 7. Reset Sort (Ordenamiento)
    const hiddenSort = document.getElementById('hiddenSort');
    if (hiddenSort) {
        hiddenSort.value = 'latest';
    }

    const sortBtn = document.querySelector('.sort-btn');
    if (sortBtn) {
        sortBtn.innerHTML = `Más nuevos <i class="bi bi-chevron-down" style="font-size:0.75rem"></i>`;
    }

    document.querySelectorAll('.sort-option').forEach(o => {
        o.classList.remove('active');
        if (o.getAttribute('onclick')?.includes('latest')) {
            o.classList.add('active');
        }
    });

    console.log("Filtros reseteados. Aplicando cambios...");
    applyFilters();
}

/* ==========================================
   EVENTOS GLOBALES
   ========================================== */

window.addEventListener('resize', () => { if (!isMobile()) { closeMobileSidebar(); } });

document.addEventListener('click', e => {
    var wrap = document.querySelector('.sort-dropdown-wrap');
    if (wrap && !wrap.contains(e.target)) {
        const drop = document.getElementById('sortDropdown');
        if (drop) drop.classList.remove('open');
    }
});

document.addEventListener('keydown', e => { if (e.key === 'Escape') closeMobileSidebar(); });

// Manejo de paginación por AJAX
document.addEventListener('click', function (e) {
    if (e.target.closest('#carsGridContainer .pagination a')) {
        e.preventDefault();
        const url = e.target.closest('a').href;

        const container = document.getElementById('carsGridContainer');
        container.style.opacity = '0.5';

        fetch(url, { headers: { "X-Requested-With": "XMLHttpRequest" } })
            .then(res => res.text())
            .then(html => {
                container.innerHTML = html;
                container.style.opacity = '1';
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
    }
});

// Carga inicial de badges por si hay parámetros en la URL al entrar
document.addEventListener('DOMContentLoaded', renderActiveFilters);