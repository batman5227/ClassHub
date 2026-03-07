@extends('layouts.master')

@section('content')
<div class="container-fluid px-4 py-5">
    <!-- En-tête avec gradient -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient rounded-4 p-5 shadow-lg position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-plus-circle fa-8x text-blue"></i>
                </div>
                <div class="position-absolute bottom-0 start-0 opacity-10">
                    <i class="fas fa-map-marker-alt fa-8x text-blue"></i>
                </div>

                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-blue opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('sites.index') }}" class="text-blue opacity-75">Sites</a>
                                </li>
                                <li class="breadcrumb-item active text-blue" aria-current="page">Création</li>
                            </ol>
                        </nav>

                        <h1 class="display-4 fw-bold text-blue mb-3">Création d'un site</h1>
                        <p class="text-blue opacity-90 lead mb-4">
                            Ajoutez un nouveau site à l'application
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('sites.index') }}" class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
                            <i class="fas fa-arrow-left me-2 text-primary"></i>Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 p-4">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-plus-circle text-primary me-2"></i>
                        Nouveau site
                    </h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('sites.store') }}" method="POST">
                        @csrf

                        <!-- Nom -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Nom du site</label>
                            <input type="text" name="nom" class="form-control form-control-lg @error('nom') is-invalid @enderror" value="{{ old('nom') }}" required>
                            @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Localisation (champ caché) -->
                        <input type="hidden" name="localisation" id="localisation" value="{{ old('localisation') }}">

                        <!-- Carte -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Position sur la carte</label>
                            <div id="map" style="height: 400px; width: 100%; border-radius: 8px; border: 2px solid #e9ecef;"></div>
                            <div class="mt-2">
                                <span class="badge bg-primary bg-opacity-10 text-primary p-2" id="coordinatesDisplay">
                                    <i class="fas fa-map-pin me-1"></i>Aucune sélection
                                </span>
                            </div>
                        </div>

                        <!-- Cours d'appui associé (select) -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Cours d'appui associé</label>
                            <select name="idCoursDappuie" class="form-select form-select-lg @error('idCoursDappuie') is-invalid @enderror">
                                <option value="">-- Aucun cours associé --</option>
                                @foreach($coursDappuie as $cours)
                                    <option value="{{ $cours->id }}" {{ old('idCoursDappuie') == $cours->id ? 'selected' : '' }}>
                                        {{ $cours->nom }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Sélectionnez le cours d'appui lié à ce site (optionnel)</small>
                            @error('idCoursDappuie') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Boutons -->
                        <div class="d-flex gap-3">
                            <a href="{{ route('sites.index') }}" class="btn btn-outline-secondary btn-lg px-5 rounded-pill">Annuler</a>
                            <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill">Créer le site</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // Carte ultra simple
    document.addEventListener('DOMContentLoaded', function() {
        // Coordonnées par défaut (Ouagadougou)
        const defaultLat = 12.3714;
        const defaultLng = -1.5197;

        // Initialiser la carte
        const map = L.map('map').setView([defaultLat, defaultLng], 13);

        // Ajouter les tuiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Forcer le redimensionnement
        setTimeout(() => map.invalidateSize(), 200);

        // Marqueur
        let marker = null;
        const locField = document.getElementById('localisation');

        // Si des coordonnées existent déjà
        if (locField.value) {
            const parts = locField.value.split(',');
            if (parts.length === 2) {
                const lat = parseFloat(parts[0]);
                const lng = parseFloat(parts[1]);
                if (!isNaN(lat) && !isNaN(lng)) {
                    marker = L.marker([lat, lng]).addTo(map);
                    map.setView([lat, lng], 15);
                    document.getElementById('coordinatesDisplay').innerHTML =
                        `<i class="fas fa-map-pin me-1"></i>Lat: ${lat.toFixed(6)}, Lng: ${lng.toFixed(6)}`;
                }
            }
        }

        // Clic sur la carte
        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;

            if (marker) map.removeLayer(marker);
            marker = L.marker([lat, lng]).addTo(map);

            locField.value = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;

            document.getElementById('coordinatesDisplay').innerHTML =
                `<i class="fas fa-map-pin me-1"></i>Lat: ${lat.toFixed(6)}, Lng: ${lng.toFixed(6)}`;
        });

        // Redimensionnement
        window.addEventListener('resize', () => map.invalidateSize());
    });
</script>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .hover-lift { transition: transform 0.2s; }
    .hover-lift:hover { transform: translateY(-2px); }
    .form-control:focus, .btn:focus, .form-select:focus {
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        border-color: #667eea;
    }
    #map { background: #f8f9fa; }
    .form-select {
        padding: 0.75rem 1rem;
        font-size: 1rem;
    }
</style>
@endsection
