@extends('layouts.app')

@section('title', '{{ $property->title}} | CTP Realty')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link rel="stylesheet" href="{{ asset('css/propiedadDetalle.css') }}">

@endpush

@section('content')

    <body>
        <section class="gallery-section">
            @if($property->images && $property->images->count() > 0)
                <div class="gallery-container">
                    <div class="gallery-grid">
                        @foreach($property->images->take(5) as $index => $img)
                            <div class="gallery-item" onclick="openLightbox({{ $index }})">
                                <img src="{{ $img->url }}" alt="{{ $property->title }} - foto {{ $loop->iteration }}"
                                    loading="{{ $loop->first ? 'eager' : 'lazy' }}">
                                @if($loop->first && $property->images->count() > 1)
                                    <button class="gallery-view-all">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2">
                                            <rect x="3" y="3" width="18" height="18" rx="2" />
                                            <circle cx="8.5" cy="8.5" r="1.5" />
                                            <polyline points="21 15 16 10 5 21" />
                                        </svg>
                                        Ver {{ $property->images->count() }} fotos
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                @if($property->video_url || $property->virtual_tour_url)
                    <div class="gallery-extra-buttons">
                        @if($property->video_url)
                            <a href="{{ $property->video_url }}" target="_blank" class="gallery-btn-outline">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polygon points="5 3 19 12 5 21 5 3" />
                                </svg>
                                Ver video
                            </a>
                        @endif
                        @if($property->virtual_tour_url)
                            <a href="{{ $property->virtual_tour_url }}" target="_blank" class="gallery-btn-outline">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <polygon points="10 8 16 12 10 16 10 8" />
                                </svg>
                                Tour virtual
                            </a>
                        @endif
                    </div>
                @endif
            @else
                <div class="gallery-container">
                    <div class="gallery-grid">
                        <div class="gallery-placeholder">
                            <span class="gallery-placeholder-icon">🏠</span>
                            <span class="gallery-placeholder-text">No hay imágenes disponibles</span>
                        </div>
                    </div>
                </div>
            @endif
        </section>

        <!-- LIGHTBOX MODAL -->
        <div id="lightboxModal" class="lightbox-modal">
            <div class="lightbox-content">
                <button class="lightbox-close">&times;</button>
                <div class="swiper lightbox-swiper">
                    <div class="swiper-wrapper">
                        @foreach($property->images as $img)
                            <div class="swiper-slide">
                                <img src="{{ $img->url }}" alt="{{ $property->title }}">
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="lightbox-counter"></div>
                </div>
            </div>
        </div>

        <!-- CONTENIDO PRINCIPAL (resto de la página) -->
        <div class="page-content">
            <div class="property-main">
                <div class="top-bar">
                    <input type="hidden" name="latitude" id="lat" value="{{ old('latitude', $property->latitude) }}">
                    <input type="hidden" name="longitude" id="lng" value="{{ old('longitude', $property->longitude) }}">
                    <div class="breadcrumb">
                        <a href="/">Inicio</a>
                        <span>›</span>
                        <a href="/propiedades">Propiedades</a>
                        <span>›</span>
                        <span class="current">{{ $property->title }}</span>
                    </div>
                    <div class="status-badges">
                        <span class="badge badge-type">{{ $property->type }}</span>
                        <span class="badge badge-sale">En {{ $property->contract_type }}</span>
                        @if ($property->is_featured == 1)
                            <span class="badge badge-featured">Destacado</span>
                        @endif
                    </div>
                </div>

                <div class="property-header-block">
                    <div class="property-price-big">${{ number_format($property->price, 0, ',', '.') }} <span>MXN</span>
                    </div>
                    <h1 class="property-title-big">{{ $property->title }}</h1>
                    <div class="property-location-big">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        {{ Str::limit($property->address, 40) }}
                        {{ Str::limit($property->neighborhood, 40) }},
                        {{ Str::limit($property->city, 40) }},
                        {{ Str::limit($property->state, 40) }}
                    </div>
                    <div class="quick-stats">
                        <div class="stat-item">
                            <div class="stat-value">{{ $property->bedrooms }}</div>
                            <div class="stat-label">Recámaras</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ $property->bathrooms }}</div>
                            <div class="stat-label">Baños</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ number_format($property->m2_construction, 0, ',', '.') }}</div>
                            <div class="stat-label">m² construidos</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ $property->parking_spots }}</div>
                            <div class="stat-label">Cajones</div>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <div class="detail-section-title">Descripción</div>
                    <div class="property-description clamped" id="propDesc">
                        {{ $property->description }}
                    </div>
                    <button class="btn-read-more" onclick="toggleDesc()">Leer más <svg width="16" height="16"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9" />
                        </svg></button>
                </div>

                <div class="detail-section">
                    <div class="detail-section-title">Características</div>
                    <div class="features-grid">
                        <div class="feature-item">
                            <div class="stat-icon">🏗️</div>
                            <div>
                                <div class="stat-label">Tipo</div>
                                <div class="stat-value">{{ $property->type }}</div>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="stat-icon">🛏️</div>
                            <div>
                                <div class="stat-label">Recámaras</div>
                                <div class="stat-value">{{ $property->bedrooms }}</div>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="stat-icon">🛁</div>
                            <div>
                                <div class="stat-label">Baños</div>
                                <div class="stat-value">{{ $property->bathrooms }}</div>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="stat-icon">📐</div>
                            <div>
                                <div class="stat-label">Construcción</div>
                                <div class="stat-value">{{ number_format($property->m2_construction, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="stat-icon">🌳</div>
                            <div>
                                <div class="stat-label">Terreno</div>
                                <div class="stat-value">{{ number_format($property->m2_land, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="stat-icon">🚗</div>
                            <div>
                                <div class="stat-label">Estacionamiento</div>
                                <div class="stat-value">{{ $property->parking_spots }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <div class="detail-section-title">Amenidades</div>
                    <div class="amenities-grid">
                        @foreach($property->amenities as $amenity)
                            <div class="amenity-item">
                                @if(str_contains($amenity->icon, 'bi-'))
                                    <i class="{{ $amenity->icon }}"></i>
                                @else
                                    <span>{{ $amenity->icon }}</span> {{-- Aquí se pintará el emoji 🌳 --}}
                                @endif
                                <span>{{ $amenity->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="detail-section">
                    <div class="detail-section-title">
                        <i class="bi bi-geo-alt"></i> Ubicación
                    </div>
                    <div class="map-container">
                        <div id="map" style="height: 400px; width: 100%; border-radius: 8px;"></div>
                    </div>
                </div>
            </div>

            <aside class="property-sidebar">
                <div class="price-card">
                    <div class="price-card-price">${{ number_format($property->price, 0, ',', '.') }} <span>MXN</span></div>
                    <div class="sidebar-facts">
                        <div><span class="stat-value">{{ $property->bedrooms }}</span>
                            <div class="stat-label">Rec.</div>
                        </div>
                        <div><span class="stat-value">{{ $property->bathrooms }}</span>
                            <div class="stat-label">Baños</div>
                        </div>
                        <div><span class="stat-value">{{ $property->m2_construction }}</span>
                            <div class="stat-label">m²</div>
                        </div>
                        <div><span class="stat-value">{{ $property->parking_spots }}</span>
                            <div class="stat-label">Estac.</div>
                        </div>
                    </div>
                    <a href="tel:3336152664" class="btn-cta-primary">📞 Llamar ahora</a>
                    <a href="https://wa.me/523336152664" target="_blank" class="btn-cta-whatsapp">💬 WhatsApp</a>
                    <a href="#contactForm" class="btn-cta-outline">✉️ Enviar mensaje</a>
                </div>
                <div class="agent-card">
                    <div class="agent-title">Agente responsable </div>
                    <div class="agent-info">
                        {{-- Si existe el vendedor, muestra su avatar (o emoji) y su nombre --}}
                        <div class="agent-avatar">
                            {{ $property->seller ? '👤' : '🏢' }}
                        </div>
                        <div>
                            <div class="agent-name">
                                {{ $property->seller?->name ?? 'Oficina Central CTP' }}
                            </div>
                            <div class="agent-role">
                                {{ $property->seller ? 'Asesor Inmobiliario' : 'Atención a clientes' }}
                            </div>
                        </div>
                    </div>

                    {{-- El teléfono parece ser el de la oficina, así que lo dejamos fijo o podrías validarlo también --}}
                    <a href="tel:3336152664" class="agent-phone">📞 333 615 2664</a>
                </div>
                <div class="contact-card" id="contactForm">
                    <h4>¿Te interesa?</h4>
                    <p>Déjanos tus datos y te contactamos.</p>
                    <form>
                        <input type="text" class="contact-form-input" placeholder="Tu nombre" required>
                        <input type="tel" class="contact-form-input" placeholder="Tu teléfono" required>
                        <input type="email" class="contact-form-input" placeholder="Tu email">
                        <textarea class="contact-form-textarea" placeholder="Me interesa esta propiedad..."></textarea>
                        <button type="submit" class="btn-contact-send">Enviar mensaje</button>
                    </form>
                </div>
            </aside>
        </div>

        <!-- Mobile sticky bar -->
        <div class="mobile-sticky-bar">
            <div class="msb-price">$ <small>MXN</small></div>
            <div class="msb-btns" style="display:flex; gap:12px; margin-top:12px;">
                <a href="tel:3336152664" class="msb-btn-primary"
                    style="flex:1; background:var(--ctp-blue); color:white; padding:14px; border-radius:12px; text-align:center; text-decoration:none;">📞
                    Llamar</a>
                <a href="https://wa.me/523336152664" target="_blank" class="msb-btn-wa"
                    style="flex:1; background:#25d366; color:white; padding:14px; border-radius:12px; text-align:center; text-decoration:none;">💬
                    WhatsApp</a>
            </div>
        </div>

        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            // Header scroll effect
            window.addEventListener('scroll', () => document.getElementById('header').classList.toggle('scrolled', window.scrollY > 50));

            // Toggle description
            function toggleDesc() {
                const desc = document.getElementById('propDesc');
                const btn = document.querySelector('.btn-read-more');
                desc.classList.toggle('clamped');
                btn.innerHTML = desc.classList.contains('clamped')
                    ? 'Leer más <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>'
                    : 'Leer menos <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="transform:rotate(180deg)"><polyline points="6 9 12 15 18 9"/></svg>';
            }

            // Lightbox logic
            let lightboxSwiper = null;
            function openLightbox(initialIndex = 0) {
                const modal = document.getElementById('lightboxModal');
                if (!modal) return;
                if (lightboxSwiper) lightboxSwiper.destroy(true, true);
                lightboxSwiper = new Swiper('.lightbox-swiper', {
                    loop: true,
                    navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
                    initialSlide: initialIndex,
                    on: { slideChange: function () { document.querySelector('.lightbox-counter').textContent = (this.realIndex + 1) + ' / {{ $property->images->count() }}'; } }
                });
                document.querySelector('.lightbox-counter').textContent = (initialIndex + 1) + ' / {{ $property->images->count() }}';
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }
            function closeLightbox() {
                const modal = document.getElementById('lightboxModal');
                if (modal) {
                    modal.style.display = 'none';
                    document.body.style.overflow = '';
                    if (lightboxSwiper) { lightboxSwiper.destroy(true, true); lightboxSwiper = null; }
                }
            }
            document.addEventListener('DOMContentLoaded', () => {
                const modal = document.getElementById('lightboxModal');
                const closeBtn = modal?.querySelector('.lightbox-close');
                closeBtn?.addEventListener('click', closeLightbox);
                modal?.addEventListener('click', (e) => { if (e.target === modal) closeLightbox(); });
                document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && modal?.style.display === 'flex') closeLightbox(); });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const lat = {{ $property->latitude }};
                const lng = {{ $property->longitude }};

                const map = L.map('map-detail', {
                    dragging: !L.Browser.mobile,
                    scrollWheelZoom: false,
                    touchZoom: true,
                    fadeAnimation: true
                }).setView([lat, lng], 16);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap'
                }).addTo(map);

                L.marker([lat, lng]).addTo(map)
                    .bindPopup('<b>{{ $property->title }}</b><br>{{ $property->neighborhood }}')
                    .openPopup();

                // 1. Ejecución inmediata tras carga de ventana
                window.onload = () => {
                    map.invalidateSize();
                };

                // 2. Ejecución de seguridad con un pequeño delay
                setTimeout(() => {
                    map.invalidateSize(true);
                }, 600);
            });
        </script>

    </body>

@endsection 

@push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_api_key') }}"></script>

    <script>
        function initMap() {
            // Coordenadas desde tu modelo
            const pos = { 
                lat: {{ $property->latitude }}, 
                lng: {{ $property->longitude }} 
            };

            const map = new google.maps.Map(document.getElementById("map"), {
                center: pos,
                zoom: 17,
                mapTypeControl: false,
                streetViewControl: false, // Opcional: quita el monito de Street View
                fullscreenControl: true
            });

            // Marcador Estático
            new google.maps.Marker({
                position: pos,
                map: map,
                draggable: false // Aseguramos que no se pueda mover
            });
        }

        google.maps.event.addDomListener(window, 'load', initMap);
    </script>
@endpush