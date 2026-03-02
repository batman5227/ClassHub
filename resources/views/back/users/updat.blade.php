@extends('layouts.master')
@section('content')
<div class="container-fluid px-4 py-5">
    <!-- En-tête avec gradient -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient-primary rounded-4 p-5 shadow-lg position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-user-edit fa-8x text-blue"></i>
                </div>
                <div class="position-absolute bottom-0 start-0 opacity-10">
                    <i class="fas fa-users fa-8x text-blue"></i>
                </div>

                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-blue opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('users.index') }}" class="text-blue opacity-75">Utilisateurs</a>
                                </li>
                                <li class="breadcrumb-item active text-blue" aria-current="page">Modification</li>
                            </ol>
                        </nav>

                        <h1 class="display-4 fw-bold text-blue mb-3">Modification d'un utilisateur</h1>
                        <p class="text-blue opacity-90 lead mb-4">
                            Modifiez les informations de l'utilisateur <span class="fw-bold bg-white text-primary px-3 py-1 rounded-pill">{{ $user->nom }} {{ $user->prenom }}</span>
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('users.index') }}" class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
                            <i class="fas fa-arrow-left me-2 text-primary"></i>Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire de modification -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 p-4">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-user-edit text-primary me-2"></i>
                        Modifier l'utilisateur
                    </h4>
                    <p class="text-muted mb-0 mt-1">
                        Modifiez les informations ci-dessous pour mettre à jour l'utilisateur
                    </p>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                       <!-- SECTION: PHOTO DE PROFIL -->
<div class="mb-4">
    <h5 class="text-primary mb-3 pb-2 border-bottom">
        <i class="fas fa-camera me-2"></i>Photo de profil
    </h5>

    <!-- Photo actuelle -->
    <div class="mb-3">
        <label class="form-label fw-semibold">Photo actuelle</label>
        <div class="bg-light rounded-3 p-3 text-center">
            @if($user->photo)
                <img src="{{ asset('storage/' . $user->photo) }}"
                     alt="{{ $user->nom }}"
                     class="rounded-circle"
                     style="width: 150px; height: 150px; object-fit: cover;">
            @else
                <div class="bg-secondary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                     style="width: 150px; height: 150px;">
                    <i class="fas fa-user fa-4x text-secondary"></i>
                </div>
                <p class="text-muted mt-2 mb-0">Aucune photo</p>
            @endif
        </div>
    </div>

    <!-- Nouvelle photo -->
    <div class="row">
        <div class="col-md-12">
            <label for="photo" class="form-label fw-semibold">
                <i class="fas fa-cloud-upload-alt text-primary me-2"></i>Changer la photo
            </label>
            <input type="file"
                   name="photo"
                   id="photo"
                   class="form-control form-control-lg @error('photo') is-invalid @enderror"
                   accept="image/*">
            @error('photo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="text-muted">Laissez vide pour conserver la photo actuelle</small>
        </div>
    </div>

    <!-- Aperçu de la nouvelle photo -->
    <div class="mt-3" id="preview-container" style="display: none;">
        <label class="form-label fw-semibold">Aperçu de la nouvelle photo</label>
        <div class="bg-light rounded-3 p-3 text-center">
            <img id="photo-preview" src="#" alt="Aperçu" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
        </div>
    </div>
</div>
                        <!-- SECTION 1: IDENTITÉ -->
                        <div class="mb-4">
                            <h5 class="text-primary mb-3 pb-2 border-bottom">
                                <i class="fas fa-id-card me-2"></i>Identité
                            </h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nom" class="form-label fw-semibold">
                                        <i class="fas fa-user text-primary me-2"></i>Nom
                                    </label>
                                    <input type="text"
                                           name="nom"
                                           id="nom"
                                           class="form-control form-control-lg @error('nom') is-invalid @enderror"
                                           placeholder="Nom de famille"
                                           value="{{ old('nom', $user->nom) }}"
                                           required>
                                    @error('nom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="prenom" class="form-label fw-semibold">
                                        <i class="fas fa-user text-primary me-2"></i>Prénom
                                    </label>
                                    <input type="text"
                                           name="prenom"
                                           id="prenom"
                                           class="form-control form-control-lg @error('prenom') is-invalid @enderror"
                                           placeholder="Prénom"
                                           value="{{ old('prenom', $user->prenom) }}"
                                           required>
                                    @error('prenom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 2: CONTACT -->
                        <div class="mb-4">
                            <h5 class="text-primary mb-3 pb-2 border-bottom">
                                <i class="fas fa-address-card me-2"></i>Contact
                            </h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label fw-semibold">
                                        <i class="fas fa-envelope text-primary me-2"></i>Email
                                    </label>
                                    <input type="email"
                                           name="email"
                                           id="email"
                                           class="form-control form-control-lg @error('email') is-invalid @enderror"
                                           placeholder="exemple@email.com"
                                           value="{{ old('email', $user->email) }}"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="telephone" class="form-label fw-semibold">
                                        <i class="fas fa-phone text-primary me-2"></i>Téléphone
                                    </label>
                                    <input type="tel"
                                           name="telephone"
                                           id="telephone"
                                           class="form-control form-control-lg @error('telephone') is-invalid @enderror"
                                           placeholder="+226 XX XX XX XX"
                                           value="{{ old('telephone', $user->telephone) }}"
                                           required>
                                    @error('telephone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 3: SÉCURITÉ & STATUT -->
                        <div class="mb-4">
                            <h5 class="text-primary mb-3 pb-2 border-bottom">
                                <i class="fas fa-shield-alt me-2"></i>Sécurité & Statut
                            </h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label fw-semibold">
                                        <i class="fas fa-lock text-primary me-2"></i>Nouveau mot de passe
                                    </label>
                                    <input type="password"
                                           name="password"
                                           id="password"
                                           class="form-control form-control-lg @error('password') is-invalid @enderror"
                                           placeholder="Laissez vide pour ne pas modifier">
                                    <small class="text-muted">Laissez vide pour conserver l'ancien mot de passe</small>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label fw-semibold">
                                        <i class="fas fa-lock text-primary me-2"></i>Confirmer le nouveau mot de passe
                                    </label>
                                    <input type="password"
                                           name="password_confirmation"
                                           id="password_confirmation"
                                           class="form-control form-control-lg"
                                           placeholder="Laissez vide pour ne pas modifier">
                                </div>
                            </div>

                            <!-- STATUT - Cartes élégantes avec la valeur actuelle pré-sélectionnée -->
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold text-primary mb-3">
                                        <i class="fas fa-toggle-on me-2"></i>Statut du compte
                                    </label>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="status-card {{ (old('status', $user->status) == 'actif') ? 'selected' : '' }}">
                                                <input type="radio"
                                                       name="status"
                                                       id="status_actif"
                                                       value="actif"
                                                       class="status-radio"
                                                       {{ (old('status', $user->status) == 'actif') ? 'checked' : '' }}
                                                       required>
                                                <label for="status_actif" class="status-label">
                                                    <div class="status-icon bg-success bg-opacity-10">
                                                        <i class="fas fa-check-circle text-success"></i>
                                                    </div>
                                                    <div class="status-content">
                                                        <h6 class="mb-1 fw-bold">Actif</h6>
                                                        <p class="text-muted small mb-0">
                                                            L'utilisateur peut se connecter et utiliser l'application
                                                        </p>
                                                    </div>
                                                    <div class="status-check">
                                                        <i class="fas fa-check-circle text-success"></i>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="status-card {{ (old('status', $user->status) == 'inactif') ? 'selected' : '' }}">
                                                <input type="radio"
                                                       name="status"
                                                       id="status_inactif"
                                                       value="inactif"
                                                       class="status-radio"
                                                       {{ (old('status', $user->status) == 'inactif') ? 'checked' : '' }}>
                                                <label for="status_inactif" class="status-label">
                                                    <div class="status-icon bg-warning bg-opacity-10">
                                                        <i class="fas fa-ban text-warning"></i>
                                                    </div>
                                                    <div class="status-content">
                                                        <h6 class="mb-1 fw-bold">Inactif</h6>
                                                        <p class="text-muted small mb-0">
                                                            L'utilisateur ne peut pas se connecter à l'application
                                                        </p>
                                                    </div>
                                                    <div class="status-check">
                                                        <i class="fas fa-check-circle text-warning"></i>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @error('status')
                                        <div class="text-danger small mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- BOUTONS D'ACTION -->
                        <div class="d-flex justify-content-between align-items-center mt-4 pt-4 border-top">
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-lg px-5 rounded-pill">
                                <i class="fas fa-times me-2"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill shadow-primary hover-lift">
                                <i class="fas fa-save me-2"></i>Mettre à jour l'utilisateur
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Aperçu de la nouvelle photo
    document.getElementById('photo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('photo-preview').src = e.target.result;
                document.getElementById('preview-container').style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            document.getElementById('preview-container').style.display = 'none';
        }
    });
</script>
@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .text-blue {
        color: #ffffff !important;
    }

    .hover-lift {
        transition: transform 0.2s;
    }

    .hover-lift:hover {
        transform: translateY(-2px);
    }

    .shadow-primary {
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    .opacity-10 {
        opacity: 0.1;
    }

    .opacity-75 {
        opacity: 0.75;
    }

    .opacity-90 {
        opacity: 0.9;
    }

    .bg-opacity-20 {
        --bs-bg-opacity: 0.2;
    }

    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    /* STYLES POUR LES CARTES DE STATUT */
    .status-card {
        position: relative;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .status-radio {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .status-label {
        display: flex;
        align-items: center;
        padding: 1rem;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        background: white;
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
    }

    .status-card:hover .status-label {
        border-color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.1);
    }

    .status-card.selected .status-label {
        border-color: #667eea;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
    }

    .status-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        flex-shrink: 0;
    }

    .status-icon i {
        font-size: 24px;
    }

    .status-content {
        flex-grow: 1;
    }

    .status-check {
        opacity: 0;
        transition: opacity 0.3s ease;
        margin-left: 1rem;
    }

    .status-check i {
        font-size: 24px;
    }

    .status-card.selected .status-check {
        opacity: 1;
    }

    .status-radio:checked + .status-label {
        border-color: #667eea;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
    }

    .status-radio:checked + .status-label .status-check {
        opacity: 1;
    }
</style>
@endpush
@endsection
