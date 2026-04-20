<div class="marcas-bar-container">

    {{-- Flecha izquierda --}}
    <button class="marcas-arrow marcas-arrow-left" id="marcasArrowLeft"
            onclick="scrollMarcas(-1)" aria-label="Anterior" type="button">
        <i class="bi bi-chevron-left"></i>
    </button>

    <div class="marcas-bar" id="marcasBar">
        @foreach($marcas->where('autos_count', '>', 0) as $m)
            <button type="button"
                class="marca-btn {{ in_array($m->id_marca, (array) request('marcas', [])) ? 'active' : '' }}"
                data-id="{{ $m->id_marca }}"
                onclick="toggleMarcaBar({{ $m->id_marca }}, this)">

                @if($m->imagen)
                    <img src="{{ $m->getImagen }}" alt="{{ $m->nombre }}"
                         onerror="this.style.display='none'" width="20" height="16">
                @endif

                <span class="marca-name-text">{{ $m->nombre }}</span>
                <span class="marca-count-pill">{{ $m->autos_count }}</span>
            </button>
        @endforeach
    </div>

    {{-- Flecha derecha --}}
    <button class="marcas-arrow marcas-arrow-right" id="marcasArrowRight"
            onclick="scrollMarcas(1)" aria-label="Siguiente" type="button">
        <i class="bi bi-chevron-right"></i>
    </button>

</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/catalog/partials/_brands.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/catalog/partials/_brands.js') }}"></script>
@endpush