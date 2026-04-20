<section class="testimonial-section">
    <p class="hashtag">#TuSeminuevoEnUnClic</p>
    <h2 class="section-title text-center mb-4">Compra con confianza. Estas son<br>algunas experiencias reales.</h2>
    <div class="testimonial-grid">
        <div class="testimonial-card tall">
            <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=400&h=760&fit=crop&q=75"
                alt="Familia Gutiérrez" loading="lazy" width="400" height="380">
            <div class="testimonial-overlay"></div>
            <div class="testimonial-badge"><i class="bi bi-star-fill"></i> Guadalajara, Jal</div>
            <div class="testimonial-quote">
                <p>"El proceso fue rápido, claro y me entregaron el auto en excelentes condiciones."</p><small>Familia
                    Gutiérrez</small>
            </div>
        </div>
        <div class="testimonial-card short">
            <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=400&h=620&fit=crop&q=75"
                alt="Raúl López" loading="lazy" width="400" height="310">
            <div class="testimonial-overlay"></div>
            <div class="testimonial-badge"><i class="bi bi-star-fill"></i> Ciudad de México</div>
            <div class="testimonial-quote">
                <p>"Dalton Seminuevos es una opción ideal para estrenar auto a buen precio."</p><small>Raúl López y
                    Jorge Martínez</small>
            </div>
        </div>
        <div class="testimonial-card short">
            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=620&fit=crop&q=75"
                alt="Esteban Ortíz" loading="lazy" width="400" height="310">
            <div class="testimonial-overlay"></div>
            <div class="testimonial-badge"><i class="bi bi-star-fill"></i> San Luis Potosí</div>
            <div class="testimonial-quote">
                <p>"Me ayudaron a encontrar justo el auto que necesitaba y todo fue muy transparente."</p><small>Esteban
                    Ortíz</small>
            </div>
        </div>
        <div class="testimonial-card tall">
            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&h=760&fit=crop&q=75"
                alt="Angela Ramírez" loading="lazy" width="400" height="380">
            <div class="testimonial-overlay"></div>
            <div class="testimonial-badge"><i class="bi bi-star-fill"></i> Tepic, Nayarit</div>
            <div class="testimonial-quote">
                <p>"Muy buena atención. Recomiendo Dalton Seminuevos si buscas confianza y buen trato."</p><small>Angela
                    Ramírez</small>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <div class="google-rating-bar">
            <strong style="font-size:1rem;color:#4285f4">Google</strong>
            <span style="font-weight:700">Excelente</span>
            <span style="color:#f59e0b;font-size:1.1rem">★★★★★</span>
            <strong>4.8</strong>
            <span style="color:var(--dalton-muted);font-size:0.85rem">| 4411 reseñas</span>
        </div>
    </div>

    <div class="review-cards">
        @php
            $reviews = [
                ['initial' => 'J', 'color' => '#e8001c', 'name' => 'Juan Manuel Hernánd...', 'time' => 'hace 3 días', 'text' => 'La experiencia es muy satisfactoria y muy fácil hacer el trámite'],
                ['initial' => 'A', 'color' => '#6b7280', 'name' => 'Ara Fermoso', 'time' => 'hace 3 días', 'text' => 'Muy buena atención, amabilidad y explicación excelente a cualquier duda, gracias Carol Rodríguez por todo tu apoyo!!'],
                ['initial' => 'K', 'color' => '#1a2a4a', 'name' => 'Karina edith Gutierrez', 'time' => 'hace 3 días', 'text' => 'Excelente servicio y atención de nuestro vendedor MARTIN REGALADO'],
            ];
        @endphp
        @foreach($reviews as $r)
            <div class="review-card">
                <div class="review-card-header">
                    <div class="d-flex align-items-center gap-2">
                        <div class="reviewer-avatar" style="background:{{ $r['color'] }}">{{ $r['initial'] }}</div>
                        <div>
                            <div style="font-size:0.82rem;font-weight:700">{{ $r['name'] }}</div>
                            <div style="font-size:0.72rem;color:var(--dalton-muted)">{{ $r['time'] }}</div>
                        </div>
                    </div>
                    <i class="bi bi-google" style="color:#4285f4"></i>
                </div>
                <div class="review-stars">★★★★★ <i class="bi bi-check-circle-fill"
                        style="color:var(--dalton-blue);font-size:0.75rem"></i></div>
                <p class="review-text mt-2">{{ $r['text'] }}</p>
            </div>
        @endforeach
    </div>
    <div class="text-end mt-2">
        <small style="color:var(--dalton-muted);font-size:0.72rem">Verificado por: Trustindex ⓘ</small>
    </div>
</section>