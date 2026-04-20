<section>
    <div class="section-header">
        <h2 class="section-title">Tenemos tu marca favorita</h2>
    </div>

    <div class="fav-marcas-scroll mb-4">
        @foreach($marcas as $marca)
            <a href="{{ route('autos.index', ['marcas[]' => $marca->id_marca]) }}" class="fav-marca-pill"
                style="text-decoration: none;">
                <img src="{{ config('app.admin_storage') . $marca->imagen }}" alt="{{ $marca->nombre }}" width="20"
                    height="20" class="fav-brand-logo" onerror="this.style.display='none';">
                {{ $marca->nombre }}
            </a>
        @endforeach
    </div>

    <div class="fav-cars-scroll">
        @foreach($autos as $auto)
            <div class="fav-car-card" onclick="window.location.href='{{ route('autos.show', $auto->id_auto) }}'">
                <div class="fav-car-img-container"
                    style="position: relative; background: #f8f9fa; height: 160px; overflow: hidden;">
                    <img class="fav-car-card-img"
                        src="{{ config('app.admin_storage') . ($auto->thumbnail->imagen ?? 'default.jpg') }}"
                        alt="{{ $auto->modelo }}" style="width: 100%; height: 100%; object-fit: cover;"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                    <div class="fav-placeholder-car"
                        style="display: none; height: 100%; width: 100%; align-items: center; justify-content: center; flex-direction: column; color: #adb5bd;">
                        <i class="bi bi-image" style="font-size: 2.5rem;"></i>
                        <span style="font-size: 0.8rem;">Imagen no disponible</span>
                    </div>
                </div>

                <div class="fav-car-card-body">
                    <div class="fav-car-card-title">{{ $auto->marca->nombre }} {{ $auto->modelo }} {{ $auto->anio }}</div>
                    <div class="fav-car-card-meta">{{ $auto->puertas }} PTS. | {{ number_format($auto->kilometraje) }} km
                    </div>
                    <div class="fav-car-card-price">${{ number_format($auto->precio, 2) }} <small>MXN</small></div>

                    @if($auto->precio_liquidacion)
                        <span class="fav-badge-liquidacion">${{ number_format($auto->precio_liquidacion) }} precio de
                            liquidación</span>
                    @endif

                    <div class="fav-car-card-location">
                        <i class="bi bi-geo-alt"></i> {{ $auto->ubicacion ?? 'Ubicación no disponible' }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>