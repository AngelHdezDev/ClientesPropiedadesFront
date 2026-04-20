<section>
    <div class="section-header">
        <h2 class="section-title">Tenemos tu marca favorita</h2>
    </div>
    <div class="marcas-scroll mb-4">
        @php
            $marcas = [
                ['name' => 'Toyota', 'logo' => 'https://logo.clearbit.com/toyota.com'],
                ['name' => 'Byd', 'logo' => 'https://logo.clearbit.com/byd.com'],
                ['name' => 'Honda', 'logo' => 'https://logo.clearbit.com/honda.com'],
                ['name' => 'Mazda', 'logo' => 'https://logo.clearbit.com/mazda.com'],
                ['name' => 'Nissan', 'logo' => 'https://logo.clearbit.com/nissan.com'],
                ['name' => 'Chevrolet', 'logo' => 'https://logo.clearbit.com/chevrolet.com'],
                ['name' => 'Kia', 'logo' => 'https://logo.clearbit.com/kia.com'],
                ['name' => 'Hyundai', 'logo' => 'https://logo.clearbit.com/hyundai.com'],
                ['name' => 'Seat', 'logo' => 'https://logo.clearbit.com/seat.com'],
                ['name' => 'Volkswagen', 'logo' => 'https://logo.clearbit.com/volkswagen.com'],
            ];
        @endphp
        @foreach($marcas as $marca)
            <button class="marca-pill">
                <img src="{{ $marca['logo'] }}" alt="{{ $marca['name'] }}" onerror="this.style.display='none'" width="20"
                    height="20">
                {{ $marca['name'] }}
            </button>
        @endforeach
    </div>

    <div class="cars-scroll">
        @php
            $autos = [
                ['name' => 'Audi Q5 2018', 'meta' => '5 PTS. D... | 148,697 km', 'price' => '$5,713.02', 'currency' => 'MXN/mensuales*', 'liquidacion' => '$269,000 precio de liquidación', 'market' => 'Precio 23% menor al mercado', 'location' => 'Honda Carranza, SLP', 'img' => 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=510&h=320&fit=crop&q=75'],
                ['name' => 'CUPRA LEON 2022', 'meta' => '5 PTS. H... | 95,525 km', 'price' => '$9,132.33', 'currency' => 'MXN/mensuales*', 'liquidacion' => '$430,000 precio de liquidación', 'market' => 'Precio 22% menor al mercado', 'location' => 'Honda Carranza, SLP', 'img' => 'https://images.unsplash.com/photo-1614200187524-dc4b892acf16?w=510&h=320&fit=crop&q=75'],
                ['name' => 'Ford Explorer 2022', 'meta' => '5 PTS. S... | 110,481 km', 'price' => '$12,955.17', 'currency' => 'MXN/mensuales*', 'liquidacion' => '$610,000 precio de liquidación', 'market' => 'Precio 22% menor al mercado', 'location' => 'Toyota Lomas, SLP', 'img' => 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=510&h=320&fit=crop&q=75'],
                ['name' => 'Chevrolet Onix 2022', 'meta' => '4 PTS. LS... | 73,776 km', 'price' => '$4,077.69', 'currency' => 'MXN/mensuales*', 'liquidacion' => '$192,000 precio de liquidación', 'market' => 'Precio 20% menor al mercado', 'location' => 'Centro Magno, GDL', 'img' => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=510&h=320&fit=crop&q=75'],
                ['name' => 'Toyota TUNDRA 2020', 'meta' => '4 PTS. E... | 112,108 km', 'price' => '$14,123.26', 'currency' => 'MXN/mensuales*', 'liquidacion' => '$665,000 precio de liquidación', 'market' => 'Precio 17% menor al mercado', 'location' => 'Honda Carranza, SLP', 'img' => 'https://images.unsplash.com/photo-1564456895-0b85e7a6f6a4?w=510&h=320&fit=crop&q=75'],
            ];
        @endphp
        @foreach($autos as $auto)
            <div class="car-card">
                <img class="car-card-img" src="{{ $auto['img'] }}" alt="{{ $auto['name'] }}" loading="lazy" width="255"
                    height="160">
                <div class="car-card-body">
                    <div class="car-card-title">{{ $auto['name'] }}</div>
                    <div class="car-card-meta">{{ $auto['meta'] }}</div>
                    <div class="car-card-price">{{ $auto['price'] }} <small>{{ $auto['currency'] }}</small></div>
                    <span class="badge-liquidacion">{{ $auto['liquidacion'] }}</span>
                    <div class="car-card-market"><i class="bi bi-graph-down-arrow"></i> {{ $auto['market'] }}</div>
                    <div class="car-card-location"><i class="bi bi-geo-alt"></i> {{ $auto['location'] }}</div>
                </div>
            </div>
        @endforeach
    </div>
</section>