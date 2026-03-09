@extends('layouts.master')

@section('title')
    Nouvelle Année Scolaire - ClassHub
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
                    <i class="fas fa-calendar-alt fa-8x text-blue"></i>
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
                                    <a href="{{ route('annees-scolaires.index') }}" class="text-blue opacity-75">Années scolaires</a>
                                </li>
                                <li class="breadcrumb-item active text-blue" aria-current="page">Nouvelle</li>
                            </ol>
                        </nav>
                        <h1 class="display-4 fw-bold text-blue mb-3">Nouvelle année scolaire</h1>
                        <p class="text-blue opacity-90 lead mb-4">Créez une nouvelle année scolaire</p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('annees-scolaires.index') }}"
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
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 p-4">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-calendar-plus text-primary me-2"></i>Informations de l'année scolaire
                    </h4>
                    <p class="text-muted mb-0 mt-1">Remplissez tous les champs pour créer une nouvelle année scolaire</p>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('annees-scolaires.store') }}" method="POST" id="createAnneeForm">
                        @csrf

                        <div class="row g-4">
                            <!-- Année -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="annee" class="form-label fw-semibold">
                                        <i class="fas fa-calendar text-primary me-2"></i>Année scolaire
                                    </label>
                                    <input type="text"
                                           class="form-control form-control-lg rounded-4 @error('annee') is-invalid @enderror"
                                           id="annee"
                                           name="annee"
                                           value="{{ old('annee') }}"
                                           placeholder="Ex: 2025-2026"
                                           required>
                                    @error('annee')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Format: AAAA-AAAA (ex: 2025-2026)</small>
                                </div>
                            </div>

                            <!-- Date début -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date_debut" class="form-label fw-semibold">
                                        <i class="fas fa-calendar-day text-primary me-2"></i>Date de début
                                    </label>
                                    <input type="date"
                                           class="form-control form-control-lg rounded-4 @error('date_debut') is-invalid @enderror"
                                           id="date_debut"
                                           name="date_debut"
                                           value="{{ old('date_debut') }}"
                                           required>
                                    @error('date_debut')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Date fin -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date_fin" class="form-label fw-semibold">
                                        <i class="fas fa-calendar-check text-primary me-2"></i>Date de fin
                                    </label>
                                    <input type="date"
                                           class="form-control form-control-lg rounded-4 @error('date_fin') is-invalid @enderror"
                                           id="date_fin"
                                           name="date_fin"
                                           value="{{ old('date_fin') }}"
                                           required>
                                    @error('date_fin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Statut actif -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                               id="is_active" name="is_active" value="1"
                                               {{ old('is_active') ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="is_active">
                                            <i class="fas fa-power-off text-primary me-2"></i>Définir comme année active
                                        </label>
                                    </div>
                                    @error('is_active')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted d-block mt-1">Si activé, cette année sera l'année scolaire en cours</small>
                                </div>
                            </div>
                        </div>

                        <!-- Avertissement -->
                        <div class="alert alert-info bg-info bg-opacity-10 border-0 rounded-4 p-3 mb-4 mt-3">
                            <div class="d-flex">
                                <i class="fas fa-info-circle fa-2x text-info me-3"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Information importante</h6>
                                    <p class="mb-0 small">La date de fin doit être postérieure à la date de début.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="d-flex gap-3 justify-content-end mt-4">
                            <a href="{{ route('annees-scolaires.index') }}"
                               class="btn btn-outline-secondary rounded-pill px-5 py-3">
                                <i class="fas fa-times me-2"></i>Annuler
                            </a>
                            <button type="submit"
                                    class="btn btn-primary rounded-pill px-5 py-3 shadow-sm hover-lift"
                                    id="btnSubmit">
                                <i class="fas fa-save me-2"></i>Créer l'année scolaire
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
    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }
    .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }
    .alert {
        border-left: 4px solid #17a2b8;
    }
</style>

<script>
(function() {
    function waitForSwal(cb, tries = 0) {
        if (tries > 50) return;
        if (typeof Swal !== 'undefined') {
            cb();
        } else {
            setTimeout(function() { waitForSwal(cb, tries + 1); }, 100);
        }
    }

    // Validation des dates
    document.getElementById('date_debut')?.addEventListener('change', function() {
        var dateFin = document.getElementById('date_fin');
        if (dateFin.value && this.value > dateFin.value) {
            dateFin.value = '';
        }
        dateFin.min = this.value;
    });

    document.getElementById('date_fin')?.addEventListener('change', function() {
        var dateDebut = document.getElementById('date_debut');
        if (dateDebut.value && this.value < dateDebut.value) {
            this.value = '';
            Swal.fire({
                title: 'Date invalide',
                text: 'La date de fin doit être postérieure à la date de début',
                icon: 'error',
                confirmButtonColor: '#667eea',
                customClass: {
                    popup: 'rounded-4'
                }
            });
        }
    });

    // Formatage automatique de l'année
    document.getElementById('annee')?.addEventListener('input', function() {
        // Permet de formater automatiquement si l'utilisateur tape 20252026
        let value = this.value.replace(/[^0-9]/g, '');
        if (value.length >= 8) {
            value = value.substr(0,4) + '-' + value.substr(4,4);
            this.value = value;
        }
    });

    // Confirmation avant soumission
    document.getElementById('createAnneeForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        var form = this;

        waitForSwal(function() {
            Swal.fire({
                title: 'Créer cette année scolaire ?',
                html: `
                    <div class="text-center">
                        <i class="fas fa-calendar-alt text-primary fa-4x mb-3"></i>
                        <p class="mb-1">Vous êtes sur le point de créer une nouvelle année scolaire.</p>
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
                    var btn = document.getElementById('btnSubmit');
                    btn.disabled = true;
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Création en cours...';
                    form.submit();
                }
            });
        });
    });
})();
</script>

@endsection
