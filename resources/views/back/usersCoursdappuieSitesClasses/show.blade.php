@extends('layouts.master')

@section('title')
    Détails de l'Association - ClassHub
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
                    <i class="fas fa-link fa-8x text-white"></i>
                </div>
                <div class="position-absolute bottom-0 start-0 opacity-10">
                    <i class="fas fa-info-circle fa-8x text-white"></i>
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
                                <li class="breadcrumb-item active text-white" aria-current="page">Détails</li>
                            </ol>
                        </nav>
                        <h1 class="display-4 fw-bold text-white mb-3">Détails de l'association</h1>
                        <p class="text-white opacity-90 lead mb-4">Association #{{ substr($usersCoursDappuieSitesClasse->id, 0, 6) }}...</p>
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

    <!-- Détails de l'association -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 p-4">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-info-circle text-primary me-2"></i>Informations de l'association
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
                                        <h5 class="mb-0 fw-bold">{{ substr($usersCoursDappuieSitesClasse->id, 0, 8) }}...{{ substr($usersCoursDappuieSitesClasse->id, -4) }}</h5>
                                        <small class="text-muted">ID unique</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Utilisateur -->
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <small class="text-muted text-uppercase tracking-wide">Utilisateur</small>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="bg-success bg-opacity-10 rounded-3 p-3 me-3">
                                        <i class="fas fa-user-circle fa-2x text-success"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $usersCoursDappuieSitesClasse->users->name ?? 'N/A' }}</h5>
                                        <small class="text-muted">{{ $usersCoursDappuieSitesClasse->users->email ?? '' }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cours d'appui -->
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <small class="text-muted text-uppercase tracking-wide">Cours d'appui</small>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="bg-info bg-opacity-10 rounded-3 p-3 me-3">
                                        <i class="fas fa-book-open fa-2x text-info"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $usersCoursDappuieSitesClasse->coursDappuie->nom ?? 'N/A' }}</h5>
                                        <small class="text-muted">Cours d'appui</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Site -->
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <small class="text-muted text-uppercase tracking-wide">Site</small>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="bg-warning bg-opacity-10 rounded-3 p-3 me-3">
                                        <i class="fas fa-building fa-2x text-warning"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $usersCoursDappuieSitesClasse->sites->nom ?? 'Non assigné' }}</h5>
                                        <small class="text-muted">Site de rattachement</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Classe -->
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <small class="text-muted text-uppercase tracking-wide">Classe</small>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="bg-danger bg-opacity-10 rounded-3 p-3 me-3">
                                        <i class="fas fa-users fa-2x text-danger"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $usersCoursDappuieSitesClasse->classe->nom ?? 'Non assigné' }}</h5>
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
                                    <div class="bg-secondary bg-opacity-10 rounded-3 p-3 me-3">
                                        <i class="fas fa-calendar-alt fa-2x text-secondary"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $usersCoursDappuieSitesClasse->created_at ? $usersCoursDappuieSitesClasse->created_at->format('d/m/Y') : 'N/A' }}</h5>
                                        <small class="text-muted">{{ $usersCoursDappuieSitesClasse->created_at ? $usersCoursDappuieSitesClasse->created_at->format('H:i:s') : '' }}</small>
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
                                        <h5 class="mb-0 fw-bold">{{ $usersCoursDappuieSitesClasse->updated_at ? $usersCoursDappuieSitesClasse->updated_at->format('d/m/Y') : 'N/A' }}</h5>
                                        <small class="text-muted">{{ $usersCoursDappuieSitesClasse->updated_at ? $usersCoursDappuieSitesClasse->updated_at->format('H:i:s') : '' }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Résumé -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="bg-light rounded-4 p-4">
                                <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2 text-primary"></i>Résumé</h6>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="text-center">
                                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
                                                <i class="fas fa-user-circle me-1"></i>{{ $usersCoursDappuieSitesClasse->users->name ?? 'Utilisateur' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-center">
                                            <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-2">
                                                <i class="fas fa-book-open me-1"></i>{{ $usersCoursDappuieSitesClasse->coursDappuie->nom ?? 'N/A' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-center">
                                            <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-2">
                                                <i class="fas fa-building me-1"></i>{{ $usersCoursDappuieSitesClasse->sites->nom ?? 'Aucun site' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-center">
                                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2">
                                                <i class="fas fa-users me-1"></i>{{ $usersCoursDappuieSitesClasse->classe->nom ?? 'Aucune classe' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="card-footer bg-white border-0 p-4">
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="{{ route('users-coursappuie-site-classes.edit', $usersCoursDappuieSitesClasse->id) }}"
                           class="btn btn-warning rounded-pill px-5 py-3 shadow-sm hover-lift">
                            <i class="fas fa-edit me-2"></i>Modifier
                        </a>
                        <button type="button"
                                class="btn btn-outline-danger rounded-pill px-5 py-3 shadow-sm hover-lift btn-delete"
                                data-association-id="{{ $usersCoursDappuieSitesClasse->id }}"
                                data-association-nom="Association #{{ substr($usersCoursDappuieSitesClasse->id, 0, 6) }}">
                            <i class="fas fa-trash me-2"></i>Supprimer
                        </button>
                        <a href="{{ route('users-coursappuie-site-classes.index') }}"
                           class="btn btn-outline-secondary rounded-pill px-5 py-3 shadow-sm hover-lift">
                            <i class="fas fa-arrow-left me-2"></i>Retour
                        </a>
                    </div>
                    <form id="delete-form-{{ $usersCoursDappuieSitesClasse->id }}"
                          action="{{ route('users-coursappuie-site-classes.destroy', $usersCoursDappuieSitesClasse->id) }}"
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
                var id   = this.getAttribute('data-association-id');
                var nom = this.getAttribute('data-association-nom');

                Swal.fire({
                    title: 'Supprimer cette association ?',
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
