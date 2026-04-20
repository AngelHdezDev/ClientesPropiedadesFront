
(function () {
    const bar = document.getElementById('marcasBar');
    const container = bar?.closest('.marcas-bar-container');
    const arrowL = document.getElementById('marcasArrowLeft');
    const arrowR = document.getElementById('marcasArrowRight');

    /* ---- Actualizar estado de flechas según posición del scroll ---- */
    function updateArrows() {
        if (!bar || !arrowL || !arrowR) return;

        const atStart = bar.scrollLeft <= 4;
        const atEnd = bar.scrollLeft + bar.clientWidth >= bar.scrollWidth - 4;

        arrowL.classList.toggle('hidden', atStart);
        arrowR.classList.toggle('hidden', atEnd);

        if (container) {
            container.classList.toggle('can-scroll-left', !atStart);
            container.classList.toggle('can-scroll-right', !atEnd);
        }
    }

    /* ---- Scroll al hacer clic en flecha ---- */
    window.scrollMarcas = function (direction) {
        if (!bar) return;
        bar.scrollBy({ left: 240 * direction, behavior: 'smooth' });
    };

    /* ---- Toggle marca: sincroniza con sidebar y aplica filtros ---- */
    window.toggleMarcaBar = function (idMarca, btnElement) {
        const checkbox = document.querySelector(`.marca-checkbox[value="${idMarca}"]`);

        if (checkbox) {
            checkbox.checked = !checkbox.checked;
            // Al cambiar el checkbox, el listener que ya tienes abajo
            // (cb.addEventListener('change', syncBarWithSidebar)) se encargará
            // de poner o quitar la clase 'active' correctamente.
            checkbox.dispatchEvent(new Event('change'));
        }

        if (typeof applyFilters === 'function') {
            applyFilters();
        }
    };
    /* ---- Sincronizar estado visual del bar con los checkboxes del sidebar ---- */
    window.syncBarWithSidebar = function () { // <--- Agregamos window.
        document.querySelectorAll('.marca-btn[data-id]').forEach(btn => {
            const id = btn.dataset.id;
            const checkbox = document.querySelector(`.marca-checkbox[value="${id}"]`);
            if (checkbox) {
                btn.classList.toggle('active', checkbox.checked);
            }
        });
    };

    /* ---- Escuchar cambios en checkboxes del sidebar ---- */
    document.querySelectorAll('.marca-checkbox').forEach(cb => {
        cb.addEventListener('change', syncBarWithSidebar);
    });

    /* ---- Inicializar ---- */
    if (bar) {
        bar.addEventListener('scroll', updateArrows, { passive: true });
        updateArrows(); // Estado inicial
    }
})();
