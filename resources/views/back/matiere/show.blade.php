@extends('layouts.master')
@section('content')

<div class="container-fluid px-4 py-5">

    <!-- En-tête -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient rounded-4 p-5 shadow-lg position-relative overflow-hidden"
                 style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-book fa-8x text-blue"></i>
                </div>
                <div class="position-absolute bottom-0 start-0 opacity-10">
                    <i class="fas fa-info-circle fa-8x text-blue"></i>
                </div>
                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-blue opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('matieres.index') }}" class="text-blue opacity-75">Matières</a>
                                </li>
                                <li class="breadcrumb-item active text-blue" aria-current="page">Détails</li>
                            </ol>
                        </nav>
                        <h1 class="display-4 fw-bold text-blue mb-3">Détails de la matière</h1>
                        <p class="text-blue opacity-90 lead mb-4">{{ $matiere->nom }}</p>
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

    <!-- Détails de la matière -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 p-4">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-info-circle text-primary me-2"></i>Informations générales
                    </h4>
                </div>

                <div class="card-body p-4">
                    <div class="row g-4">
                        <!-- ID -->
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <small class="text-muted text-uppercase tracking-wide">Identifiant</small>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="bg-primary bg-opacity-10 rounded-3 p-3 me-3">
                                        <i class="fas fa-fingerprint fa-2x text-primary"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $matiere->id }}</h5>
                                        <small class="text-muted">ID unique</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Nom -->
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <small class="text-muted text-uppercase tracking-wide">Nom</small>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="bg-success bg-opacity-10 rounded-3 p-3 me-3">
                                        <i class="fas fa-tag fa-2x text-success"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $matiere->nom }}</h5>
                                        <small class="text-muted">Nom de la matière</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Classe -->
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <small class="text-muted text-uppercase tracking-wide">Classe associée</small>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="bg-info bg-opacity-10 rounded-3 p-3 me-3">
                                        <i class="fas fa-users fa-2x text-info"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $matiere->classe->nom ?? 'Non assignée' }}</h5>
                                        <small class="text-muted">Classe</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Date de création -->
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <small class="text-muted text-uppercase tracking-wide">Date de création</small>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="bg-warning bg-opacity-10 rounded-3 p-3 me-3">
                                        <i class="fas fa-calendar-alt fa-2x text-warning"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $matiere->created_at->format('d/m/Y') }}</h5>
                                        <small class="text-muted">{{ $matiere->created_at->format('H:i:s') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dernière modification -->
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <small class="text-muted text-uppercase tracking-wide">Dernière modification</small>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="bg-secondary bg-opacity-10 rounded-3 p-3 me-3">
                                        <i class="fas fa-clock fa-2x text-secondary"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $matiere->updated_at->format('d/m/Y') }}</h5>
                                        <small class="text-muted">{{ $matiere->updated_at->format('H:i:s') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="card-footer bg-white border-0 p-4">
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="{{ route('matieres.edit', $matiere->id) }}"
                           class="btn btn-warning rounded-pill px-5 py-3 shadow-sm hover-lift">
                            <i class="fas fa-edit me-2"></i>Modifier
                        </a>
                        <button type="button"
                                class="btn btn-outline-danger rounded-pill px-5 py-3 shadow-sm hover-lift btn-delete"
                                data-matiere-id="{{ $matiere->id }}"
                                data-matiere-nom="{{ $matiere->nom }}">
                            <i class="fas fa-trash me-2"></i>Supprimer
                        </button>
                    </div>
                    <form id="delete-form-{{ $matiere->id }}"
                          action="{{ route('matieres.destroy', $matiere->id) }}"
                          method="POST"
                          style="display:none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    .hover-lift { transition: transform 0.2s ease; }
    .hover-lift:hover { transform: translateY(-2px); }
    .tracking-wide { letter-spacing: 0.5px; }
    .bg-opacity-10 { --bs-bg-opacity: 0.1; }
</style>

<script>
(function () {
    function waitFor(v, cb, t) {
        t = t || 0;
        if (t > 50) return;
        typeof window[v] !== 'undefined' ? cb() : setTimeout(function(){ waitFor(v, cb, t+1); }, 100);
    }

    function init() {
        // Suppression avec SweetAlert
        document.querySelectorAll('.btn-delete').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var id   = this.getAttribute('data-matiere-id');
                var nom = this.getAttribute('data-matiere-nom');

                Swal.fire({
                    title: 'Supprimer cette matière ?',
                    html: `
                        <div class="text-center">
                            <i class="fas fa-exclamation-triangle text-warning fa-4x mb-3"></i>
                            <p class="fw-bold mb-2">${nom}</p>
                            <p class="text-muted small">Cette action est irréversible.</p>
                        </div>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Oui, supprimer',
                    cancelButtonText: 'Annuler',
                    reverseButtons: true,
                    focusCancel: true,
                    customClass: {
                        popup: 'rounded-4 shadow-lg'
                    }
                }).then(function(result) {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            });
        });
    }

    document.readyState === 'loading'
        ? document.addEventListener('DOMContentLoaded', function(){ waitFor('Swal', init); })
        : waitFor('Swal', init);
})();
</script>

@endsection
