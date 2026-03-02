@extends('layouts.master')
@section('content')
<div class="container-fluid px-4 py-5">
    <!-- En-tête avec gradient -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient-primary rounded-4 p-5 shadow-lg position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-map-marker-alt fa-8x text-white"></i>
                </div>
                <div class="position-absolute bottom-0 start-0 opacity-10">
                    <i class="fas fa-building fa-8x text-white"></i>
                </div>

                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-white opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active text-white" aria-current="page">Sites</li>
                            </ol>
                        </nav>

                        <h1 class="display-4 fw-bold text-white mb-3">Gestion des sites</h1>
                        <p class="text-white opacity-90 lead mb-4">
                            Gérez les sites de l'application
                        </p>

                        <div class="d-flex gap-3">
                            <div class="bg-white bg-opacity-20 rounded-3 px-4 py-2">
                                <small class="text-white opacity-75 d-block">Total sites</small>
                                <span class="text-white fw-bold">{{ $site->count() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('sites.create') }}" class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
                            <i class="fas fa-plus-circle me-2 text-primary"></i>Nouveau site
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Messages flash -->
    {{-- @include('partials.flash-messages') --}}

    <!-- Filtres et recherche -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">
            <div class="row g-3 align-items-center">
                <div class="col-lg-8">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" id="search-sites"
                               placeholder="Rechercher par nom, localisation...">
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <span class="text-muted">
                        <i class="fas fa-layer-group me-1"></i>
                        <span id="displayed-count">{{ $site->count() }}</span> / {{ $site->count() }} affiché(s)
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Grille des sites -->
    <div class="row g-4" id="sites-grid">
        @forelse ($site as $site)
            <div class="col-xl-4 col-lg-6 site-item" data-name="{{ strtolower($site->nom . ' ' . $site->localisation) }}">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100 hover-lift">
                    <div class="card-header bg-white border-0 p-4 pb-0">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                            </div>
                            <span class="badge bg-light text-primary rounded-pill px-3 py-2">
                                <i class="far fa-clock me-1"></i>
                                {{ $site->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3">{{ $site->nom }}</h4>

                        <div class="mb-3">
                            <div class="d-flex align-items-center text-muted mb-2">
                                <i class="fas fa-map-pin me-2 text-primary"></i>
                                <span>{{ $site->localisation }}</span>
                            </div>

                            @if($site->idCoursDappuie)
                                <div class="d-flex align-items-center text-muted">
                                    <i class="fas fa-book-open me-2 text-success"></i>
                                    <span>Cours associé: ID {{ substr($site->idCoursDappuie, 0, 6) }}...</span>
                                </div>
                            @endif
                        </div>

                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-2 p-2 me-2">
                                <i class="fas fa-fingerprint text-primary"></i>
                            </div>
                            <small class="text-muted">
                                ID: {{ substr($site->id, 0, 6) }}...{{ substr($site->id, -4) }}
                            </small>
                        </div>
                    </div>

                    <div class="card-footer bg-white border-0 p-4 pt-0">
                        <div class="d-flex justify-content-between gap-2">
                            <a href="{{ route('sites.show', $site->id) }}"
                               class="btn btn-outline-info rounded-pill px-4 flex-grow-1"
                               data-bs-toggle="tooltip" title="Voir les détails">
                                <i class="fas fa-eye me-2"></i>Voir
                            </a>
                            <a href="{{ route('sites.edit', $site->id) }}"
                               class="btn btn-outline-warning rounded-pill px-4 flex-grow-1"
                               data-bs-toggle="tooltip" title="Modifier">
                                <i class="fas fa-edit me-2"></i>Modifier
                            </a>
                            <button type="button"
                                    class="btn btn-outline-danger rounded-pill px-4 flex-grow-1 btn-delete"
                                    data-id="{{ $site->id }}"
                                    data-name="{{ $site->nom }}"
                                    data-bs-toggle="tooltip" title="Supprimer">
                                <i class="fas fa-trash me-2"></i>Supprimer
                            </button>
                        </div>
                        <form id="delete-form-{{ $site->id }}"
                              action="{{ route('sites.destroy', $site->id) }}"
                              method="POST"
                              style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-map-marker-alt fa-5x text-muted"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Aucun site trouvé</h3>
                    <p class="text-muted mb-4">Commencez par créer un nouveau site</p>
                    <a href="{{ route('sites.create') }}" class="btn btn-primary btn-lg rounded-pill px-5">
                        <i class="fas fa-plus-circle me-2"></i>Créer un site
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .hover-lift {
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
    }

    .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }

    .bg-opacity-20 {
        --bs-bg-opacity: 0.2;
    }

    .btn-outline-primary, .btn-outline-success, .btn-outline-danger, .btn-outline-info, .btn-outline-warning {
        border-width: 2px;
        transition: all 0.2s;
    }

    .btn-outline-primary:hover, .btn-outline-success:hover, .btn-outline-danger:hover,
    .btn-outline-info:hover, .btn-outline-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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
    const searchInput = document.getElementById('search-sites');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const search = e.target.value.toLowerCase();
            let visibleCount = 0;

            document.querySelectorAll('.site-item').forEach(item => {
                const name = item.dataset.name;
                if (name.includes(search)) {
                    item.style.display = '';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            document.getElementById('displayed-count').textContent = visibleCount;
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
                        <h5>Supprimer le site "${name}" ?</h5>
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
