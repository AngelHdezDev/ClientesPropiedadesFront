@extends('layouts.app')


@section('title', 'Autos - VMS')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/autos-detail/autos-detail.css') }}">
@endpush


@section('content')

    <body>
        <!-- ── NAVBAR ── -->
        @include('Dashboard.partials._navbarTop')
        <x-dashboard.navbar-filters />

        <!-- ── BREADCRUMB ── -->
        <nav class="breadcrumb-bar" aria-label="breadcrumb">
            <div class="breadcrumb-inner">
                <a href="{{ route('dashboard') }}" title="Inicio">
                    <i class="bi bi-house-door"></i>
                </a>

                <i class="bi bi-chevron-right sep"></i>

                <a href="{{ route('autos.index', ['marcas[]' => $auto->marca->id_marca]) }}">
                    {{ $auto->marca->nombre }}
                </a>

                <i class="bi bi-chevron-right sep"></i>

                <span class="current">
                    {{ $auto->marca->nombre }} {{ $auto->modelo }} {{ $auto->year }}
                </span>
            </div>
        </nav>

        <!-- ── FULLSCREEN MODAL ── -->
        <div class="fs-modal" id="fsModal">
            <button class="fs-modal-close" onclick="closeFsModal()"><i class="bi bi-x-lg"></i></button>
            <button class="fs-modal-nav fs-modal-prev" onclick="fsNav(-1)"><i class="bi bi-chevron-left"></i></button>
            <img id="fsModalImg" src="" alt="">
            <button class="fs-modal-nav fs-modal-next" onclick="fsNav(1)"><i class="bi bi-chevron-right"></i></button>
            <div class="fs-counter" id="fsCounter"></div>
        </div>

        <!-- ── MAIN ── -->
        <div class="page-wrap">

            <!-- Car header -->
            <div class="car-header">
                <div>
                    <div class="brand-pill">
                        @if($auto->marca->imagen)
                            <img src="{{ config('app.admin_storage') . $marca->imagen }}" alt="{{ $auto->marca->nombre }}"
                                onerror="this.style.display='none'">
                        @endif
                        <span>{{ $auto->marca->nombre }}</span>
                        <i class="bi bi-check-circle-fill" style="color:var(--blue);font-size:0.75rem;"></i>
                    </div>
                    <h1 class="car-title">{{ $auto->marca->nombre }} {{ $auto->modelo }} {{ $auto->year }}</h1>
                    <div class="car-meta-row">
                        <span>{{ $auto->tipo }}</span>
                        <span class="dot"></span>
                        <span>{{ $auto->ocultar_kilometraje ? 'Km no disponible' : number_format($auto->kilometraje) . ' Km' }}</span>
                        @if($auto->year == date('Y'))
                            <span class="dot"></span>
                            <span class="badge-nuevo-header"><i class="bi bi-plus"></i> Nuevo 0km</span>
                        @endif
                        @if($auto->consignacion)
                            <span class="dot"></span>
                            <span class="badge-consignacion-header">En consignación</span>
                        @endif
                    </div>
                </div>
                <button class="btn-share" onclick="shareAuto()">
                    <i class="bi bi-share"></i> Compartir
                </button>
            </div>

            <!-- ── GALERÍA (fuera del detail-layout para edge-to-edge en mobile) ── -->
            <div class="gallery-wrap" id="gallerySection">
                <div class="gallery-main">
                    <img id="mainImg"
                        src="{{ env('ADMIN_STORAGE_URL') . ($auto->thumbnail->imagen ?? $auto->imagenes->first()?->imagen) }}"
                        alt="{{ $auto->marca->nombre }} {{ $auto->modelo }} {{ $auto->year }}" loading="eager"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                    <div class="fav-placeholder-car" style="display: none; 
                   width: 100%; 
                   aspect-ratio: 16 / 9; 
                   min-height: 300px; 
                   max-height: 600px; 
                   flex-direction: column; 
                   justify-content: center; 
                   align-items: center; 
                   background-color: #f8f9fa;
                   border-radius: 12px;">

                        <div class="placeholder-icon-circle"
                            style="width: 80px; height: 80px; display: flex; justify-content: center; align-items: center; background: white; border-radius: 50%; margin-bottom: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                            <i class="bi bi-image" style="font-size: 2.5rem; color: #adb5bd;"></i>
                        </div>

                        <span class="placeholder-text" style="color: #adb5bd; font-weight: 500; font-size: 1.1rem;">
                            Imagen no disponible
                        </span>
                    </div>
                    <button class="gallery-btn gallery-btn-expand" onclick="openFsModal(currentIndex)">
                        <i class="bi bi-arrows-angle-expand"></i>
                    </button>
                    <button class="gallery-btn gallery-btn-prev" onclick="galleryNav(-1)">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <button class="gallery-btn gallery-btn-next" onclick="galleryNav(1)">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                    <div class="gallery-counter" id="galleryCounter">1 / {{ $auto->imagenes->count() }}</div>
                    <button class="gallery-photos-btn" onclick="openFsModal(0)">
                        <i class="bi bi-images"></i> Ver todas ({{ $auto->imagenes->count() }})
                    </button>
                </div>
                <div class="gallery-thumbs" id="galleryThumbs">
                    @foreach($auto->imagenes as $index => $imagen)
                        <div class="thumb-item {{ $imagen->thumbnail ? 'active' : ($index === 0 ? 'active' : '') }}"
                            onclick="setGalleryIndex({{ $index }})">
                            <img src="{{ env('ADMIN_STORAGE_URL') . $imagen->imagen }}" alt="{{ $auto->modelo }}"
                                loading="lazy">
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- ── DETAIL LAYOUT ── -->
            <div class="detail-layout" style="margin-top:20px;">

                <!-- LEFT COLUMN -->
                <div>
                    <!-- Características -->
                    <div class="section-card">
                        <div class="section-title"><i class="bi bi-sliders"></i> Características</div>
                        <div class="specs-grid">
                            <div class="spec-item">
                                <div class="spec-icon-wrap"><i class="bi bi-speedometer2"></i></div>
                                <div>
                                    <div class="spec-label">Kilometraje</div>
                                    <div class="spec-value">
                                        {{ $auto->ocultar_kilometraje ? 'No disponible' : number_format($auto->kilometraje) . ' Km' }}
                                    </div>
                                </div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon-wrap"><i class="bi bi-fuel-pump"></i></div>
                                <div>
                                    <div class="spec-label">Combustible</div>
                                    <div class="spec-value">{{ $auto->combustible ?? '—' }}</div>
                                </div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon-wrap"><i class="bi bi-palette2"></i></div>
                                <div>
                                    <div class="spec-label">Color exterior</div>
                                    <div class="spec-value">{{ $auto->color ?? '—' }}</div>
                                </div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon-wrap"><i class="bi bi-gear"></i></div>
                                <div>
                                    <div class="spec-label">Transmisión</div>
                                    <div class="spec-value">{{ $auto->transmision ?? 'Automática' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($auto->descripcion)
                        <div class="section-card">
                            <div class="section-title"><i class="bi bi-file-text"></i> Descripción</div>
                            <p class="descripcion-text">{{ $auto->descripcion }}</p>
                        </div>
                    @endif

                    <!-- Similares — 3 cards, grid simple -->
                    <div class="similares-section">
                        <div class="similares-header">
                            <h3>Autos que te podrían interesar</h3>
                        </div>
                        <div class="similares-grid">
                            @foreach($autosSugeridos as $s)
                                <div class="similar-card"
                                    onclick="window.location.href='{{ route('autos.show', $s->id_auto) }}'"
                                    style="cursor: pointer;">
                                    {{-- Imagen del Auto (Thumbnail) --}}
                                    @if(isset($s->thumbnail->imagen))
                                        <img src="{{ env('ADMIN_STORAGE_URL') . $s->thumbnail->imagen }}"
                                            alt="{{ $s->marca->nombre }} {{ $s->modelo }}" loading="lazy"
                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                                        {{-- Este div nace oculto y solo se activa si la imagen de arriba falla (error 404) --}}
                                        <div class="fav-placeholder-car" style="display: none; height: 180px;">
                                            <div class="placeholder-icon-circle"><i class="bi bi-image"></i></div>
                                            <span class="placeholder-text">Imagen no disponible</span>
                                        </div>
                                    @else
                                        {{-- Si no hay imagen en BD, mostramos el placeholder de una vez --}}
                                        <div class="fav-placeholder-car" style="display: flex; height: 180px;">
                                            <div class="placeholder-icon-circle"><i class="bi bi-image"></i></div>
                                            <span class="placeholder-text">Imagen no disponible</span>
                                        </div>
                                    @endif


                                    <div class="fav-placeholder-car">
                                        <div class="placeholder-icon-circle">
                                            <i class="bi bi-image"></i>
                                        </div>
                                        <span class="placeholder-text">Imagen no disponible</span>
                                    </div>

                                    <div class="similar-card-body">
                                        <div class="similar-card-header">
                                            {{-- Título: Marca Modelo Año --}}
                                            <div class="similar-card-title">{{ $s->marca->nombre }} {{ $s->modelo }}
                                                {{ $s->year }}
                                            </div>

                                            {{-- Logo de la Marca --}}
                                            @if($s->marca->imagen)
                                                <img src="{{ env('ADMIN_STORAGE_URL') . $s->marca->imagen }}"
                                                    alt="{{ $s->marca->nombre }}" class="similar-brand-logo"
                                                    onerror="this.style.display='none'">
                                            @endif
                                        </div>

                                        {{-- Meta: Tipo | Kilometraje --}}
                                        <div class="similar-card-meta">
                                            {{ $s->tipo }} |
                                            {{ $s->ocultar_kilometraje ? 'Km no disponible' : number_format($s->kilometraje) . ' Km' }}
                                        </div>

                                        <div class="similar-price">
                                            ${{ number_format($s->precio, 0)  }}
                                            <small>MXN de contado</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div><!-- end left -->

                <!-- RIGHT SIDEBAR -->
                <div class="sidebar-right">
                    <div class="price-card">
                        <div class="price-card-top">
                            <div class="price-card-label">Precio de contado</div>
                            <div class="price-card-amount">
                                ${{ number_format($auto->precio, 0, ',', '.') }} <small>MXN</small>
                            </div>
                            <div class="price-card-badges">
                                @if($auto->consignacion)
                                    <span class="price-badge price-badge-red"><i class="bi bi-tag-fill"></i> En
                                        consignación</span>
                                @endif
                                <span class="price-badge price-badge-green"><i class="bi bi-shield-check"></i> Precio
                                    verificado</span>
                            </div>
                        </div>
                        <div class="price-card-bottom">
                            <button class="btn-interesa"><i class="bi bi-chat-dots-fill"></i> Me interesa</button>
                            <button class="btn-whatsapp"><i class="bi bi-whatsapp"></i> Contactar por WhatsApp</button>
                            <p class="price-disclaimer">Precio sujeto a disponibilidad. Consulta condiciones con un asesor.
                            </p>
                        </div>
                    </div>

                    <div class="quick-facts">
                        <div class="quick-fact-item">
                            <span class="quick-fact-label"><i class="bi bi-calendar3"></i> Año</span>
                            <span class="quick-fact-value">{{ $auto->year }}</span>
                        </div>
                        <div class="quick-fact-item">
                            <span class="quick-fact-label"><i class="bi bi-speedometer2"></i> Kilometraje</span>
                            <span
                                class="quick-fact-value">{{ $auto->ocultar_kilometraje ? 'No disp.' : number_format($auto->kilometraje) . ' Km' }}</span>
                        </div>
                        <div class="quick-fact-item">
                            <span class="quick-fact-label"><i class="bi bi-fuel-pump"></i> Combustible</span>
                            <span class="quick-fact-value">{{ $auto->combustible ?? '—' }}</span>
                        </div>
                        <div class="quick-fact-item">
                            <span class="quick-fact-label"><i class="bi bi-gear"></i> Transmisión</span>
                            <span class="quick-fact-value">{{ $auto->transmision ?? 'Automática' }}</span>
                        </div>
                        <div class="quick-fact-item">
                            <span class="quick-fact-label"><i class="bi bi-palette2"></i> Color</span>
                            <span class="quick-fact-value">{{ $auto->color ?? '—' }}</span>
                        </div>
                    </div>
                </div><!-- end sidebar -->

            </div><!-- end detail-layout -->
        </div><!-- end page-wrap -->

        <!-- ── STICKY BOTTOM BAR (mobile) ── -->
        <div class="sticky-bar" id="stickyBar">
            <div class="sticky-bar-top">
                <div>
                    <div class="sticky-bar-price">
                        ${{ number_format($auto->precio, 0, ',', '.') }} <small>MXN</small>
                    </div>
                    <div class="sticky-bar-sublabel">Precio de contado</div>
                </div>
                <div class="sticky-bar-actions">
                    <button class="btn-sticky-wa"><i class="bi bi-whatsapp"></i> WhatsApp</button>
                    <button class="btn-sticky-cta">Me interesa</button>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            const carImages = @json($auto->imagenes->map(fn($img) => env('ADMIN_STORAGE_URL') . $img->imagen)->values());
            let currentIndex = 0;

            function setGalleryIndex(idx) {
                currentIndex = idx;
                const mainImg = document.getElementById('mainImg');
                mainImg.style.opacity = '0';
                setTimeout(() => { mainImg.src = carImages[idx]; mainImg.style.opacity = '1'; }, 150);
                document.querySelectorAll('.thumb-item').forEach((t, i) => t.classList.toggle('active', i === idx));
                document.getElementById('galleryCounter').textContent = `${idx + 1} / ${carImages.length}`;
                const activeThumb = document.querySelectorAll('.thumb-item')[idx];
                if (activeThumb) activeThumb.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
            }

            function galleryNav(dir) {
                let next = currentIndex + dir;
                if (next < 0) next = carImages.length - 1;
                if (next >= carImages.length) next = 0;
                setGalleryIndex(next);
            }

            function openFsModal(idx) {
                currentIndex = idx;
                document.getElementById('fsModalImg').src = carImages[idx];
                document.getElementById('fsCounter').textContent = `${idx + 1} / ${carImages.length}`;
                document.getElementById('fsModal').classList.add('open');
                document.body.style.overflow = 'hidden';
            }

            function closeFsModal() {
                document.getElementById('fsModal').classList.remove('open');
                document.body.style.overflow = '';
            }

            function fsNav(dir) {
                let next = currentIndex + dir;
                if (next < 0) next = carImages.length - 1;
                if (next >= carImages.length) next = 0;
                currentIndex = next;
                document.getElementById('fsModalImg').src = carImages[next];
                document.getElementById('fsCounter').textContent = `${next + 1} / ${carImages.length}`;
            }

            document.getElementById('fsModal').addEventListener('click', e => { if (e.target === e.currentTarget) closeFsModal(); });
            document.addEventListener('keydown', e => {
                if (!document.getElementById('fsModal').classList.contains('open')) return;
                if (e.key === 'ArrowRight') fsNav(1);
                if (e.key === 'ArrowLeft') fsNav(-1);
                if (e.key === 'Escape') closeFsModal();
            });

            function shareAuto() {
                if (navigator.share) {
                    navigator.share({ title: '{{ $auto->marca->nombre }} {{ $auto->modelo }} {{ $auto->year }}', url: window.location.href });
                } else {
                    navigator.clipboard?.writeText(window.location.href).then(() => alert('¡Enlace copiado!'));
                }
            }

            document.getElementById('mainImg').style.transition = 'opacity 0.15s ease';

        </script>
    </body>
@endsection