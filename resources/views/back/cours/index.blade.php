@extends('layouts.master')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

<div class="container-fluid px-4 py-5">

    <!-- En-tête -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient rounded-4 p-5 shadow-lg position-relative overflow-hidden"
                 style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-book-open fa-8x text-white"></i>
                </div>
                <div class="position-absolute bottom-0 start-0 opacity-10">
                    <i class="fas fa-chalkboard-teacher fa-8x text-white"></i>
                </div>
                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-white opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active text-white" aria-current="page">Cours</li>
                            </ol>
                        </nav>
                        <h1 class="display-4 fw-bold text-white mb-3">Gestion des cours</h1>
                        <p class="text-white opacity-90 lead mb-4">Gérez tous les cours de l'établissement</p>
                        <div class="d-flex gap-3">
                            <div class="bg-white bg-opacity-20 rounded-3 px-4 py-2">
                                <small class="text-white opacity-75 d-block">Total cours</small>
                                <span class="text-white fw-bold">{{ $cours->total() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('cours.create') }}"
                           class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
                            <i class="fas fa-plus-circle me-2 text-primary"></i>Nouveau cours
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
                        <i class="fas fa-list text-primary me-2"></i>Liste des cours
                    </h4>
                    <p class="text-muted mb-0 mt-1">{{ $cours->total() }} cours trouvé(s)</p>
                </div>
                <div class="col-auto">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" id="search-cours"
                               placeholder="Rechercher un cours...">
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3">Cours</th>
                            <th class="px-4 py-3">Matière</th>
                            <th class="px-4 py-3">Classe</th>
                            <th class="px-4 py-3">Date de création</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cours as $cour)
                            <tr class="cours-row"
                                data-name="{{ strtolower($cour->nom . ' ' . ($cour->matiere->nom ?? '') . ' ' . ($cour->matiere->classe->nom ?? '')) }}">
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 rounded-3 p-3 me-3">
                                            <i class="fas fa-book-open fa-2x text-primary"></i>
                                        </div>
                                        <div>
                                            <span class="fw-semibold">{{ $cour->nom }}</span>
                                            <small class="text-muted d-block">
                                                ID: {{ substr($cour->id, 0, 6) }}...{{ substr($cour->id, -4) }}
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-2">
                                        <i class="fas fa-book me-1"></i>{{ $cour->matiere->nom ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    @if($cour->matiere && $cour->matiere->classe)
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">
                                            <i class="fas fa-users me-1"></i>{{ $cour->matiere->classe->nom }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-2">
                                            <i class="fas fa-times-circle me-1"></i>Non assignée
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <i class="far fa-calendar-alt text-muted me-2"></i>
                                    {{ $cour->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- Voir -->
                                        <a href="{{ route('cours.show', $cour->id) }}"
                                           class="btn btn-sm btn-outline-info rounded-pill px-3"
                                           data-bs-toggle="tooltip" title="Voir les détails">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <!-- Modifier -->
                                        <a href="{{ route('cours.edit', $cour->id) }}"
                                           class="btn btn-sm btn-outline-warning rounded-pill px-3"
                                           data-bs-toggle="tooltip" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- Supprimer -->
                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger rounded-pill px-3 btn-delete"
                                                data-cours-id="{{ $cour->id }}"
                                                data-cours-nom="{{ $cour->nom }}"
                                                data-bs-toggle="tooltip" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    <form id="delete-form-{{ $cour->id }}"
                                          action="{{ route('cours.destroy', $cour->id) }}"
                                          method="POST"
                                          style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="fas fa-book-open fa-4x text-muted mb-3 d-block"></i>
                                    <h5 class="text-muted">Aucun cours trouvé</h5>
                                    <a href="{{ route('cours.create') }}"
                                       class="btn btn-primary rounded-pill px-4 mt-2">
                                        <i class="fas fa-plus-circle me-2"></i>Ajouter un cours
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($cours->count() > 0)
        <div class="card-footer bg-white border-0 p-4">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted">Affichage de {{ $cours->count() }} cours</span>
                <div class="pagination">
                    {{ $cours->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
    .bg-gradient {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }
    .hover-lift { transition: transform 0.2s ease; }
    .hover-lift:hover { transform: translateY(-2px); }
    .btn-outline-info, .btn-outline-warning, .btn-outline-danger {
        border-width: 2px;
        transition: all 0.2s ease;
    }
    .btn-outline-info:hover, .btn-outline-warning:hover, .btn-outline-danger:hover {
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
        var searchInput = document.getElementById('search-cours');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                var search = this.value.toLowerCase();
                document.querySelectorAll('.cours-row').forEach(function(row) {
                    var name = row.dataset.name;
                    row.style.display = name.includes(search) ? '' : 'none';
                });
            });
        }

        // Suppression
        document.querySelectorAll('.btn-delete').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var id   = this.getAttribute('data-cours-id');
                var nom = this.getAttribute('data-cours-nom');

                Swal.fire({
                    title: 'Supprimer ce cours ?',
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
