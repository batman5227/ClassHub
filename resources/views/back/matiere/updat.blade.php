@extends('layouts.master')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

<div class="container-fluid px-4 py-5">

    <!-- En-tête -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient rounded-4 p-5 shadow-lg position-relative overflow-hidden"
                 style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-book fa-8x text-white"></i>
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
                                    <a href="{{ route('matieres.index') }}" class="text-white opacity-75">Matières</a>
                                </li>
                                <li class="breadcrumb-item active text-white" aria-current="page">Modification</li>
                            </ol>
                        </nav>
                        <h1 class="display-4 fw-bold text-white mb-3">Modifier une matière</h1>
                        <p class="text-white opacity-90 lead mb-4">{{ $matiere->nom }}</p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('matieres.index') }}"
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
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 p-4">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-edit text-primary me-2"></i>Formulaire de modification
                    </h4>
                    <p class="text-muted mb-0 mt-1">Modifiez les informations de la matière</p>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('matieres.update', $matiere->id) }}" method="POST" id="editMatiereForm">
                        @csrf
                        @method('PUT')

                        <!-- Nom de la matière -->
                        <div class="mb-4">
                            <label for="nom" class="form-label fw-semibold">
                                <i class="fas fa-tag text-primary me-2"></i>Nom de la matière
                            </label>
                            <input type="text"
                                   class="form-control form-control-lg rounded-4 @error('nom') is-invalid @enderror"
                                   id="nom"
                                   name="nom"
                                   value="{{ old('nom', $matiere->nom) }}"
                                   placeholder="Ex: Mathématiques, Français, Histoire..."
                                   required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Classe -->
                        <div class="mb-4">
                            <label for="idClasse" class="form-label fw-semibold">
                                <i class="fas fa-users text-primary me-2"></i>Classe associée
                            </label>
                            <select class="form-select form-select-lg rounded-4 @error('idClasse') is-invalid @enderror"
                                    id="idClasse"
                                    name="idClasse"
                                    required>
                                <option value="" disabled>Sélectionnez une classe</option>
                                @foreach($classes as $classe)
                                    <option value="{{ $classe->id }}"
                                        {{ old('idClasse', $matiere->idClasse) == $classe->id ? 'selected' : '' }}>
                                        {{ $classe->nom }} ({{ $classe->niveau ?? 'Niveau non défini' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('idClasse')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Avertissement de modification -->
                        <div class="alert alert-warning bg-warning bg-opacity-10 border-0 rounded-4 p-3 mb-4">
                            <div class="d-flex">
                                <i class="fas fa-exclamation-triangle fa-2x text-warning me-3"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Attention</h6>
                                    <p class="mb-0 small">La modification de la classe peut affecter les cours associés à cette matière.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="d-flex gap-3 justify-content-end">
                            <a href="{{ route('matieres.index') }}"
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
    .hover-lift { transition: transform 0.2s ease; }
    .hover-lift:hover { transform: translateY(-2px); }
    .form-control, .form-select {
        border: 2px solid #e9ecef;
        transition: all 0.2s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: #f093fb;
        box-shadow: 0 0 0 0.2rem rgba(240, 147, 251, 0.1);
    }
    .bg-opacity-10 { --bs-bg-opacity: 0.1; }
</style>

<script>
(function() {
    // Confirmation avant modification
    document.getElementById('editMatiereForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        var form = this;

        Swal.fire({
            title: 'Modifier cette matière ?',
            html: `
                <div class="text-center">
                    <i class="fas fa-edit text-warning fa-4x mb-3"></i>
                    <p class="mb-1">Vous êtes sur le point de modifier cette matière.</p>
                    <p class="text-muted small">Les changements seront appliqués immédiatement.</p>
                </div>
            `,
            icon: 'question',
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
                btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mise à jour...';
                form.submit();
            }
        });
    });
})();
</script>

@endsection
