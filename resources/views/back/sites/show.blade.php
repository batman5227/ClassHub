@extends('layouts.master')
<<<<<<< HEAD

@section('title')
    Détails du Site - ClassHub
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Détails du Site</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('sites.index') }}">Sites</a></li>
                        <li class="breadcrumb-item active">Détails</li>
                    </ol>
=======
@section('content')
<div class="container-fluid px-4 py-5">
    <!-- En-tête avec gradient -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient-primary rounded-4 p-5 shadow-lg position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-info-circle fa-8x text-blue"></i>
                </div>
                <div class="position-absolute bottom-0 start-0 opacity-10">
                    <i class="fas fa-map-marker-alt fa-8x text-blue"></i>
                </div>

                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-blue opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('sites.index') }}" class="text-blue opacity-75">Sites</a>
                                </li>
                                <li class="breadcrumb-item active text-blue" aria-current="page">Détails</li>
                            </ol>
                        </nav>

                        <h1 class="display-4 fw-bold text-blue mb-3">Détails du site</h1>
                        <p class="text-blue opacity-90 lead mb-4">
                            Informations complètes sur <span class="fw-bold bg-blue text-primary px-3 py-1 rounded-pill">{{ $site->nom }}</span>
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('sites.index') }}" class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
                            <i class="fas fa-arrow-left me-2 text-primary"></i>Retour
                        </a>
                    </div>
>>>>>>> 648231892ef47f692adac586301ec21d732a5abc
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-gradient border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="avatar me-3" style="width:50px;height:50px;font-size:18px">{{ substr($site->nom, 0, 2) }}</div>
                        <div><h5 class="card-title mb-0 text-white">{{ $site->nom }}</h5><span class="text-white-50">Site</span></div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr><td class="text-muted w-50"><strong>Nom:</strong></td><td class="fw-semibold">{{ $site->nom }}</td></tr>
                        <tr><td class="text-muted"><strong>Localisation:</strong></td><td>{{ $site->localisation }}</td></tr>
                        <tr><td class="text-muted"><strong>Créé le:</strong></td><td>{{ $site->created_at ? $site->created_at->format('d/m/Y H:i') : 'N/A' }}</td></tr>
                    </table>
                    <div class="mt-4 pt-3 border-top d-flex justify-content-between">
                        <a href="{{ route('sites.index') }}" class="btn btn-light"><i class="ri-arrow-left-line me-1"></i>Retour</a>
                        <a href="{{ route('sites.edit', $site->id) }}" class="btn btn-success"><i class="ri-edit-line me-1"></i>Modifier</a>
=======

    <!-- Cartes de statistiques -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 hover-shadow-lg transition-all">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="fw-bold mb-0">{{ $site->nom }}</h3>
                            <p class="text-muted mb-0">Nom du site</p>
                        </div>
>>>>>>> 648231892ef47f692adac586301ec21d732a5abc
                    </div>
                </div>
            </div>
        </div>
<<<<<<< HEAD
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-gradient"><h5 class="card-title mb-0 text-white">Statistiques</h5></div>
                <div class="card-body">
                    <div class="stat-card">
                        <div class="d-flex align-items-center">
                            <div class="stat-card-icon"><i class="ri-home-line"></i></div>
                            <div class="ms-3"><div class="stat-card-number">-</div><div class="stat-card-label">Classes</div></div>
=======

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 hover-shadow-lg transition-all">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-calendar-alt fa-2x text-success"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="fw-bold mb-0">{{ $site->created_at}}</h3>
                            <p class="text-muted mb-0">Date de création</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 hover-shadow-lg transition-all">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-clock fa-2x text-info"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="fw-bold mb-0">{{ $site->created_at }}</h3>
                            <p class="text-muted mb-0">Créé il y a</p>
>>>>>>> 648231892ef47f692adac586301ec21d732a5abc
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
</div>
@endsection
=======

    <!-- Détails complets -->
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 p-4">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        Informations détaillées
                    </h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="bg-light rounded-4 p-4">
                                <h5 class="text-primary mb-3">
                                    <i class="fas fa-tag me-2"></i>Identité
                                </h5>

                                <div class="mb-3">
                                    <label class="text-muted small text-uppercase">ID du site</label>
                                    <div class="d-flex align-items-center mt-2">
                                        <div class="bg-primary bg-opacity-10 rounded-2 p-2 me-3">
                                            <i class="fas fa-fingerprint text-primary"></i>
                                        </div>
                                        <code class="fw-semibold">{{ $site->id }}</code>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="text-muted small text-uppercase">Nom</label>
                                    <div class="d-flex align-items-center mt-2">
                                        <div class="bg-success bg-opacity-10 rounded-2 p-2 me-3">
                                            <i class="fas fa-map-marker-alt text-success"></i>
                                        </div>
                                        <span class="fw-semibold">{{ $site->nom }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="bg-light rounded-4 p-4">
                                <h5 class="text-primary mb-3">
                                    <i class="fas fa-location-dot me-2"></i>Localisation
                                </h5>

                                <div class="mb-3">
                                    <label class="text-muted small text-uppercase">Adresse / Coordonnées</label>
                                    <div class="d-flex align-items-start mt-2">
                                        <div class="bg-info bg-opacity-10 rounded-2 p-2 me-3">
                                            <i class="fas fa-map-pin text-info"></i>
                                        </div>
                                        <span class="fw-semibold">{{ $site->localisation }}</span>
                                    </div>
                                </div>

                                @if($site->idCoursDappuie)
                                <div class="mb-3">
                                    <label class="text-muted small text-uppercase">Cours d'appui associé</label>
                                    <div class="d-flex align-items-center mt-2">
                                        <div class="bg-warning bg-opacity-10 rounded-2 p-2 me-3">
                                            <i class="fas fa-book-open text-warning"></i>
                                        </div>
                                        <span class="fw-semibold">{{ $site->idCoursDappuie }}</span>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="bg-light rounded-4 p-4">
                                <h5 class="text-primary mb-3">
                                    <i class="fas fa-history me-2"></i>Historique
                                </h5>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="bg-primary bg-opacity-10 rounded-2 p-3 me-3">
                                                    <i class="fas fa-calendar-plus text-primary fa-lg"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Date de création</small>
                                                <span class="fw-semibold">{{ $site->created_at }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="bg-info bg-opacity-10 rounded-2 p-3 me-3">
                                                    <i class="fas fa-calendar-check text-info fa-lg"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Dernière modification</small>
                                                <span class="fw-semibold">{{ $site->updated_at }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="d-flex justify-content-center gap-3 mt-5">
        <a href="{{ route('sites.edit', $site) }}" class="btn btn-warning btn-lg px-5 rounded-pill shadow-sm hover-lift">
            <i class="fas fa-edit me-2"></i>Modifier
        </a>
        <button type="button"
                class="btn btn-outline-danger btn-lg px-5 rounded-pill shadow-sm hover-lift btn-delete"
                data-id="{{ $site->id }}"
                data-name="{{ $site->nom }}">
            <i class="fas fa-trash me-2"></i>Supprimer
        </button>
    </div>

    <!-- Formulaire de suppression caché -->
    <form id="delete-form-{{ $site->id }}"
          action="{{ route('sites.destroy', $site->id) }}"
          method="POST"
          style="display: none;">
        @csrf
        @method('DELETE')
    </form>
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

    .hover-shadow-lg:hover {
        box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
    }

    .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }

    code {
        background: none;
        color: #667eea;
        font-size: 0.9rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelector('.btn-delete')?.addEventListener('click', function(e) {
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
</script>
@endpush
>>>>>>> 648231892ef47f692adac586301ec21d732a5abc
