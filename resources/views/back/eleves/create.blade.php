@extends('layouts.master')

@section('title')
    Ajouter un Élève
@endsection

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

<div class="container-fluid px-4 py-5">

    <!-- En-tête avec dégradé -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient rounded-4 p-5 shadow-lg position-relative overflow-hidden"
                 style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-user-graduate fa-8x text-blue"></i>
                </div>
                <div class="position-absolute bottom-0 start-0 opacity-10">
                    <i class="fas fa-plus-circle fa-8x text-blue"></i>
                </div>
                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-blue opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('eleves.index') }}" class="text-blue opacity-75">Élèves</a>
                                </li>
                                <li class="breadcrumb-item active text-blue" aria-current="page">Ajouter</li>
                            </ol>
                        </nav>
                        <h1 class="display-4 fw-bold text-blue mb-3">Ajouter un élève</h1>
                        <p class="text-blue opacity-90 lead mb-4">Inscrivez un nouvel élève dans l'établissement</p>
                        <div class="d-flex gap-3">
                            <div class="bg-white bg-opacity-20 rounded-3 px-4 py-2">
                                <small class="text-blue opacity-75 d-block">Nouvelle inscription</small>
                                <span class="text-blue fw-bold">Formulaire d'ajout</span>
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

    <!-- Formulaire -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 p-4">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-user-graduate text-primary me-2"></i>Informations de l'élève
                    </h4>
                    <p class="text-muted mb-0 mt-1">Remplissez tous les champs pour ajouter un nouvel élève</p>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('eleves.store') }}" method="POST" id="createEleveForm">
                        @csrf

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
                                           value="{{ old('nom') }}"
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
                                           value="{{ old('prenom') }}"
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
                                           value="{{ old('email') }}"
                                           placeholder="Ex: jean.dupont@email.com"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">L'email sera utilisé pour la connexion</small>
                                </div>
                            </div>


                            <!-- Téléphone Parent -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="telephoneParent" class="form-label fw-semibold">
                                        <i class="fas fa-phone-alt text-primary me-2"></i>Téléphone du parent
                                    </label>
                                    <input type="tel"
                                           class="form-control form-control-lg rounded-4 @error('telephoneParent') is-invalid @enderror"
                                           id="telephoneParent"
                                           name="telephoneParent"
                                           value="{{ old('telephoneParent') }}"
                                           placeholder="Ex: 70 12 34 56"
                                           required>
                                    @error('telephoneParent')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Numéro de téléphone du parent ou tuteur</small>
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
                                        <option value="" selected disabled>Sélectionnez un site</option>
                                        @foreach($sites as $site)
                                            <option value="{{ $site->id }}" {{ old('idSites') == $site->id ? 'selected' : '' }}>
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
                                        <option value="" selected disabled>Sélectionnez un cours d'appui</option>
                                        @foreach($coursdappuies as $coursdappuie)
                                            <option value="{{ $coursdappuie->id }}" {{ old('idCoursDappuie') == $coursdappuie->id ? 'selected' : '' }}>
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
                                        <option value="" selected disabled>Sélectionnez une classe</option>
                                        @foreach($classes as $classe)
                                            <option value="{{ $classe->id }}" {{ old('idClasse') == $classe->id ? 'selected' : '' }}>
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

                        <!-- Informations supplémentaires (optionnel) -->
                        <div class="alert alert-info bg-info bg-opacity-10 border-0 rounded-4 p-3 mb-4">
                            <div class="d-flex">
                                <i class="fas fa-info-circle fa-2x text-info me-3"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Information importante</h6>
                                    <p class="mb-0 small">Un email de confirmation sera envoyé à l'élève avec ses identifiants de connexion.</p>
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
                                    class="btn btn-primary rounded-pill px-5 py-3 shadow-sm hover-lift"
                                    id="btnSubmit">
                                <i class="fas fa-save me-2"></i>Enregistrer l'élève
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
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .hover-lift {
        transition: transform 0.2s ease;
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
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.1);
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
    }
    /* Animation pour les champs */
    .form-control, .form-select {
        position: relative;
    }
    .form-control:focus, .form-select:focus {
        transform: translateY(-1px);
    }
    /* Style pour les badges d'information */
    .alert {
        border-left: 4px solid #17a2b8;
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

    // Confirmation avant soumission du formulaire
    document.getElementById('createEleveForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        var form = this;

        waitForSwal(function() {
            Swal.fire({
                title: 'Ajouter cet élève ?',
                html: `
                    <div class="text-center">
                        <i class="fas fa-user-graduate text-primary fa-4x mb-3"></i>
                        <p class="mb-1">Vous êtes sur le point d'inscrire un nouvel élève.</p>
                        <p class="text-muted small">Vérifiez les informations avant de continuer.</p>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#667eea',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, ajouter',
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
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Inscription en cours...';
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

    document.getElementById('telephoneParent')?.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9+\s]/g, '');
    });

    // Animation de focus sur les champs
    document.querySelectorAll('.form-control, .form-select').forEach(function(element) {
        element.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        element.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });
})();
</script>

@endsection
