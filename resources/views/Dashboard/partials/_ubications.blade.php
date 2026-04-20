<section class="ubicaciones-section">
    <h2 class="section-title mb-4">Nuestras ubicaciones</h2>
    <div class="ubicaciones-map">
        <div class="ubicaciones-list">
            <div class="ubicaciones-search">
                <input type="text" placeholder="Buscar por dirección, código pos...">
                <button class="btn-buscar-ub">Buscar</button>
            </div>
            <div class="ubicacion-count">14 ubicaciones</div>
            @php
                $ubicaciones = [
                    ['name' => 'Dalton Seminuevos Copilco', 'status' => 'Abierto hasta las 7:00 p.m.', 'address' => 'Av. Universidad 2060, Coyoacán 04360 CDMX', 'phone' => '+52 55 5001 0000'],
                    ['name' => 'Dalton Seminuevos León', 'status' => 'Abierto hasta las 8:00 p.m.', 'address' => 'Blvd. Adolfo López Mateos #3423, León, Gto.', 'phone' => '+52 444 447 3334'],
                    ['name' => 'Dalton Seminuevos La Calma', 'status' => 'Abierto hasta las 7:00 p.m.', 'address' => 'Av. Guadalupe 6030, Zapopan, Jalisco', 'phone' => '+52 33 1234 5678'],
                    ['name' => 'Dalton Seminuevos Polanco', 'status' => 'Abierto hasta las 7:00 p.m.', 'address' => 'Av. Horacio 1855, Polanco, CDMX', 'phone' => '+52 55 5002 0000'],
                ];
            @endphp
            @foreach($ubicaciones as $ub)
                <div class="ubicacion-item">
                    <img src="https://images.unsplash.com/photo-1562519776-18a373b990d4?w=120&h=100&fit=crop&q=70"
                        alt="{{ $ub['name'] }}" width="60" height="50" loading="lazy">
                    <div class="ubicacion-info">
                        <h6>{{ $ub['name'] }}</h6>
                        <span class="open">{{ $ub['status'] }}</span>
                        <address>{{ $ub['address'] }}<br>{{ $ub['phone'] }}</address>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="map-placeholder">
            <i class="bi bi-map" style="font-size:2.5rem;color:#9ca3af"></i>
            <span style="color:var(--dalton-muted)">Mapa de ubicaciones</span>
            <small style="font-size:0.75rem;color:#9ca3af">Integrar Google Maps API aquí</small>
        </div>
    </div>
</section>