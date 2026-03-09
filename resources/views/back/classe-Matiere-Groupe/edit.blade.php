@extends('layouts.master')

@section('title')
    Modifier une Association - ClassHub
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
                    <i class="fas fa-edit fa-8x text-blue"></i>
                </div>
                <div class="position-absolute bottom-0 start-0 opacity-10">
                    <i class="fas fa-project-diagram fa-8x text-blue"></i>
                </div>
                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-blue opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('classe-matiere-groupe.index') }}" class="text-blue opacity-75">Associations</a>
                                </li>
                                <li class="breadcrumb-item active text-blue" aria-current="page">Modifier</li>
                            </ol>
                        </nav>
                        <h1 class="display-4 fw-bold text-blue mb-3">Modifier une association</h1>
                        <p class="text-blue opacity-90 lead mb-4">
                            Association:
                            <span class="fw-bold bg-blue bg-opacity-20 px-3 py-1 rounded-pill">
                                {{ $classeMatiereGroupe->classe->nom ?? 'N/A' }} -
                                {{ $classeMatiereGroupe->matiere->nom ?? 'N/A' }} -
                                {{ $classeMatiereGroupe->groupe->nom ?? 'N/A' }}
                            </span>
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('classe-matiere-groupe.index') }}"
                           class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
                            <i class="fas fa-arrow-left me-2 text-primary"></i>Retour
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
                        <i class="fas fa-edit text-primary me-2"></i>
                        Modifier l'association
                    </h4>
                    <p class="text-muted mb-0 mt-1">
                        Modifiez les informations ci-dessous pour mettre à jour l'association
                    </p>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('classe-matiere-groupe.update', $classeMatiereGroupe->id) }}" method="POST" id="editForm">
                        @csrf
                        @method('PUT')

                        <!-- Classe -->
                        <div class="mb-4">
                            <label for="classe_id" class="form-label fw-semibold">
                                <i class="fas fa-chalkboard text-primary me-2"></i>Classe
                            </label>
                            <select name="classe_id"
                                    id="classe_id"
                                    class="form-select form-select-lg rounded-4 @error('classe_id') is-invalid @enderror"
                                    required>
                                <option value="">-- Sélectionner une classe --</option>
                                @foreach($classes as $classe)
                                    <option value="{{ $classe->id }}"
                                        {{ old('classe_id', $classeMatiereGroupe->classe_id) == $classe->id ? 'selected' : '' }}>
                                        {{ $classe->nom }} ({{ $classe->anneeScolaire?->annee ?? 'Année N/A' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('classe_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Matière -->
                        <div class="mb-4">
                            <label for="matiere_id" class="form-label fw-semibold">
                                <i class="fas fa-book text-primary me-2"></i>Matière
                            </label>
                            <select name="matiere_id"
                                    id="matiere_id"
                                    class="form-select form-select-lg rounded-4 @error('matiere_id') is-invalid @enderror"
                                    required>
                                <option value="">-- Sélectionner une matière --</option>
                                @foreach($matieres as $matiere)
                                    <option value="{{ $matiere->id }}"
                                        {{ old('matiere_id', $classeMatiereGroupe->matiere_id) == $matiere->id ? 'selected' : '' }}>
                                        {{ $matiere->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('matiere_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Groupe -->
                        <div class="mb-4">
                            <label for="groupe_id" class="form-label fw-semibold">
                                <i class="fas fa-users text-primary me-2"></i>Groupe
                            </label>
                            <select name="groupe_id"
                                    id="groupe_id"
                                    class="form-select form-select-lg rounded-4 @error('groupe_id') is-invalid @enderror"
                                    required>
                                <option value="">-- Sélectionner un groupe --</option>
                                @foreach($groupes as $groupe)
                                    <option value="{{ $groupe->id }}"
                                        {{ old('groupe_id', $classeMatiereGroupe->groupe_id) == $groupe->id ? 'selected' : '' }}>
                                        {{ $groupe->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('groupe_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Récapitulatif -->
                        <div class="bg-light rounded-4 p-4 mb-4 mt-3">
                            <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2 text-primary"></i>Informations actuelles :</h6>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <small class="text-muted d-block">Classe</small>
                                    <span class="fw-semibold">{{ $classeMatiereGroupe->classe->nom ?? 'N/A' }}</span>
                                </div>
                                <div class="col-md-4">
                                    <small class="text-muted d-block">Matière</small>
                                    <span class="fw-semibold">{{ $classeMatiereGroupe->matiere->nom ?? 'N/A' }}</span>
                                </div>
                                <div class="col-md-4">
                                    <small class="text-muted d-block">Groupe</small>
                                    <span class="fw-semibold">{{ $classeMatiereGroupe->groupe->nom ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Avertissement -->
                        <div class="alert alert-warning bg-warning bg-opacity-10 border-0 rounded-4 p-3 mb-4">
                            <div class="d-flex">
                                <i class="fas fa-exclamation-triangle fa-2x text-warning me-3"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">⚠️ Attention - Modification en cours</h6>
                                    <p class="mb-0 small">La modification de cette association peut affecter les cours et les évaluations liés.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="d-flex justify-content-between align-items-center mt-4 pt-4 border-top">
                            <a href="{{ route('classe-matiere-groupe.index') }}" class="btn btn-outline-secondary btn-lg px-5 rounded-pill">
                                <i class="fas fa-times me-2"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-warning btn-lg px-5 rounded-pill shadow-sm hover-lift" id="btnSubmit">
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
    .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }
    .bg-opacity-20 {
        --bs-bg-opacity: 0.2;
    }
    .btn-warning {
        color: white;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        border: none;
    }
    .btn-warning:hover {
        background: linear-gradient(135deg, #e884f1 0%, #e44a5e 100%);
    }
    .alert {
        border-left: 4px solid #ffc107;
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

    document.getElementById('editForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        var form = this;

        waitForSwal(function() {
            Swal.fire({
                title: 'Modifier cette association ?',
                html: `
                    <div class="text-center">
                        <i class="fas fa-project-diagram text-warning fa-4x mb-3"></i>
                        <p class="text-muted small mb-1">Vous êtes sur le point de modifier cette association.</p>
                        <p class="text-danger small mt-2">Cette action peut affecter les cours liés.</p>
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
