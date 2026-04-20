<section class="brand-catalog-section mt-5">
    <h3 class="section-title mb-4">Nuestro catálogo de marcas</h3>

    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 g-3">
        @foreach($marcas as $marca)
                <div class="col">
                    <a href="{{ route('autos.index', [
                'marcas[]' => $marca->id_marca
            ]) }}" class="brand-catalog-link">

                        <img src="{{ config('app.admin_storage') . $marca->imagen }}" alt="{{ $marca->nombre }}"
                            onerror="this.style.visibility='hidden'">
                        <span class="brand-name">{{ $marca->nombre }}</span>
                        <span class="brand-count">({{ $marca->autos_count }})</span>
                    </a>
                </div>
        @endforeach
    </div>
</section>