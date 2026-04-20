<section>
    <h2 class="section-title mb-4">Nuestro catálogo de marcas</h2>
    @php
        $catalogoMarcas = [
            ['name' => 'Chirey', 'count' => 56],
            ['name' => 'Land rover', 'count' => 2],
            ['name' => 'Kia', 'count' => 111],
            ['name' => 'Chevrolet', 'count' => 97],
            ['name' => 'Volvo', 'count' => 20],
            ['name' => 'Chrysler', 'count' => 1],
            ['name' => 'Byd', 'count' => 62],
            ['name' => 'Toyota', 'count' => 141],
            ['name' => 'Volkswagen', 'count' => 34],
            ['name' => 'Bmw', 'count' => 10],
            ['name' => 'Hyundai', 'count' => 39],
            ['name' => 'Honda', 'count' => 77],
            ['name' => 'Gmc', 'count' => 8],
            ['name' => 'Nissan', 'count' => 64],
            ['name' => 'Ford', 'count' => 16],
            ['name' => 'Audi', 'count' => 5],
            ['name' => 'Jeep', 'count' => 14],
            ['name' => 'Mercedes benz', 'count' => 10],
            ['name' => 'Mazda', 'count' => 17],
            ['name' => 'Renault', 'count' => 34],
            ['name' => 'Dodge', 'count' => 22],
            ['name' => 'Mitsubishi', 'count' => 9],
            ['name' => 'Lexus', 'count' => 1],
            ['name' => 'Peugeot', 'count' => 4],
            ['name' => 'Suzuki', 'count' => 13],
        ];
    @endphp
    <div class="row">
        @foreach(array_chunk($catalogoMarcas, 5) as $chunk)
            <div class="col">
                @foreach($chunk as $m)
                    <div class="catalogo-item">
                        <a href="#">{{ $m['name'] }} <span style="color:var(--dalton-muted)">({{ $m['count'] }})</span></a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</section>