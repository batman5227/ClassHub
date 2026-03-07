@extends('layouts.master')

@section('title')
    Modifier un Élève - ClassHub
@endsection

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

<div class="container-fluid px-4 py-5">

    <!-- En-tête avec dégradé (orange/rose pour modification) -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient rounded-4 p-5 shadow-lg position-relative overflow-hidden"
                 style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-user-graduate fa-8x text-white"></i>
                </div>
                <div class="position-absolute bottom-0 start-0 opacity-10">
                    <i class="fas fa-edit fa-8x text-white"></i>
                </div>
                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-white opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('eleves.index') }}" class="text-white opacity-75">Élèves</a>
                                </li>
                                <li class="breadcrumb-item active text-white" aria-current="page">Modifier</li>
                            </ol>
                        </nav>
                        <h1 class="display-4 fw-bold text-white mb-3">Modifier un élève</h1>
                        <p class="text-white opacity-90 lead mb-4">{{ $eleve->prenom }} {{ $eleve->nom }}</p>
                        <div class="d-flex gap-3">
                            <div class="bg-white bg-opacity-20 rounded-3 px-4 py-2">
                                <small class="text-white opacity-75 d-block">ID Élève</small>
                                <span class="text-white fw-bold">{{ substr($eleve->id, 0, 8) }}...</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('eleves.index') }}"
                           class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
                            <i class="fas fa-arrow-left me-2 text-primary"></i>Retour à la liste
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
                        <i class="fas fa-edit text-primary me-2"></i>Modifier les informations
                    </h4>
                    <p class="text-muted mb-0 mt-1">Modifiez les informations de l'élève dans le système</p>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('eleves.update', $eleve->id) }}" method="POST" id="editEleveForm">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <!-- Nom -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nom" class="form-label fw-semibold">
                                        <i class="fas fa-user text-primary me-2"></i>Nom
                                    </label>
                                    <input type="text"
                                           class="form-control form-control-lg rounded-4 @error('nom') is-invalid @enderror"
                                           id="nom"
                                           name="nom"
                                           value="{{ old('nom', $eleve->nom) }}"
                                           placeholder="Ex: Dupont"
                                           required>
                                    @error('nom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Prénom -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="prenom" class="form-label fw-semibold">
                                        <i class="fas fa-user text-primary me-2"></i>Prénom
                                    </label>
                                    <input type="text"
                                           class="form-control form-control-lg rounded-4 @error('prenom') is-invalid @enderror"
                                           id="prenom"
                                           name="prenom"
                                           value="{{ old('prenom', $eleve->prenom) }}"
                                           placeholder="Ex: Jean"
                                           required>
                                    @error('prenom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">
                                        <i class="fas fa-envelope text-primary me-2"></i>Email
                                    </label>
                                    <input type="email"
                                           class="form-control form-control-lg rounded-4 @error('email') is-invalid @enderror"
                                           id="email"
                                           name="email"
                                           value="{{ old('email', $eleve->email) }}"
                                           placeholder="Ex: jean.dupont@email.com"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">L'email sera utilisé pour la connexion</small>
                                </div>
                            </div>

                            <!-- Numéro du parent -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="numParent" class="form-label fw-semibold">
                                        <i class="fas fa-phone text-primary me-2"></i>Numéro du parent
                                    </label>
                                    <input type="text"
                                           class="form-control form-control-lg rounded-4 @error('numParent') is-invalid @enderror"
                                           id="numParent"
                                           name="numParent"
                                           value="{{ old('numParent', $eleve->numParent) }}"
                                           placeholder="Ex: +33 6 12 34 56 78">
                                    @error('numParent')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Numéro de téléphone du parent (optionnel)</small>
                                </div>
                            </div>

                            <!-- Site -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="idSites" class="form-label fw-semibold">
                                        <i class="fas fa-building text-primary me-2"></i>Site
                                    </label>
                                    <select class="form-select form-select-lg rounded-4 @error('idSites') is-invalid @enderror"
                                            id="idSites"
                                            name="idSites"
                                            required>
                                        <option value="" disabled>Sélectionnez un site</option>
                                        @foreach($sites as $site)
                                            <option value="{{ $site->id }}"
                                                {{ old('idSites', $eleve->idSites) == $site->id ? 'selected' : '' }}>
                                                {{ $site->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('idSites')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Cours d'appui -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="idCoursDappuie" class="form-label fw-semibold">
                                        <i class="fas fa-book-open text-primary me-2"></i>Cours d'Appui
                                    </label>
                                    <select class="form-select form-select-lg rounded-4 @error('idCoursDappuie') is-invalid @enderror"
                                            id="idCoursDappuie"
                                            name="idCoursDappuie"
                                            required>
                                        <option value="" disabled>Sélectionnez un cours d'appui</option>
                                        @foreach($coursdappuies as $coursdappuie)
                                            <option value="{{ $coursdappuie->id }}"
                                                {{ old('idCoursDappuie', $eleve->idCoursDappuie) == $coursdappuie->id ? 'selected' : '' }}>
                                                {{ $coursdappuie->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('idCoursDappuie')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Classe -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="idClasse" class="form-label fw-semibold">
                                        <i class="fas fa-users text-primary me-2"></i>Classe
                                    </label>
                                    <select class="form-select form-select-lg rounded-4 @error('idClasse') is-invalid @enderror"
                                            id="idClasse"
                                            name="idClasse"
                                            required>
                                        <option value="" disabled>Sélectionnez une classe</option>
                                        @foreach($classes as $classe)
                                            <option value="{{ $classe->id }}"
                                                {{ old('idClasse', $eleve->idClasse) == $classe->id ? 'selected' : '' }}>
                                                {{ $classe->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('idClasse')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Avertissement de modification -->
                        <div class="alert alert-warning bg-warning bg-opacity-10 border-0 rounded-4 p-3 mb-4 mt-3">
                            <div class="d-flex">
                                <i class="fas fa-exclamation-triangle fa-2x text-warning me-3"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">⚠️ Attention - Modification en cours</h6>
                                    <p class="mb-0 small">La modification des informations peut affecter les inscriptions, les notes et le suivi de l'élève. Veuillez vérifier les informations avant de confirmer.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Récapitulatif des informations actuelles -->
                        <div class="bg-light rounded-4 p-4 mb-4">
                            <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2 text-primary"></i>Informations actuelles :</h6>
                            <div class="row g-3">
                                <div class="col-md-2">
                                    <small class="text-muted d-block">Nom complet</small>
                                    <span class="fw-semibold">{{ $eleve->prenom }} {{ $eleve->nom }}</span>
                                </div>
                                <div class="col-md-2">
                                    <small class="text-muted d-block">Email</small>
                                    <span class="fw-semibold">{{ $eleve->email }}</span>
                                </div>
                                <div class="col-md-2">
                                    <small class="text-muted d-block">Téléphone parent</small>
                                    <span class="fw-semibold">{{ $eleve->numParent ?? 'N/A' }}</span>
                                </div>
                                <div class="col-md-2">
                                    <small class="text-muted d-block">Site</small>
                                    <span class="fw-semibold">{{ $eleve->site->nom ?? 'N/A' }}</span>
                                </div>
                                <div class="col-md-2">
                                    <small class="text-muted d-block">Cours d'appui</small>
                                    <span class="fw-semibold">{{ $eleve->coursDappuie->nom ?? 'N/A' }}</span>
                                </div>
                                <div class="col-md-2">
                                    <small class="text-muted d-block">Classe</small>
                                    <span class="fw-semibold">{{ $eleve->classe->nom ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="d-flex gap-3 justify-content-end mt-4">
                            <a href="{{ route('eleves.index') }}"
                               class="btn btn-outline-secondary rounded-pill px-5 py-3">
                                <i class="fas fa-times me-2"></i>Annuler
                            </a>
                            <button type="submit"
                                    class="btn btn-warning rounded-pill px-5 py-3 shadow-sm hover-lift"
                                    id="btnSubmit">
                                <i class="fas fa-save me-2"></i>Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .form-control, .form-select {
        border: 2px solid #e9ecef;
        transition: all 0.2s ease;
        padding: 0.75rem 1rem;
    }
    .form-control:focus, .form-select:focus {
        border-color: #f093fb;
        box-shadow: 0 0 0 0.2rem rgba(240, 147, 251, 0.1);
        transform: translateY(-1px);
    }
    .form-control-lg, .form-select-lg {
        font-size: 1rem;
    }
    .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }
    .bg-opacity-20 {
        --bs-bg-opacity: 0.2;
    }
    .card {
        transition: all 0.3s ease;
    }
    label {
        margin-bottom: 0.5rem;
        color: #495057;
        font-size: 0.95rem;
    }
    .alert {
        border-left: 4px solid #ffc107;
    }
    .btn-warning {
        color: white;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        border: none;
    }
    .btn-warning:hover {
        background: linear-gradient(135deg, #e884f1 0%, #e44a5e 100%);
    }
    .btn-outline-secondary:hover {
        background-color: #f8f9fa;
        transform: translateY(-1px);
    }
</style>

<script>
(function() {
    // Attendre que SweetAlert soit chargé
    function waitForSwal(cb, tries = 0) {
        if (tries > 50) return;
        if (typeof Swal !== 'undefined') {
            cb();
        } else {
            setTimeout(function() { waitForSwal(cb, tries + 1); }, 100);
        }
    }

    // Initialisation des tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });

    // Confirmation avant modification
    document.getElementById('editEleveForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        var form = this;

        waitForSwal(function() {
            Swal.fire({
                title: 'Modifier cet élève ?',
                html: `
                    <div class="text-center">
                        <i class="fas fa-user-graduate text-warning fa-4x mb-3"></i>
                        <p class="fw-bold mb-2">${document.getElementById('prenom').value} ${document.getElementById('nom').value}</p>
                        <p class="text-muted small mb-1">Vous êtes sur le point de modifier les informations de cet élève.</p>
                        <div class="bg-light p-3 rounded-3 mt-3">
                            <div class="row text-start small">
                                <div class="col-6">
                                    <span class="text-muted">Email:</span><br>
                                    <span class="fw-semibold">${document.getElementById('email').value}</span>
                                </div>
                                <div class="col-6">
                                    <span class="text-muted">Classe:</span><br>
                                    <span class="fw-semibold">${document.getElementById('idClasse').options[document.getElementById('idClasse').selectedIndex]?.text || 'N/A'}</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-danger small mt-2">Cette action est irréversible.</p>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f093fb',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, modifier',
                cancelButtonText: 'Annuler',
                reverseButtons: true,
                focusCancel: true,
                customClass: {
                    popup: 'rounded-4 shadow-lg'
                }
            }).then(function(result) {
                if (result.isConfirmed) {
                    // Désactiver le bouton pour éviter les doubles soumissions
                    var btn = document.getElementById('btnSubmit');
                    btn.disabled = true;
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mise à jour en cours...';
                    form.submit();
                }
            });
        });
    });

    // Validation des champs en temps réel
    document.getElementById('nom')?.addEventListener('input', function() {
        this.value = this.value.replace(/[^a-zA-ZÀ-ÿ\s-]/g, '');
    });

    document.getElementById('prenom')?.addEventListener('input', function() {
        this.value = this.value.replace(/[^a-zA-ZÀ-ÿ\s-]/g, '');
    });

    document.getElementById('email')?.addEventListener('input', function() {
        this.value = this.value.toLowerCase().replace(/\s/g, '');
    });

    // Animation de focus sur les champs
    document.querySelectorAll('.form-control, .form-select').forEach(function(element) {
        element.addEventListener('focus', function() {
            this.closest('.mb-3')?.classList.add('focused');
        });
        element.addEventListener('blur', function() {
            this.closest('.mb-3')?.classList.remove('focused');
        });
    });

    // Confirmation avant de quitter sans sauvegarder
    let formModified = false;
    document.querySelectorAll('#editEleveForm input, #editEleveForm select').forEach(function(element) {
        element.addEventListener('change', function() {
            formModified = true;
        });
        element.addEventListener('input', function() {
            formModified = true;
        });
    });

    window.addEventListener('beforeunload', function(e) {
        if (formModified) {
            e.preventDefault();
            e.returnValue = '';
        }
    });
})();
</script>

@endsection
