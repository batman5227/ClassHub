@extends('layouts.master')
@section('content')
<div class="container-fluid px-4 py-5">
    <!-- En-tête avec gradient -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient-primary rounded-4 p-5 shadow-lg position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-link fa-8x text-white"></i>
                </div>
                <div class="position-absolute bottom-0 start-0 opacity-10">
                    <i class="fas fa-users-gear fa-8x text-blue"></i>
                </div>

                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-white opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active text-white" aria-current="page">Affectations</li>
                            </ol>
                        </nav>

                        <h1 class="display-4 fw-bold text-blue mb-3">Gestion des affectations</h1>
                        <p class="text-blue opacity-90 lead mb-4">
                            Gérez les affectations des utilisateurs aux sites, cours d'appui et classes
                        </p>

                        <div class="d-flex gap-3">
                            <div class="bg-white bg-opacity-20 rounded-3 px-4 py-2">
                                <small class="text-blue opacity-75 d-block">Total affectations</small>
                                <span class="text-blue fw-bold">{{ $affectations->count() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('users-coursappuie-site-classes.create') }}" class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
                            <i class="fas fa-plus-circle me-2 text-primary"></i>Nouvelle affectation
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Messages flash -->
    @include('partials.flash-messages')

    <!-- Tableau des affectations -->
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="card-header bg-white border-0 p-4">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-list text-primary me-2"></i>
                        Liste des affectations
                    </h4>
                </div>
                <div class="col-auto">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" id="search-assignments"
                               placeholder="Rechercher...">
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3">Utilisateur</th>
                            <th class="px-4 py-3">Site</th>
                            <th class="px-4 py-3">Cours d'appui</th>
                            <th class="px-4 py-3">Classe</th>
                            <th class="px-4 py-3">Date d'affectation</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($affectations as $affectation)
                            <tr class="assignment-row"
                                data-search="{{ strtolower($affectation->user?->nom . ' ' . $affectation->user?->prenom . ' ' . $affectation->site?->nom . ' ' . $affectation->coursAppuie?->nom . ' ' . $affectation->classe?->nom) }}">
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 rounded-2 p-2 me-3">
                                            <i class="fas fa-user-circle text-primary fa-2x"></i>
                                        </div>
                                        <div>
                                            <span class="fw-semibold">{{ $affectation->user?->nom }} {{ $affectation->user?->prenom }}</span>
                                            <small class="text-muted d-block">{{ $affectation->user?->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-location-dot text-success me-2"></i>
                                        <span>{{ $affectation->site?->nom }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-book-open text-info me-2"></i>
                                        <span>{{ $affectation->coursAppuie?->nom }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-graduation-cap text-warning me-2"></i>
                                        <span>{{ $affectation->classe?->nom }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <i class="far fa-calendar-alt text-muted me-2"></i>
                                    <span>{{ $affectation->created_at->format('d/m/Y') }}</span>
                                    <small class="text-muted d-block">{{ $affectation->created_at->diffForHumans() }}</small>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('users-coursappuie-site-classes.show', $affectation->id) }}"
                                           class="btn btn-sm btn-outline-info rounded-pill px-3"
                                           data-bs-toggle="tooltip" title="Voir les détails">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('users-coursappuie-site-classes.edit', $affectation->id) }}"
                                           class="btn btn-sm btn-outline-warning rounded-pill px-3"
                                           data-bs-toggle="tooltip" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger rounded-pill px-3 btn-delete"
                                                data-id="{{ $affectation->id }}"
                                                data-name="l'affectation de {{ $affectation->user?->nom }}"
                                                data-bs-toggle="tooltip" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    <form id="delete-form-{{ $affectation->id }}"
                                        action="{{ route('users-coursappuie-site-classes.destroy', $affectation->id) }}"
                                        method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="fas fa-link-slash fa-4x text-muted mb-3"></i>
                                        <h5 class="text-muted">Aucune affectation trouvée</h5>
                                        <p class="text-muted mb-3">Commencez par créer une nouvelle affectation</p>
                                        <a href="{{ route('users-coursappuie-site-classes.create') }}" class="btn btn-primary rounded-pill px-4">
                                            <i class="fas fa-plus-circle me-2"></i>Nouvelle affectation
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .hover-lift {
        transition: transform 0.2s;
    }

    .hover-lift:hover {
        transform: translateY(-2px);
    }

    .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }

    .bg-opacity-20 {
        --bs-bg-opacity: 0.2;
    }

    .btn-outline-primary, .btn-outline-success, .btn-outline-danger, .btn-outline-info, .btn-outline-warning {
        border-width: 2px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Recherche
    const searchInput = document.getElementById('search-assignments');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const search = e.target.value.toLowerCase();
            document.querySelectorAll('.assignment-row').forEach(row => {
                const searchData = row.dataset.search;
                row.style.display = searchData.includes(search) ? '' : 'none';
            });
        });
    }

    // Suppression
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const id = this.dataset.id;
            const name = this.dataset.name;

            Swal.fire({
                title: 'Confirmation',
                html: `
                    <div class="text-center">
                        <i class="fas fa-exclamation-triangle text-warning fa-4x mb-3"></i>
                        <h5>Supprimer ${name} ?</h5>
                        <p class="text-muted">Cette action est irréversible.</p>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler',
                background: 'white',
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
});
</script>
@endpush
