<div>
    @push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    @endpush

    <main>
        <section class="py-5 bg-light">
            <div class="container">
                <h1 class="text-center mb-4 display-4 fw-bold">Entre em Contato</h1>
                <p class="text-center mb-5 lead">Tem alguma dúvida ou sugestão? Estamos aqui para ajudar!</p>
                
                <div class="row g-4">
                    <!-- Coluna de Informações -->
                    <div class="col-lg-6">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body p-4">
                                <h2 class="card-title mb-4 display-6 text-primary-priod">Informações de Contato</h2>
                                
                                <div class="d-flex align-items-start mb-4">
                                    <div class="contact-icon me-3">
                                        <i class="bi bi-telephone-fill text-primary-priod fs-4"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Telefone/WhatsApp</h5>
                                        <p class="mb-0">{{$priod->whatsapp}} | {{$priod->contacto}}</p>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-start mb-4">
                                    <div class="contact-icon me-3">
                                        <i class="bi bi-envelope-fill text-primary-priod fs-4"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Email</h5>
                                        <p class="mb-0">{{$priod->email}}</p>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-start mb-4">
                                    <div class="contact-icon me-3">
                                        <i class="bi bi-geo-alt-fill text-primary-priod fs-4"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Endereço</h5>
                                        <p class="mb-0">Caponte, Lobito, Benguela, Angola</p>
                                    </div>
                                </div>
                                
                                <div class="mt-4">
                                    <h5 class="mb-3">Horário de Funcionamento</h5>
                                    <p><i class="bi bi-clock text-primary-priod me-2"></i> Segunda a Sexta: 08:00 - 18:00</p>
                                    <p><i class="bi bi-clock text-primary-priod me-2"></i> Sábado: 09:00 - 13:00</p>
                                </div>
                                
                                <div class="mt-4">
                                    <h5 class="mb-3">Redes Sociais</h5>
                                    <div class="d-flex">
                                        <a href="{{$priod->facebook_link}}" class="btn btn-outline-primary-priod btn-sm me-2 rounded-circle" target="_blank">
                                            <i class="bi bi-facebook"></i>
                                        </a>
                                        <a href="{{$priod->instagram_link}}" class="btn btn-outline-primary-priod btn-sm me-2 rounded-circle" target="_blank">
                                            <i class="bi bi-instagram"></i>
                                        </a>
                                        <a href="{{$priod->linkedin_link}}" class="btn btn-outline-primary-priod btn-sm me-2 rounded-circle" target="_blank">
                                            <i class="bi bi-linkedin"></i>
                                        </a>
                                        <a href="https://wa.me/{{$priod->whatsapp}}" class="btn btn-outline-primary-priod btn-sm rounded-circle" target="_blank">
                                            <i class="bi bi-whatsapp"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Coluna do Formulário -->
                    <div class="col-lg-6">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body p-4">
                                <h2 class="card-title mb-4 display-6 text-primary-priod">Envie-nos uma Mensagem</h2>
                                
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                
                                <form action="{{ route('enviar-mensagem') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nome" class="form-label">Nome Completo</label>
                                        <input type="text" class="form-control" id="nome" name="nome" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="assunto" class="form-label">Assunto</label>
                                        <input type="text" class="form-control" id="assunto" name="assunto" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="mensagem" class="form-label">Mensagem</label>
                                        <textarea class="form-control" id="mensagem" name="mensagem" rows="5" required></textarea>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary-priod btn-lg w-100">
                                        <i class="bi bi-send me-2"></i> Enviar Mensagem
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Mapa Interativo -->
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary-priod text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-geo-alt-fill me-2"></i> 
                                        <strong>Nossa Localização - Caponte, Lobito</strong>
                                    </div>
                                    <div>
                                        <button id="findMeBtn" class="btn btn-light btn-sm">
                                            <i class="bi bi-crosshair me-1"></i> Encontrar-me
                                        </button>
                                        <button id="getDirectionsBtn" class="btn btn-outline-light btn-sm" style="display: none;">
                                            <i class="bi bi-signpost-2 me-1"></i> Como Chegar
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <!-- Mapa Leaflet -->
                                <div id="map" style="height: 400px; width: 100%;"></div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div id="locationInfo" class="text-muted">
                                            <i class="bi bi-info-circle me-1"></i>
                                            Clique em "Encontrar-me" para ver sua localização e calcular a distância
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <small class="text-muted">
                                            <a href="https://www.google.com/maps?q=-12.3604,13.5497" 
                                               target="_blank" 
                                               class="text-decoration-none">
                                                <i class="bi bi-box-arrow-up-right me-1"></i>
                                                Abrir no Google Maps
                                            </a>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
    // Coordenadas do PRIOD
    const priodLocation = [-12.3604, 13.5497];
    let map, userMarker, priodMarker;
    let userLocation = null;

    // Inicializar mapa quando a página carregar
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(initMap, 100);
    });

    function initMap() {
        if (typeof L === 'undefined') {
            setTimeout(initMap, 500);
            return;
        }

        const mapElement = document.getElementById('map');
        if (!mapElement) return;

        try {
            map = L.map('map').setView(priodLocation, 13);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);
            
            priodMarker = L.marker(priodLocation)
                .addTo(map)
                .bindPopup(`
                    <div class="text-center">
                        <strong>🏢 PRIOD</strong><br>
                        <small>Centro Técnico Profissional de Excelência</small><br>
                        <small>Caponte, Lobito, Benguela</small>
                    </div>
                `)
                .openPopup();
        } catch (error) {
            console.error('Erro ao inicializar mapa:', error);
        }
    }

    // Event listeners
    document.addEventListener('click', function(e) {
        if (e.target.id === 'findMeBtn' || e.target.closest('#findMeBtn')) {
            findUserLocation();
        }

        if (e.target.id === 'getDirectionsBtn' || e.target.closest('#getDirectionsBtn')) {
            if (userLocation) {
                const url = `https://www.google.com/maps/dir/${userLocation[0]},${userLocation[1]}/${priodLocation[0]},${priodLocation[1]}`;
                window.open(url, '_blank');
            }
        }
    });

    function findUserLocation() {
        const btn = document.getElementById('findMeBtn');
        const originalText = btn.innerHTML;
        
        btn.innerHTML = '<i class="bi bi-arrow-clockwise spin me-1"></i> Localizando...';
        btn.disabled = true;
        
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    userLocation = [position.coords.latitude, position.coords.longitude];
                    showUserLocation(userLocation);
                    calculateDistance();
                    btn.innerHTML = '<i class="bi bi-check-circle me-1"></i> Localizado!';
                    document.getElementById('getDirectionsBtn').style.display = 'inline-block';
                    
                    setTimeout(() => {
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    }, 2000);
                },
                function(error) {
                    let errorMsg = 'Erro ao obter localização';
                    switch(error.code) {
                        case error.PERMISSION_DENIED:
                            errorMsg = 'Permissão negada para acessar localização';
                            break;
                        case error.POSITION_UNAVAILABLE:
                            errorMsg = 'Localização não disponível';
                            break;
                        case error.TIMEOUT:
                            errorMsg = 'Tempo limite excedido';
                            break;
                    }
                    
                    document.getElementById('locationInfo').innerHTML = 
                        `<i class="bi bi-exclamation-triangle text-warning me-1"></i> ${errorMsg}`;
                    
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                },
                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 60000
                }
            );
        } else {
            document.getElementById('locationInfo').innerHTML = 
                '<i class="bi bi-x-circle text-danger me-1"></i> Geolocalização não suportada pelo navegador';
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
    }

    function showUserLocation(coords) {
        if (!map) return;
        
        if (userMarker) {
            map.removeLayer(userMarker);
        }
        
        userMarker = L.marker(coords, {
            icon: L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            })
        })
        .addTo(map)
        .bindPopup(`
            <div class="text-center">
                <strong>📍 Sua Localização</strong><br>
                <small>Lat: ${coords[0].toFixed(6)}</small><br>
                <small>Lng: ${coords[1].toFixed(6)}</small>
            </div>
        `);
        
        const group = new L.featureGroup([priodMarker, userMarker]);
        map.fitBounds(group.getBounds().pad(0.1));
    }

    function calculateDistance() {
        if (!userLocation) return;
        
        const distance = getDistanceFromLatLonInKm(
            userLocation[0], userLocation[1],
            priodLocation[0], priodLocation[1]
        );
        
        document.getElementById('locationInfo').innerHTML = `
            <div class="d-flex align-items-center">
                <i class="bi bi-geo-alt text-success me-2"></i>
                <div>
                    <strong>Distância até o PRIOD: ${distance.toFixed(2)} km</strong><br>
                    <small class="text-muted">Tempo estimado: ${getEstimatedTime(distance)}</small>
                </div>
            </div>
        `;
    }

    function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
        const R = 6371;
        const dLat = deg2rad(lat2 - lat1);
        const dLon = deg2rad(lon2 - lon1);
        const a = 
            Math.sin(dLat/2) * Math.sin(dLat/2) +
            Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
            Math.sin(dLon/2) * Math.sin(dLon/2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        return R * c;
    }

    function deg2rad(deg) {
        return deg * (Math.PI/180);
    }

    function getEstimatedTime(distance) {
        const walkingTime = Math.round(distance * 12);
        const drivingTime = Math.round(distance * 2);
        
        if (distance < 1) {
            return `${walkingTime} min a pé`;
        } else if (distance < 5) {
            return `${drivingTime} min de carro / ${walkingTime} min a pé`;
        } else {
            return `${drivingTime} min de carro`;
        }
    }

    // CSS para animação
    const style = document.createElement('style');
    style.textContent = `
        .spin {
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    `;
    document.head.appendChild(style);
    </script>
    @endpush
</div>
