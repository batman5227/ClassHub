@extends('layouts.master')

@section('title')
    Années Scolaires - ClassHub
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
                    <i class="fas fa-school fa-8x text-blue"></i>
                </div>
                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-blue opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active text-blue" aria-current="page">Années scolaires</li>
                            </ol>
                        </nav>
                        <h1 class="display-4 fw-bold text-blue mb-3">Gestion des années scolaires</h1>
                        <p class="text-blue opacity-90 lead mb-4">Gérez les années scolaires de l'établissement</p>
                        <div class="d-flex gap-3">
                            <div class="bg-blue bg-opacity-20 rounded-3 px-4 py-2">
                                <small class="text-blue opacity-75 d-block">Total années</small>
                                <span class="text-blue fw-bold">{{ $anneesScolaires->total() }}</span>
                            </div>
                            <div class="bg-blue bg-opacity-20 rounded-3 px-4 py-2">
                                <small class="text-blue opacity-75 d-block">Année active</small>
                                <span class="text-blue fw-bold">
                                    @php $active = $anneesScolaires->firstWhere('is_active', true) @endphp
                                    {{ $active ? $active->annee : 'Aucune' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('annees-scolaires.create') }}"
                           class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
                            <i class="fas fa-plus-circle me-2 text-primary"></i>Nouvelle année
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Messages flash -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm border-0 bg-success bg-opacity-10 mb-4" role="alert">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle fa-2x text-success"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h5 class="alert-heading mb-1 text-success">Opération réussie !</h5>
                    <p class="mb-0">{{ session('success') }}</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm border-0 bg-danger bg-opacity-10 mb-4" role="alert">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle fa-2x text-danger"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h5 class="alert-heading mb-1 text-danger">Erreur</h5>
                    <p class="mb-0">{{ session('error') }}</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- Tableau -->
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="card-header bg-white border-0 p-4">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-list text-primary me-2"></i>Liste des années scolaires
                    </h4>
                    <p class="text-muted mb-0 mt-1">{{ $anneesScolaires->total() }} année(s) trouvée(s)</p>
                </div>
                <div class="col-auto">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" id="search-annees"
                               placeholder="Rechercher une année...">
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if($anneesScolaires->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-calendar-alt fa-4x text-muted mb-3 d-block"></i>
                    <h5 class="text-muted">Aucune année scolaire trouvée</h5>
                    <p class="text-muted mb-3">Commencez par créer votre première année scolaire</p>
                    <a href="{{ route('annees-scolaires.create') }}"
                       class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-plus-circle me-2"></i>Nouvelle année
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3">Année</th>
                                <th class="px-4 py-3">Date début</th>
                                <th class="px-4 py-3">Date fin</th>
                                <th class="px-4 py-3">Statut</th>
                                <th class="px-4 py-3">Classes</th>
                                <th class="px-4 py-3">Date création</th>
                                <th class="px-4 py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($anneesScolaires as $annee)
                                <tr class="annee-row" data-name="{{ strtolower($annee->annee) }}">
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded-3 p-3 me-3">
                                                <i class="fas fa-calendar-alt fa-2x text-primary"></i>
                                            </div>
                                            <div>
                                                <span class="fw-semibold">{{ $annee->annee }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <i class="fas fa-calendar-day text-muted me-2"></i>
                                        {{ $annee->date_debut ? $annee->date_debut->format('d/m/Y') : 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <i class="fas fa-calendar-check text-muted me-2"></i>
                                        {{ $annee->date_fin ? $annee->date_fin->format('d/m/Y') : 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($annee->is_active)
                                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">
                                                <i class="fas fa-check-circle me-1"></i>Active
                                            </span>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-2">
                                                <i class="fas fa-clock me-1"></i>Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-2">
                                            <i class="fas fa-users me-1"></i>{{ $annee->classes_count ?? $annee->classes()->count() }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <i class="far fa-calendar-alt text-muted me-2"></i>
                                        {{ $annee->created_at ? $annee->created_at->format('d/m/Y') : 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <!-- Voir -->
                                            <a href="{{ route('annees-scolaires.show', $annee->id) }}"
                                               class="btn btn-sm btn-outline-info rounded-pill px-3"
                                               data-bs-toggle="tooltip" title="Voir les détails">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <!-- Modifier -->
                                            <a href="{{ route('annees-scolaires.edit', $annee->id) }}"
                                               class="btn btn-sm btn-outline-warning rounded-pill px-3"
                                               data-bs-toggle="tooltip" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Activer/Désactiver -->
                                            @if(!$annee->is_active)
                                                <form action="{{ route('annees-scolaires.set-active', $annee->id) }}" method="POST" class="d-inline set-active-form">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="button"
                                                            class="btn btn-sm btn-outline-success rounded-pill px-3 btn-set-active"
                                                            data-annee="{{ $annee->annee }}"
                                                            data-bs-toggle="tooltip" title="Définir comme active">
                                                        <i class="fas fa-power-off"></i>
                                                    </button>
                                                </form>
                                            @endif

                                            <!-- Supprimer -->
                                            @if(!$annee->is_active && ($annee->classes_count ?? $annee->classes()->count()) == 0)
                                                <button type="button"
                                                        class="btn btn-sm btn-outline-danger rounded-pill px-3 btn-delete"
                                                        data-annee-id="{{ $annee->id }}"
                                                        data-annee-nom="{{ $annee->annee }}"
                                                        data-bs-toggle="tooltip" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </div>
                                        <form id="delete-form-{{ $annee->id }}"
                                              action="{{ route('annees-scolaires.destroy', $annee->id) }}"
                                              method="POST"
                                              style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        @if($anneesScolaires->count() > 0)
        <div class="card-footer bg-white border-0 p-4">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted">Affichage de {{ $anneesScolaires->count() }} année(s)</span>
                <div class="pagination">
                    {{ $anneesScolaires->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
    .bg-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .hover-lift { transition: transform 0.2s ease; }
    .hover-lift:hover { transform: translateY(-2px); }
    .btn-outline-info, .btn-outline-warning, .btn-outline-danger, .btn-outline-success {
        border-width: 2px;
        transition: all 0.2s ease;
    }
    .btn-outline-info:hover, .btn-outline-warning:hover, .btn-outline-danger:hover, .btn-outline-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .badge { font-weight: 500; letter-spacing: 0.3px; }
    .swal2-container { z-index: 99999 !important; }
    .bg-opacity-10 { --bs-bg-opacity: 0.1; }
    .bg-opacity-20 { --bs-bg-opacity: 0.2; }
    .pagination { margin-bottom: 0; }
    .pagination > * {
        border-radius: 50px !important;
        margin: 0 2px;
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
        // Tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Recherche
        var searchInput = document.getElementById('search-annees');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                var search = this.value.toLowerCase();
                document.querySelectorAll('.annee-row').forEach(function(row) {
                    var name = row.dataset.name;
                    row.style.display = name.includes(search) ? '' : 'none';
                });
            });
        }

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
