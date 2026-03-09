@extends('layouts.master')

@section('title')
    Associations Classe-Matière-Groupe - ClassHub
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
                    <i class="fas fa-links fa-8x text-blue"></i>
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
                                <li class="breadcrumb-item active text-blue" aria-current="page">Associations Classe-Matière-Groupe</li>
                            </ol>
                        </nav>
                        <h1 class="display-4 fw-bold text-blue mb-3">Gestion des associations</h1>
                        <p class="text-blue opacity-90 lead mb-4">Gérez les associations entre classes, matières et groupes</p>
                        <div class="d-flex gap-3">
                            <div class="bg-white bg-opacity-20 rounded-3 px-4 py-2">
                                <small class="text-blue opacity-75 d-block">Total associations</small>
                                <span class="text-blue fw-bold">{{ $classeMatiereGroupes->total() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('classe-matiere-groupe.create') }}"
                           class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
                            <i class="fas fa-plus-circle me-2 text-primary"></i>Nouvelle association
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

    <!-- Filtres et recherche -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">
            <div class="row g-3 align-items-center">
                <div class="col-lg-8">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" id="search-associations"
                               placeholder="Rechercher par classe, matière ou groupe...">
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <span class="text-muted">
                        <i class="fas fa-layer-group me-1"></i>
                        <span id="displayed-count">{{ $classeMatiereGroupes->count() }}</span> / {{ $classeMatiereGroupes->total() }} affiché(s)
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau -->
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="card-header bg-white border-0 p-4">
            <h4 class="mb-0 fw-bold">
                <i class="fas fa-list text-primary me-2"></i>Liste des associations
            </h4>
        </div>

        <div class="card-body p-0">
            @if($classeMatiereGroupes->isEmpty())
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-project-diagram fa-5x text-muted"></i>
                    </div>
                    <h5 class="text-muted">Aucune association trouvée</h5>
                    <p class="text-muted mb-3">Commencez par créer votre première association</p>
                    <a href="{{ route('classe-matiere-groupe.create') }}"
                       class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-plus-circle me-2"></i>Nouvelle association
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3">Classe</th>
                                <th class="px-4 py-3">Matière</th>
                                <th class="px-4 py-3">Groupe</th>
                                <th class="px-4 py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($classeMatiereGroupes as $cmg)
                                <tr class="association-row"
                                    data-search="{{ strtolower(
                                        ($cmg->classe->nom ?? '') . ' ' .
                                        ($cmg->matiere->nom ?? '') . ' ' .
                                        ($cmg->groupe->nom ?? '')
                                    ) }}">
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded-3 p-3 me-3">
                                                <i class="fas fa-chalkboard fa-2x text-primary"></i>
                                            </div>
                                            <div>
                                                <span class="fw-semibold">{{ $cmg->classe->nom ?? 'N/A' }}</span>
                                                @if($cmg->classe)
                                                    <small class="text-muted d-block">
                                                        <i class="fas fa-calendar-alt me-1"></i>{{ $cmg->classe->anneeScolaire?->annee ?? 'Année N/A' }}
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-info bg-opacity-10 rounded-3 p-2 me-2">
                                                <i class="fas fa-book text-info"></i>
                                            </div>
                                            <span>{{ $cmg->matiere->nom ?? 'N/A' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-success bg-opacity-10 rounded-3 p-2 me-2">
                                                <i class="fas fa-users text-success"></i>
                                            </div>
                                            <span>{{ $cmg->groupe->nom ?? 'N/A' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <!-- Voir -->
                                            <a href="{{ route('classe-matiere-groupe.show', $cmg->id) }}"
                                               class="btn btn-sm btn-outline-info rounded-pill px-3"
                                               data-bs-toggle="tooltip" title="Voir les détails">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <!-- Supprimer -->
                                            <button type="button"
                                                    class="btn btn-sm btn-outline-danger rounded-pill px-3 btn-delete"
                                                    data-id="{{ $cmg->id }}"
                                                    data-association="{{ $cmg->classe->nom ?? 'N/A' }} - {{ $cmg->matiere->nom ?? 'N/A' }} - {{ $cmg->groupe->nom ?? 'N/A' }}"
                                                    data-bs-toggle="tooltip" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        <form id="delete-form-{{ $cmg->id }}"
                                              action="{{ route('classe-matiere-groupe.destroy', $cmg->id) }}"
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

        @if($classeMatiereGroupes->hasPages())
            <div class="card-footer bg-white border-0 p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted">Affichage de {{ $classeMatiereGroupes->count() }} association(s) sur {{ $classeMatiereGroupes->total() }}</span>
                    <div class="pagination">
                        {{ $classeMatiereGroupes->links() }}
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
    .btn-outline-info, .btn-outline-danger {
        border-width: 2px;
        transition: all 0.2s ease;
    }
    .btn-outline-info:hover, .btn-outline-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .swal2-container { z-index: 99999 !important; }
    .bg-opacity-10 { --bs-bg-opacity: 0.1; }
    .bg-opacity-20 { --bs-bg-opacity: 0.2; }
    .pagination { margin-bottom: 0; }
    .pagination > * {
        border-radius: 50px !important;
        margin: 0 2px;
    }
    .table > :not(caption) > * > * {
        padding: 1rem 1rem;
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
        const searchInput = document.getElementById('search-associations');
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                const search = e.target.value.toLowerCase();
                let visibleCount = 0;
                document.querySelectorAll('.association-row').forEach(item => {
                    const text = item.dataset.search;
                    if (text.includes(search)) {
                        item.style.display = '';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });
                document.getElementById('displayed-count').textContent = visibleCount;
            });
        }

        // Suppression avec SweetAlert
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const id = this.dataset.id;
                const association = this.dataset.association;

                Swal.fire({
                    title: 'Supprimer cette association ?',
                    html: `
                        <div class="text-center">
                            <i class="fas fa-exclamation-triangle text-warning fa-4x mb-3"></i>
                            <p class="fw-bold mb-2">${association}</p>
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
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${id}`).submit();
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
