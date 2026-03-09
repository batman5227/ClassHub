@extends('layouts.master')

@section('title')
    Détails Année Scolaire - ClassHub
@endsection

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

<div class="container-fluid px-4 py-5">

    <!-- En-tête avec dégradé -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient rounded-4 p-5 shadow-lg position-relative overflow-hidden"
                 style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-calendar-alt fa-8x text-blue"></i>
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
                                    <a href="{{ route('annees-scolaires.index') }}" class="text-blue opacity-75">Années scolaires</a>
                                </li>
                                <li class="breadcrumb-item active text-blue" aria-current="page">Détails</li>
                            </ol>
                        </nav>
                        <h1 class="display-4 fw-bold text-blue mb-3">Détails de l'année scolaire</h1>
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

    <!-- Détails -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
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
                                        <h5 class="mb-0 fw-bold">{{ substr($anneeScolaire->id, 0, 8) }}...{{ substr($anneeScolaire->id, -4) }}</h5>
                                        <small class="text-muted">ID unique</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Année -->
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <small class="text-muted text-uppercase tracking-wide">Année scolaire</small>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="bg-success bg-opacity-10 rounded-3 p-3 me-3">
                                        <i class="fas fa-calendar fa-2x text-success"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $anneeScolaire->annee }}</h5>
                                        <small class="text-muted">Année</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Date début -->
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <small class="text-muted text-uppercase tracking-wide">Date de début</small>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="bg-info bg-opacity-10 rounded-3 p-3 me-3">
                                        <i class="fas fa-calendar-day fa-2x text-info"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $anneeScolaire->date_debut ? $anneeScolaire->date_debut->format('d/m/Y') : 'N/A' }}</h5>
                                        <small class="text-muted">Début de l'année</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Date fin -->
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <small class="text-muted text-uppercase tracking-wide">Date de fin</small>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="bg-warning bg-opacity-10 rounded-3 p-3 me-3">
                                        <i class="fas fa-calendar-check fa-2x text-warning"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $anneeScolaire->date_fin ? $anneeScolaire->date_fin->format('d/m/Y') : 'N/A' }}</h5>
                                        <small class="text-muted">Fin de l'année</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Statut -->
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <small class="text-muted text-uppercase tracking-wide">Statut</small>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="bg-danger bg-opacity-10 rounded-3 p-3 me-3">
                                        <i class="fas fa-power-off fa-2x text-danger"></i>
                                    </div>
                                    <div>
                                        @if($anneeScolaire->is_active)
                                            <h5 class="mb-0 fw-bold text-success">Active</h5>
                                            <small class="text-muted">Année en cours</small>
                                        @else
                                            <h5 class="mb-0 fw-bold text-secondary">Inactive</h5>
                                            <small class="text-muted">Année passée ou future</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Date création -->
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <small class="text-muted text-uppercase tracking-wide">Date de création</small>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="bg-secondary bg-opacity-10 rounded-3 p-3 me-3">
                                        <i class="fas fa-calendar-alt fa-2x text-secondary"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $anneeScolaire->created_at ? $anneeScolaire->created_at->format('d/m/Y') : 'N/A' }}</h5>
                                        <small class="text-muted">{{ $anneeScolaire->created_at ? $anneeScolaire->created_at->format('H:i:s') : '' }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dernière modification -->
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <small class="text-muted text-uppercase tracking-wide">Dernière modification</small>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="bg-dark bg-opacity-10 rounded-3 p-3 me-3">
                                        <i class="fas fa-clock fa-2x text-dark"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $anneeScolaire->updated_at ? $anneeScolaire->updated_at->format('d/m/Y') : 'N/A' }}</h5>
                                        <small class="text-muted">{{ $anneeScolaire->updated_at ? $anneeScolaire->updated_at->format('H:i:s') : '' }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistiques -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="bg-light rounded-4 p-4">
                                <h6 class="fw-bold mb-3"><i class="fas fa-chart-bar me-2 text-primary"></i>Statistiques</h6>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="text-center">
                                            <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-4 py-3 w-100">
                                                <i class="fas fa-school me-2"></i>
                                                {{ $anneeScolaire->classes->count() }} Classes
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center">
                                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-4 py-3 w-100">
                                                <i class="fas fa-user-graduate me-2"></i>
                                                {{ $totalEleves ?? 0 }} Élèves
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center">
                                            <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-4 py-3 w-100">
                                                <i class="fas fa-book-open me-2"></i>
                                                @php
                                                    $totalMatieres = 0;
                                                    foreach($anneeScolaire->classes as $classe) {
                                                        $totalMatieres += $classe->matieres ? $classe->matieres->count() : 0;
                                                    }
                                                @endphp
                                                {{ $totalMatieres }} Matières
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Liste des classes (optionnel) -->
                    @if($anneeScolaire->classes->count() > 0)
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="bg-light rounded-4 p-4">
                                <h6 class="fw-bold mb-3"><i class="fas fa-list me-2 text-primary"></i>Classes de cette année</h6>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Classe</th>
                                                <th>Site</th>
                                                <th>Groupes</th>
                                                <th>Élèves</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($anneeScolaire->classes as $classe)
                                            <tr>
                                                <td>{{ $classe->nom }}</td>
                                                <td>{{ $classe->site?->nom ?? 'N/A' }}</td>
                                                <td>{{ $classe->groupes->count() }}</td>
                                                <td>{{ $classe->eleves->count() }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Actions -->
                <div class="card-footer bg-white border-0 p-4">
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="{{ route('annees-scolaires.edit', $anneeScolaire) }}"
                           class="btn btn-warning rounded-pill px-5 py-3 shadow-sm hover-lift">
                            <i class="fas fa-edit me-2"></i>Modifier
                        </a>

                        @if(!$anneeScolaire->is_active)
                            <form action="{{ route('annees-scolaires.set-active', $anneeScolaire) }}" method="POST" class="d-inline set-active-form">
                                @csrf
                                @method('PUT')
                                <button type="button"
                                        class="btn btn-success rounded-pill px-5 py-3 shadow-sm hover-lift btn-set-active"
                                        data-annee="{{ $anneeScolaire->annee }}">
                                    <i class="fas fa-power-off me-2"></i>Définir comme active
                                </button>
                            </form>
                        @endif

                        @if(!$anneeScolaire->is_active && $anneeScolaire->classes->count() == 0)
                            <button type="button"
                                    class="btn btn-outline-danger rounded-pill px-5 py-3 shadow-sm hover-lift btn-delete"
                                    data-annee-id="{{ $anneeScolaire->id }}"
                                    data-annee-nom="{{ $anneeScolaire->annee }}">
                                <i class="fas fa-trash me-2"></i>Supprimer
                            </button>
                        @endif

                        <a href="{{ route('annees-scolaires.index') }}"
                           class="btn btn-outline-secondary rounded-pill px-5 py-3 shadow-sm hover-lift">
                            <i class="fas fa-arrow-left me-2"></i>Retour
                        </a>
                    </div>
                    <form id="delete-form-{{ $anneeScolaire }}"
                          action="{{ route('annees-scolaires.destroy', $anneeScolaire->id) }}"
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
    .bg-light {
        background-color: #f8fafc !important;
    }
    .badge {
        font-size: 1rem;
        font-weight: 500;
    }
    .table th {
        font-weight: 600;
        color: #495057;
        border-bottom-width: 1px;
    }
</style>

<script>
(function () {
    function waitFor(v, cb, t) {
        t = t || 0;
        if (t > 50) return;
        typeof window[v] !== 'undefined' ? cb() : setTimeout(function(){ waitFor(v, cb, t+1); }, 100);
    }

    function init() {
        // Définir comme active
        document.querySelectorAll('.btn-set-active').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                var form = this.closest('.set-active-form');
                var annee = this.getAttribute('data-annee');

                Swal.fire({
                    title: 'Définir comme année active ?',
                    html: `
                        <div class="text-center">
                            <i class="fas fa-calendar-check text-success fa-4x mb-3"></i>
                            <p class="fw-bold mb-2">${annee}</p>
                            <p class="text-muted small">Cette année deviendra l'année scolaire active.</p>
                        </div>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Oui, activer',
                    cancelButtonText: 'Annuler',
                    reverseButtons: true,
                    focusCancel: true,
                    customClass: {
                        popup: 'rounded-4 shadow-lg'
                    }
                }).then(function(result) {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Suppression
        document.querySelectorAll('.btn-delete').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                var id  = this.getAttribute('data-annee-id');
                var nom = this.getAttribute('data-annee-nom');

                Swal.fire({
                    title: 'Supprimer cette année ?',
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