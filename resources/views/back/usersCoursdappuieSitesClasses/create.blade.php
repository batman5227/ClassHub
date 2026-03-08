@extends('layouts.master')

@section('title')
    Nouvelle Association - ClassHub
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
                    <i class="fas fa-link fa-8x text-white"></i>
                </div>
                <div class="position-absolute bottom-0 start-0 opacity-10">
                    <i class="fas fa-plus-circle fa-8x text-white"></i>
                </div>
                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-white opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('users-coursappuie-site-classes.index') }}" class="text-white opacity-75">Associations</a>
                                </li>
                                <li class="breadcrumb-item active text-white" aria-current="page">Nouvelle</li>
                            </ol>
                        </nav>
                        <h1 class="display-4 fw-bold text-white mb-3">Nouvelle association</h1>
                        <p class="text-white opacity-90 lead mb-4">Créez une nouvelle association Utilisateur-Cours-Site-Classe</p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('users-coursappuie-site-classes.index') }}"
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
                        <i class="fas fa-link text-primary me-2"></i>Informations de l'association
                    </h4>
                    <p class="text-muted mb-0 mt-1">Remplissez tous les champs pour créer une nouvelle association</p>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('users-coursappuie-site-classes.store') }}" method="POST" id="createAssociationForm">
                        @csrf

                        <div class="row g-4">
                            <!-- Utilisateur -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="idUsers" class="form-label fw-semibold">
                                        <i class="fas fa-user text-primary me-2"></i>Utilisateur
                                    </label>
                                    <select class="form-select form-select-lg rounded-4 @error('idUsers') is-invalid @enderror"
                                            id="idUsers"
                                            name="idUsers"
                                            required>
                                        <option value="" selected disabled>Sélectionnez un utilisateur</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('idUsers') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('idUsers')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Cours d'appui -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="idCoursDappuie" class="form-label fw-semibold">
                                        <i class="fas fa-book-open text-primary me-2"></i>Cours d'appui
                                    </label>
                                    <select class="form-select form-select-lg rounded-4 @error('idCoursDappuie') is-invalid @enderror"
                                            id="idCoursDappuie"
                                            name="idCoursDappuie"
                                            required>
                                        <option value="" selected disabled>Sélectionnez un cours d'appui</option>
                                        @foreach($coursDappuies as $coursDappuie)
                                            <option value="{{ $coursDappuie->id }}" {{ old('idCoursDappuie') == $coursDappuie->id ? 'selected' : '' }}>
                                                {{ $coursDappuie->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('idCoursDappuie')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Site -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="idSites" class="form-label fw-semibold">
                                        <i class="fas fa-building text-primary me-2"></i>Site (optionnel)
                                    </label>
                                    <select class="form-select form-select-lg rounded-4 @error('idSites') is-invalid @enderror"
                                            id="idSites"
                                            name="idSites">
                                        <option value="" selected>Aucun site</option>
                                        @foreach($sites as $site)
                                            <option value="{{ $site->id }}" {{ old('idSites') == $site->id ? 'selected' : '' }}>
                                                {{ $site->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('idSites')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Optionnel - Laissez vide si non applicable</small>
                                </div>
                            </div>

                            <!-- Classe -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="idClasse" class="form-label fw-semibold">
                                        <i class="fas fa-users text-primary me-2"></i>Classe (optionnel)
                                    </label>
                                    <select class="form-select form-select-lg rounded-4 @error('idClasse') is-invalid @enderror"
                                            id="idClasse"
                                            name="idClasse">
                                        <option value="" selected>Aucune classe</option>
                                        @foreach($classes as $classe)
                                            <option value="{{ $classe->id }}" {{ old('idClasse') == $classe->id ? 'selected' : '' }}>
                                                {{ $classe->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('idClasse')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Optionnel - Laissez vide si non applicable</small>
                                </div>
                            </div>
                        </div>

                        <!-- Informations importantes -->
                        <div class="alert alert-info bg-info bg-opacity-10 border-0 rounded-4 p-3 mb-4 mt-3">
                            <div class="d-flex">
                                <i class="fas fa-info-circle fa-2x text-info me-3"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Information importante</h6>
                                    <p class="mb-0 small">Cette association permet de lier un utilisateur à un cours d'appui, avec éventuellement un site et une classe spécifiques.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="d-flex gap-3 justify-content-end mt-4">
                            <a href="{{ route('users-coursappuie-site-classes.index') }}"
                               class="btn btn-outline-secondary rounded-pill px-5 py-3">
                                <i class="fas fa-times me-2"></i>Annuler
                            </a>
                            <button type="submit"
                                    class="btn btn-primary rounded-pill px-5 py-3 shadow-sm hover-lift"
                                    id="btnSubmit">
                                <i class="fas fa-save me-2"></i>Créer l'association
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
    }
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
    document.getElementById('createAssociationForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        var form = this;

        waitForSwal(function() {
            Swal.fire({
                title: 'Créer cette association ?',
                html: `
                    <div class="text-center">
                        <i class="fas fa-link text-primary fa-4x mb-3"></i>
                        <p class="mb-1">Vous êtes sur le point de créer une nouvelle association.</p>
                        <p class="text-muted small">Vérifiez les informations avant de continuer.</p>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#667eea',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, créer',
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
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Création en cours...';
                    form.submit();
                }
            });
        });
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
