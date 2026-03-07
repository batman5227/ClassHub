@extends('layouts.master')

@section('title')
    Détails du Document - ClassHub
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
                    <i class="fas fa-file-alt fa-8x text-white"></i>
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
                                    <a href="{{ route('documents.index') }}" class="text-white opacity-75">Documents</a>
                                </li>
                                <li class="breadcrumb-item active text-white" aria-current="page">Détails</li>
                            </ol>
                        </nav>
                        <h1 class="display-4 fw-bold text-white mb-3">Détails du document</h1>
                        <p class="text-white opacity-90 lead mb-4">{{ $document->nom }}</p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('documents.index') }}"
                           class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
                            <i class="fas fa-arrow-left me-2 text-primary"></i>Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Détails du document -->
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
                                        <h5 class="mb-0 fw-bold">{{ substr($document->id, 0, 8) }}...{{ substr($document->id, -4) }}</h5>
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
                                        <h5 class="mb-0 fw-bold">{{ $document->nom }}</h5>
                                        <small class="text-muted">Nom du document</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Matière -->
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <small class="text-muted text-uppercase tracking-wide">Matière associée</small>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="bg-info bg-opacity-10 rounded-3 p-3 me-3">
                                        <i class="fas fa-book fa-2x text-info"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $document->matiere->nom ?? 'Non associée' }}</h5>
                                        <small class="text-muted">Matière</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Classe (via matière) -->
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <small class="text-muted text-uppercase tracking-wide">Classe concernée</small>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="bg-warning bg-opacity-10 rounded-3 p-3 me-3">
                                        <i class="fas fa-users fa-2x text-warning"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $document->matiere->classe->nom ?? 'Non spécifiée' }}</h5>
                                        <small class="text-muted">Classe</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Fichier -->
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <small class="text-muted text-uppercase tracking-wide">Fichier</small>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="bg-danger bg-opacity-10 rounded-3 p-3 me-3">
                                        <i class="fas fa-file-pdf fa-2x text-danger"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">
                                            @if($document->fichier)
                                                <a href="{{ Storage::url($document->fichier) }}" target="_blank" class="text-decoration-none">
                                                    {{ basename($document->fichier) }}
                                                </a>
                                            @else
                                                Aucun fichier
                                            @endif
                                        </h5>
                                        @if($document->fichier)
                                            @php
                                                $taille = Storage::exists($document->fichier) ? Storage::size($document->fichier) : 0;
                                            @endphp
                                            <small class="text-muted">{{ $taille > 0 ? round($taille / 1024, 2) . ' KB' : 'Taille inconnue' }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Type de fichier -->
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <small class="text-muted text-uppercase tracking-wide">Type</small>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="bg-secondary bg-opacity-10 rounded-3 p-3 me-3">
                                        <i class="fas fa-file fa-2x text-secondary"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">
                                            @if($document->fichier)
                                                {{ strtoupper(pathinfo($document->fichier, PATHINFO_EXTENSION)) }}
                                            @else
                                                Inconnu
                                            @endif
                                        </h5>
                                        <small class="text-muted">Extension</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Date de création -->
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <small class="text-muted text-uppercase tracking-wide">Date d'ajout</small>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="bg-success bg-opacity-10 rounded-3 p-3 me-3">
                                        <i class="fas fa-calendar-alt fa-2x text-success"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $document->created_at->format('d/m/Y') }}</h5>
                                        <small class="text-muted">{{ $document->created_at->format('H:i:s') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dernière modification -->
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <small class="text-muted text-uppercase tracking-wide">Dernière modification</small>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="bg-warning bg-opacity-10 rounded-3 p-3 me-3">
                                        <i class="fas fa-clock fa-2x text-warning"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $document->updated_at->format('d/m/Y') }}</h5>
                                        <small class="text-muted">{{ $document->updated_at->format('H:i:s') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Aperçu du document (si PDF) -->
                    @if($document->fichier && pathinfo($document->fichier, PATHINFO_EXTENSION) == 'pdf')
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="bg-light rounded-4 p-4">
                                <h6 class="fw-bold mb-3"><i class="fas fa-eye me-2 text-primary"></i>Aperçu</h6>
                                <iframe src="{{ Storage::url($document->fichier) }}"
                                        style="width: 100%; height: 500px;"
                                        frameborder="0"
                                        class="rounded-3"></iframe>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Actions -->
                <div class="card-footer bg-white border-0 p-4">
                    <div class="d-flex gap-3 justify-content-center">
                        @if($document->fichier)
                            <a href="{{ Storage::url($document->fichier) }}"
                               class="btn btn-success rounded-pill px-5 py-3 shadow-sm hover-lift"
                               target="_blank">
                                <i class="fas fa-download me-2"></i>Télécharger
                            </a>
                        @endif
                        <a href="{{ route('documents.edit', $document->id) }}"
                           class="btn btn-warning rounded-pill px-5 py-3 shadow-sm hover-lift">
                            <i class="fas fa-edit me-2"></i>Modifier
                        </a>
                        <button type="button"
                                class="btn btn-outline-danger rounded-pill px-5 py-3 shadow-sm hover-lift btn-delete"
                                data-document-id="{{ $document->id }}"
                                data-document-nom="{{ $document->nom }}">
                            <i class="fas fa-trash me-2"></i>Supprimer
                        </button>
                    </div>
                    <form id="delete-form-{{ $document->id }}"
                          action="{{ route('documents.destroy', $document->id) }}"
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
                var id   = this.getAttribute('data-document-id');
                var nom = this.getAttribute('data-document-nom');

                Swal.fire({
                    title: 'Supprimer ce document ?',
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
