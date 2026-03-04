@extends('layouts.master')
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
                    <i class="fas fa-chalkboard-teacher fa-8x text-blue"></i>
                </div>

                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-blue opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('classes.index') }}" class="text-blue opacity-75">Classes</a>
                                </li>
                                <li class="breadcrumb-item active text-blue" aria-current="page">Détails</li>
                            </ol>
                        </nav>

                        <h1 class="display-4 fw-bold text-blue mb-3">Détails de la classe</h1>
                        <p class="text-blue opacity-90 lead mb-4">
                            Informations complètes sur <span class="fw-bold bg-blue text-primary px-3 py-1 rounded-pill">{{ $classe->nom }}</span>
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('classes.index') }}" class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
                            <i class="fas fa-arrow-left me-2 text-primary"></i>Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cartes de statistiques -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 hover-shadow-lg transition-all">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-chalkboard fa-2x text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="fw-bold mb-0">{{ $classe->nom }}</h3>
                            <p class="text-muted mb-0">Nom de la classe</p>
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
                            <div class="bg-success bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-calendar-alt fa-2x text-success"></i>
                            </div>
                        </div>

                        <div class="flex-grow-1 ms-3">
                            <h3 class="fw-bold mb-0">{{ $classe->created_at}}</h3>
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
                                <i class="fas fa-users fa-2x text-info"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="fw-bold mb-0">{{ $classe->groupes->count() }}</h3>
                            <p class="text-muted mb-0">Groupes</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                                    <label class="text-muted small text-uppercase">ID de la classe</label>
                                    <div class="d-flex align-items-center mt-2">
                                        <div class="bg-primary bg-opacity-10 rounded-2 p-2 me-3">
                                            <i class="fas fa-fingerprint text-primary"></i>
                                        </div>
                                        <code class="fw-semibold">{{ $classe->id }}</code>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="text-muted small text-uppercase">Nom</label>
                                    <div class="d-flex align-items-center mt-2">
                                        <div class="bg-success bg-opacity-10 rounded-2 p-2 me-3">
                                            <i class="fas fa-chalkboard text-success"></i>
                                        </div>
                                        <span class="fw-semibold">{{ $classe->nom }}</span>
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
                                    <label class="text-muted small text-uppercase">Site associé</label>
                                    <div class="d-flex align-items-start mt-2">
                                        <div class="bg-info bg-opacity-10 rounded-2 p-2 me-3">
                                            <i class="fas fa-map-marker-alt text-info"></i>
                                        </div>
                                        <span class="fw-semibold">{{ $classe->site?->nom ?? 'Non assigné' }}</span>
                                    </div>
                                    @if($classe->site)
                                    <div class="mt-2">
                                        <small class="text-muted">
                                            <i class="fas fa-map-pin me-1"></i>
                                            {{ $classe->site->localisation ?? 'Localisation non spécifiée' }}
                                        </small>
                                    </div>
                                    @endif
                                </div>
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
                                                <span class="fw-semibold">{{ $classe->created_at }}</span>
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
                                                <span class="fw-semibold">{{ $classe->updated_at}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Liste des groupes -->
                        @if($classe->groupes->count() > 0)
                        <div class="col-12 mt-4">
                            <div class="bg-light rounded-4 p-4">
                                <h5 class="text-primary mb-3">
                                    <i class="fas fa-users me-2"></i>Groupes dans cette classe
                                </h5>
                                <div class="row g-2">
                                    @foreach($classe->groupes as $groupe)
                                    <div class="col-md-3">
                                        <div class="bg-white rounded-3 p-2 text-center">
                                            <span class="fw-semibold">{{ $groupe->nom }}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="d-flex justify-content-center gap-3 mt-5">
        <a href="{{ route('classes.edit', $classe) }}" class="btn btn-warning btn-lg px-5 rounded-pill shadow-sm hover-lift">
            <i class="fas fa-edit me-2"></i>Modifier
        </a>
        <a href="{{ route('groupes.create', ['classe' => $classe->id]) }}" class="btn btn-success btn-lg px-5 rounded-pill shadow-sm hover-lift">
            <i class="fas fa-plus-circle me-2"></i>Ajouter un groupe
        </a>
        <button type="button"
                class="btn btn-outline-danger btn-lg px-5 rounded-pill shadow-sm hover-lift btn-delete"
                data-id="{{ $classe->id }}"
                data-name="{{ $classe->nom }}">
            <i class="fas fa-trash me-2"></i>Supprimer
        </button>
    </div>

    <!-- Formulaire de suppression caché -->
    <form id="delete-form-{{ $classe->id }}"
          action="{{ route('classes.destroy', $classe->id) }}"
          method="POST"
          style="display: none;">
        @csrf
        @method('DELETE')
    </form>
</div>
@endsection

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
                    <h5>Supprimer la classe "${name}" ?</h5>
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
