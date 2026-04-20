<div class="results-count">
    {{ $autos->total() }} Resultados
</div>

<div class="cars-grid sidebar-open" id="carsGrid">
    @forelse($autos as $auto)
        {{-- Envolvemos la card en un anchor tag apuntando a la ruta show --}}
        <a href="{{ route('autos.show', $auto->id_auto) }}" class="car-card-link">
            <div class="car-card">
                <div class="car-card-img-wrap">
                    @if($auto->thumbnail)
                        <img
                            src="{{ env('ADMIN_STORAGE_URL') . $auto->thumbnail->imagen }}"
                            alt="{{ $auto->marca->nombre }} {{ $auto->modelo }} {{ $auto->year }}"
                            loading="lazy"
                            decoding="async"
                            class="car-thumb"
                            onload="this.classList.add('loaded')"
                            onerror="this.closest('.car-card-img-wrap').innerHTML = '<div class=\'car-img-placeholder\'><i class=\'bi bi-car-front-fill\'></i><span>Sin foto</span></div>'">
                    @else
                        <div class="car-img-placeholder">
                            <i class="bi bi-car-front-fill"></i>
                            <span>Sin foto</span>
                        </div>
                    @endif

                    <div class="car-badges">
                        @if($auto->year == 2026)
                            <span class="badge-nuevo"><i class="bi bi-plus"></i> Nuevo 0km</span>
                        @endif
                        @if($auto->consignacion)
                            <span class="badge-consignacion">En consignación</span>
                        @endif
                    </div>
                </div>

                <div class="car-card-body">
                    <div class="car-card-header">
                        <div class="car-card-title">
                            {{ $auto->marca->nombre }} {{ $auto->modelo }} {{ $auto->year }}
                        </div>
                        @if($auto->marca->logo)
                            <img
                                src="{{ asset('storage/' . $auto->marca->logo) }}"
                                class="brand-logo"
                                alt="{{ $auto->marca->nombre }}"
                                loading="lazy"
                                decoding="async"
                                onerror="this.style.display='none'">
                        @endif
                    </div>

                    <div class="car-card-meta">
                        {{ $auto->tipo }} |
                        {{ $auto->ocultar_kilometraje
                            ? 'Kilometraje no disponible'
                            : number_format($auto->kilometraje) . ' Km' }}
                    </div>

                    <div class="car-price">
                        ${{ number_format($auto->precio, 0) }} <small>MXN</small>
                    </div>

                    <div class="car-location">
                        <i class="bi bi-geo-alt"></i>
                        {{-- Inyectamos la ubicación real si la tienes en el modelo --}}
                        <span>{{ $auto->agencia->nombre ?? 'No disponible' }}</span>
                    </div>
                </div>
            </div>
        </a>
    @empty
        <div class="no-results">
            No se encontraron vehículos que coincidan con tu búsqueda.
        </div>
    @endforelse
</div>

<div class="pagination-wrap">
    {{ $autos->links() }}
</div>