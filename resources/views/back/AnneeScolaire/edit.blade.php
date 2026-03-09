@extends('layouts.master')

@section('title')
    Modifier Année Scolaire - ClassHub
@endsection

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

<div class="container-fluid px-4 py-5">

    <!-- En-tête avec dégradé -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient rounded-4 p-5 shadow-lg position-relative overflow-hidden"
                 style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-calendar-alt fa-8x text-blue"></i>
                </div>
                <div class="position-absolute bottom-0 start-0 opacity-10">
                    <i class="fas fa-edit fa-8x text-blue"></i>
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
                                <li class="breadcrumb-item active text-blue" aria-current="page">Modifier</li>
                            </ol>
                        </nav>
                        <h1 class="display-4 fw-bold text-blue mb-3">Modifier l'année scolaire</h1>
                        <p class="text-blue opacity-90 lead mb-4">{{ $anneeScolaire->annee }}</p>
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
                        <i class="fas fa-edit text-primary me-2"></i>Modifier les informations
                    </h4>
                    <p class="text-muted mb-0 mt-1">Modifiez les informations de l'année scolaire</p>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('annees-scolaires.update', $anneeScolaire->id) }}" method="POST" id="editAnneeForm">
                        @csrf
                        @method('PUT')

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
                                           value="{{ old('annee', $anneeScolaire->annee) }}"
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
                                           value="{{ old('date_debut', $anneeScolaire->date_debut ? $anneeScolaire->date_debut->format('Y-m-d') : '') }}"
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
                                           value="{{ old('date_fin', $anneeScolaire->date_fin ? $anneeScolaire->date_fin->format('Y-m-d') : '') }}"
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
                                               {{ old('is_active', $anneeScolaire->is_active) ? 'checked' : '' }}>
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

                        <!-- Récapitulatif -->
                        <div class="bg-light rounded-4 p-4 mb-4 mt-3">
                            <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2 text-primary"></i>Informations actuelles :</h6>
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <small class="text-muted d-block">Année</small>
                                    <span class="fw-semibold">{{ $anneeScolaire->annee }}</span>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted d-block">Date début</small>
                                    <span class="fw-semibold">{{ $anneeScolaire->date_debut ? $anneeScolaire->date_debut->format('d/m/Y') : 'N/A' }}</span>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted d-block">Date fin</small>
                                    <span class="fw-semibold">{{ $anneeScolaire->date_fin ? $anneeScolaire->date_fin->format('d/m/Y') : 'N/A' }}</span>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted d-block">Statut</small>
                                    <span class="fw-semibold {{ $anneeScolaire->is_active ? 'text-success' : 'text-secondary' }}">
                                        {{ $anneeScolaire->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Avertissement -->
                        <div class="alert alert-warning bg-warning bg-opacity-10 border-0 rounded-4 p-3 mb-4">
                            <div class="d-flex">
                                <i class="fas fa-exclamation-triangle fa-2x text-warning me-3"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">⚠️ Attention - Modification en cours</h6>
                                    <p class="mb-0 small">La modification des dates peut affecter les classes et inscriptions liées à cette année.</p>
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
        border-color: #f093fb;
        box-shadow: 0 0 0 0.2rem rgba(240, 147, 251, 0.1);
        transform: translateY(-1px);
    }
    .form-check-input:checked {
        background-color: #f093fb;
        border-color: #f093fb;
    }
    .btn-warning {
        color: white;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        border: none;
    }
    .btn-warning:hover {
        background: linear-gradient(135deg, #e884f1 0%, #e44a5e 100%);
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
                confirmButtonColor: '#f093fb',
                customClass: {
                    popup: 'rounded-4'
                }
            });
        }
    });

    // Formatage automatique de l'année
    document.getElementById('annee')?.addEventListener('input', function() {
        let value = this.value.replace(/[^0-9]/g, '');
        if (value.length >= 8) {
            value = value.substr(0,4) + '-' + value.substr(4,4);
            this.value = value;
        }
    });

    // Confirmation avant modification
    document.getElementById('editAnneeForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        var form = this;

        waitForSwal(function() {
            Swal.fire({
                title: 'Modifier cette année ?',
                html: `
                    <div class="text-center">
                        <i class="fas fa-calendar-alt text-warning fa-4x mb-3"></i>
                        <p class="text-muted small mb-1">Vous êtes sur le point de modifier cette année scolaire.</p>
                        <p class="text-danger small mt-2">Cette action peut affecter les classes liées.</p>
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
                    var btn = document.getElementById('btnSubmit');
                    btn.disabled = true;
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mise à jour en cours...';
                    form.submit();
                }
            });
        });
    });

    // Animation de focus
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
