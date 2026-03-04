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
                    <i class="fas fa-book-open fa-8x text-blue"></i>
                </div>

                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-blue opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('coursdappuies.index') }}" class="text-blue opacity-75">Cours d'appui</a>
                                </li>
                                <li class="breadcrumb-item active text-blue" aria-current="page">Détails</li>
                            </ol>
                        </nav>

                        <h1 class="display-4 fw-bold text-blue mb-3">Détails du cours</h1>
                        <p class="text-blue opacity-90 lead mb-4">
                            Informations complètes sur <span class="fw-bold bg-white text-primary px-3 py-1 rounded-pill">{{ $coursdappuie->nom }}</span>
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('coursdappuies.index') }}" class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
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
                                <i class="fas fa-tag fa-2x text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="fw-bold mb-0">{{ $coursdappuie->nom }}</h3>
                            <p class="text-muted mb-0">Nom du cours</p>
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
                            <h3 class="fw-bold mb-0">{{ $coursdappuie->created_at->format('d/m/Y') }}</h3>
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
                            <h3 class="fw-bold mb-0">{{ $coursdappuie->created_at->diffForHumans() }}</h3>
                            <p class="text-muted mb-0">Créé il y a</p>
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
                        <!-- Logo -->
                        <div class="col-md-4 mb-4">
                            <div class="bg-light rounded-4 p-4 text-center">
                                @if($coursdappuie->logo)
                                    <img src="{{ asset('storage/' . $coursdappuie->logo) }}"
                                         alt="{{ $coursdappuie->nom }}"
                                         class="img-fluid rounded-3"
                                         style="max-height: 200px;">
                                @else
                                    <div class="bg-primary bg-opacity-10 rounded-3 p-5">
                                        <i class="fas fa-book-open fa-5x text-primary"></i>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Informations -->
                        <div class="col-md-8">
                            <div class="bg-light rounded-4 p-4">
                                <div class="mb-4">
                                    <label class="text-muted text-uppercase small fw-semibold">ID du cours</label>
                                    <div class="d-flex align-items-center mt-2">
                                        <div class="bg-primary bg-opacity-10 rounded-2 p-2 me-3">
                                            <i class="fas fa-fingerprint text-primary"></i>
                                        </div>
                                        <code class="fw-semibold">{{ $coursdappuie->id }}</code>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="text-muted text-uppercase small fw-semibold">Nom</label>
                                    <div class="d-flex align-items-center mt-2">
                                        <div class="bg-success bg-opacity-10 rounded-2 p-2 me-3">
                                            <i class="fas fa-tag text-success"></i>
                                        </div>
                                        <span class="fw-semibold">{{ $coursdappuie->nom }}</span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="text-muted text-uppercase small fw-semibold">Slogan</label>
                                    <div class="d-flex align-items-center mt-2">
                                        <div class="bg-info bg-opacity-10 rounded-2 p-2 me-3">
                                            <i class="fas fa-quote-right text-info"></i>
                                        </div>
                                        <span class="fw-semibold">"{{ $coursdappuie->slogan }}"</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="text-muted text-uppercase small fw-semibold">Date de création</label>
                                        <div class="d-flex align-items-center mt-2">
                                            <div class="bg-warning bg-opacity-10 rounded-2 p-2 me-3">
                                                <i class="fas fa-calendar-plus text-warning"></i>
                                            </div>
                                            <span>{{ $coursdappuie->created_at->format('d/m/Y à H:i') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-muted text-uppercase small fw-semibold">Dernière modification</label>
                                        <div class="d-flex align-items-center mt-2">
                                            <div class="bg-warning bg-opacity-10 rounded-2 p-2 me-3">
                                                <i class="fas fa-calendar-check text-warning"></i>
                                            </div>
                                            <span>{{ $coursdappuie->updated_at->format('d/m/Y à H:i') }}</span>
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
        <a href="{{ route('coursdappuies.edit', $coursdappuie->id) }}" class="btn btn-warning btn-lg px-5 rounded-pill shadow-sm hover-lift">
            <i class="fas fa-edit me-2"></i>Modifier
        </a>
        <button type="button"
                class="btn btn-outline-danger btn-lg px-5 rounded-pill shadow-sm hover-lift btn-delete"
                data-id="{{ $coursdappuie->id }}"
                data-name="{{ $coursdappuie->nom }}">
            <i class="fas fa-trash me-2"></i>Supprimer
        </button>
    </div>

    <!-- Formulaire de suppression caché -->
    <form id="delete-form-{{ $coursdappuie->id }}"
          action="{{ route('coursdappuies.destroy', $coursdappuie->id) }}"
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
                    <h5>Supprimer le cours "${name}" ?</h5>
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
