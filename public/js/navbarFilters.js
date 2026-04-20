/* =============================================
   navbarFilters.js
   Slider de marcas + dropdown desktop + panel móvil
   ============================================= */

let currentStep = 0;

/* ─────────────────────────────────────────────
   SLIDER + PAGINACIÓN
───────────────────────────────────────────── */
function buildPagination(totalPages) {
    const container = document.getElementById('sliderPagination');
    if (!container) return;
    container.innerHTML = '';

    // Flecha izquierda
    const prev = document.createElement('button');
    prev.className = 'mdp-btn';
    prev.innerHTML = '<i class="bi bi-chevron-left" style="font-size:0.75rem"></i>';
    prev.disabled = currentStep === 0;
    prev.onclick = () => goToPage(currentStep - 1);
    container.appendChild(prev);

    // Números con "..." automáticos
    for (let i = 0; i < totalPages; i++) {
        const isFirst = i === 0;
        const isLast = i === totalPages - 1;
        const isCurrent = i === currentStep;
        const isNear = Math.abs(i - currentStep) <= 1;

        if (isFirst || isLast || isCurrent || isNear) {
            // Añadir "..." si hay salto respecto al botón anterior
            const lastChild = container.lastElementChild;
            const lastIsBtn = lastChild && lastChild.classList.contains('mdp-btn');
            const lastNum = lastIsBtn ? parseInt(lastChild.textContent) : null;
            if (lastNum !== null && i - lastNum > 1) {
                const dots = document.createElement('span');
                dots.className = 'mdp-dots';
                dots.textContent = '...';
                container.appendChild(dots);
            }

            const btn = document.createElement('button');
            btn.className = 'mdp-btn' + (isCurrent ? ' active' : '');
            btn.textContent = i + 1;
            btn.onclick = () => goToPage(i);
            container.appendChild(btn);
        }
    }

    // Flecha derecha
    const next = document.createElement('button');
    next.className = 'mdp-btn';
    next.innerHTML = '<i class="bi bi-chevron-right" style="font-size:0.75rem"></i>';
    next.disabled = currentStep === totalPages - 1;
    next.onclick = () => goToPage(currentStep + 1);
    container.appendChild(next);
}

function goToPage(page) {
    const track = document.getElementById('marcaSlider');
    if (!track) return;

    const totalPages = Math.ceil(track.children.length / 6);
    currentStep = Math.max(0, Math.min(page, totalPages - 1));

    track.style.transform = `translateX(-${currentStep * 100}%)`;

    document.getElementById('prevBtn').disabled = (currentStep === 0);
    document.getElementById('nextBtn').disabled = (currentStep === totalPages - 1);

    buildPagination(totalPages);
}

function moveSlider(direction) {
    goToPage(currentStep + direction);
}

/* ─────────────────────────────────────────────
   DROPDOWN DESKTOP
───────────────────────────────────────────── */
function toggleMarcaDropdown(btn) {
    if (window.innerWidth <= 768) {
        toggleMobileMenu();
        return;
    }

    const dropdown = document.getElementById('marcaDropdown');
    const backdrop = document.getElementById('dropdownBackdrop');
    const isOpen = dropdown.classList.contains('open');

    closeDropdown();

    if (!isOpen) {
        dropdown.classList.add('open');
        backdrop.classList.add('open');
        btn.classList.add('active');
        const icon = btn.querySelector('i');
        if (icon) { icon.className = 'bi bi-chevron-up'; icon.style.fontSize = '0.7rem'; }
    }
}



function closeDropdown() {
    const dropdown = document.getElementById('marcaDropdown');
    const backdrop = document.getElementById('dropdownBackdrop');
    if (!dropdown) return;

    dropdown.classList.remove('open');
    backdrop.classList.remove('open');

    document.querySelectorAll('.filter-link').forEach(b => {
        b.classList.remove('active');
        const icon = b.querySelector('i');
        if (icon) { icon.className = 'bi bi-chevron-down'; icon.style.fontSize = '0.7rem'; }
    });
}

/* ─────────────────────────────────────────────
   PANEL MÓVIL
───────────────────────────────────────────── */
function toggleMobileMenu() {
    const panel = document.getElementById('mobileFiltersPanel');
    const backdrop = document.getElementById('mobileBackdrop');
    panel.classList.toggle('open');
    backdrop.classList.toggle('open');
    document.body.style.overflow = panel.classList.contains('open') ? 'hidden' : '';
}

function toggleMobileSubmenu(header) {
    header.classList.toggle('active');
    header.nextElementSibling.classList.toggle('open');
}

function toggleMobileModelos(header) {
    header.classList.toggle('active');
    header.nextElementSibling.classList.toggle('open');
}

function clearMobileFilters() {
    document.querySelectorAll('.mobile-filters-panel input[type="checkbox"], .mobile-filters-panel input[type="radio"]')
        .forEach(i => i.checked = false);
    document.querySelectorAll('.mobile-filters-panel input[type="range"]')
        .forEach(i => i.value = i.min || 0);
    document.querySelectorAll('.mobile-filters-panel input[type="number"]')
        .forEach(i => i.value = '');
}

function applyMobileFilters() {
    toggleMobileMenu();
}

/* ─────────────────────────────────────────────
   EVENTOS GLOBALES
───────────────────────────────────────────── */
document.addEventListener('keydown', e => {
    if (e.key !== 'Escape') return;
    closeDropdown();
    const panel = document.getElementById('mobileFiltersPanel');
    if (panel && panel.classList.contains('open')) toggleMobileMenu();
});

window.addEventListener('resize', () => {
    if (window.innerWidth > 768) {
        const panel = document.getElementById('mobileFiltersPanel');
        const backdrop = document.getElementById('mobileBackdrop');
        if (panel && panel.classList.contains('open')) {
            panel.classList.remove('open');
            backdrop.classList.remove('open');
            document.body.style.overflow = '';
        }
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const track = document.getElementById('marcaSlider');
    if (track) buildPagination(Math.ceil(track.children.length / 6));
});