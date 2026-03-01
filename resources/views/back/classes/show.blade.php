@extends('layouts.master')

@section('title')
    Détails de la Classe - ClassHub
@endsection

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">
                    <div class="classe-page-title">
                        <div class="classe-page-title-icon">
                            <i class="ri-school-line"></i>
                        </div>
                        Détails de la Classe
                    </div>
                </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('classes.index') }}">Classes</a></li>
                        <li class="breadcrumb-item active">Détails</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-8">
            <div class="card classe-card">
                <div class="card-header bg-gradient border-bottom d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="classe-avatar classe-avatar-lg me-3">
                            {{ substr($classe->nom, 0, 2) }}
                        </div>
                        <div>
                            <h5 class="card-title mb-0">{{ $classe->nom }}</h5>
                            <span class="text-white-50 fs-6">Classe</span>
                        </div>
                    </div>
                    <div class="badge bg-success-subtle text-success fs-6">
                        <i class="ri-check-line me-1"></i> Active
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="fw-bold text-uppercase text-muted mb-3">
                                <i class="ri-information-line me-2"></i>Informations
                            </h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td class="text-muted w-50"><strong>Nom:</strong></td>
                                    <td class="fw-semibold">{{ $classe->nom }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted"><strong>Site:</strong></td>
                                    <td>
                                        <span class="classe-badge classe-badge-site">
                                            <i class="ri-map-pin-line me-1"></i>{{ $classe->sites->nom ?? 'N/A' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted"><strong>Localisation:</strong></td>
                                    <td>{{ $classe->sites->localisation ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted"><strong>Date de création:</strong></td>
                                    <td>
                                        <i class="ri-calendar-line me-1 text-muted"></i>
                                        {{ $classe->created_at->format('d/m/Y H:i') }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold text-uppercase text-muted mb-3">
                                <i class="ri-book-2-line me-2"></i>Groupes de Matières
                            </h6>
                            @if($classe->classeMatiereGroupes->count() > 0)
                                <div class="list-group classe-list-group">
                                    @foreach($classe->classeMatiereGroupes as $cmg)
                                    <div class="list-group-item classe-list-group-item d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <i class="ri-book-mark-line text-primary me-3 fs-5"></i>
                                            <div>
                                                <span class="fw-semibold">{{ $cmg->matiere->nom ?? 'N/A' }}</span>
                                                <div class="text-muted small">{{ $cmg->matiere->description ?? '' }}</div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="classe-badge classe-badge-niveau">
                                                <i class="ri-group-line me-1"></i>{{ $cmg->groupe->nom ?? 'N/A' }}
                                            </span>
                                            <button type="button" class="classe-action-btn classe-action-btn-delete btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteCmgModal{{ $cmg->id }}">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="classe-empty-state py-4">
                                    <div class="classe-empty-icon" style="width: 60px; height: 60px;">
                                        <i class="ri-book-2-line" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <p class="text-muted mb-0">Aucun groupe de matières associé</p>
                                </div>
                            @endif

                            <!-- Add Matière Groupe Button -->
                            <button type="button" class="btn classe-btn classe-btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#addCmgModal">
                                <i class="ri-add-line me-1"></i> Ajouter une matière-groupe
                            </button>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top d-flex justify-content-between align-items-center">
                        <a href="{{ route('classes.index') }}" class="btn btn-light btn-lg">
                            <i class="ri-arrow-left-line me-1"></i>Retour
                        </a>
                        <div class="d-flex gap-2">
                            <a href="{{ route('classes.edit', $classe->id) }}" class="btn classe-btn classe-btn-success btn-lg text-dark">
                                <i class="ri-edit-line me-1"></i>Modifier
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card classe-card">
                <div class="card-header bg-gradient">
                    <h5 class="card-title mb-0 text-white">
                        <i class="ri-bar-chart-box-line me-2"></i>Statistiques
                    </h5>
                </div>
                <div class="card-body">
                    <div class="classe-stat-card mb-3">
                        <div class="classe-stat-icon classe-stat-icon-primary">
                            <i class="ri-book-2-line"></i>
                        </div>
                        <div class="classe-stat-number">{{ $classe->classeMatiereGroupes->count() }}</div>
                        <div class="classe-stat-label">Groupes de matières</div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted">Site</span>
                        <span class="fw-semibold">{{ $classe->sites->nom ?? 'N/A' }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted">Dernière modification</span>
                        <span class="fw-semibold">{{ $classe->updated_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Créé le</span>
                        <span class="fw-semibold">{{ $classe->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Add CMG Modal -->
<div class="modal fade" id="addCmgModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
            <div class="modal-header bg-gradient border-0 pb-0 justify-content-center position-relative">
                <div class="position-absolute top-0 end-0 mt-3 me-3">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="text-center">
                    <div class="modal-icon-wrapper mb-2">
                        <div class="modal-icon bg-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="ri-add-circle-line text-primary fs-1"></i>
                        </div>
                    </div>
                    <h4 class="modal-title text-white fw-bold">Nouvelle Association</h4>
                    <p class="text-white-50 mb-0">Ajouter une matière à cette classe</p>
                </div>
            </div>
            <div class="modal-body pt-4">
                <form action="{{ route('classes.storeMatieresGroupes', $classe->id) }}" method="POST" id="addCmgForm">
                    @csrf
                    <div class="mb-4">
                        <label for="idMatiere" class="form-label fw-semibold">
                            <i class="ri-book-2-line me-2 text-primary"></i>Matière
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="ri-book-mark-line text-muted"></i>
                            </span>
                            <select class="form-select form-select-lg" id="idMatiere" name="idMatiere" required>
                                <option value="">Sélectionner une matière...</option>
                                @foreach(\App\Models\Matiere::all() as $matiere)
                                <option value="{{ $matiere->id }}">{{ $matiere->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="idGroupe" class="form-label fw-semibold">
                            <i class="ri-group-line me-2 text-primary"></i>Groupe
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="ri-team-line text-muted"></i>
                            </span>
                            <select class="form-select form-select-lg" id="idGroupe" name="idGroupe" required>
                                <option value="">Sélectionner un groupe...</option>
                                @foreach(\App\Models\Groupe::all() as $groupe)
                                <option value="{{ $groupe->id }}">{{ $groupe->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg fw-semibold">
                            <i class="ri-check-line me-2"></i>Ajouter l'association
                        </button>
                        <button type="button" class="btn btn-light btn-lg" data-bs-dismiss="modal">
                            <i class="ri-close-line me-2"></i>Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Delete CMG Modals -->
@foreach($classe->classeMatiereGroupes as $cmg)
<div class="modal fade" id="deleteCmgModal{{ $cmg->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
            <div class="modal-body text-center p-4">
                <div class="delete-modal-icon mb-3">
                    <div class="bg-danger-subtle rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="ri-delete-bin-line text-danger fs-1"></i>
                    </div>
                </div>
                <h4 class="fw-bold mb-2">Confirmation</h4>
                <p class="text-muted mb-3">Êtes-vous sûr de vouloir supprimer cette association ?</p>
                <div class="bg-light rounded-3 p-3 mb-4">
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <span class="badge bg-primary-subtle text-primary fs-6">{{ $cmg->matiere->nom ?? 'N/A' }}</span>
                        <i class="ri-arrow-right-line text-muted"></i>
                        <span class="badge bg-success-subtle text-success fs-6">{{ $cmg->groupe->nom ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-light flex-grow-1 btn-lg" data-bs-dismiss="modal">
                        <i class="ri-arrow-left-line me-1"></i>Annuler
                    </button>
                    <form action="{{ route('classes.destroyMatieresGroupes', [$classe->id, $cmg->id]) }}" method="POST" class="flex-grow-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100 btn-lg">
                            <i class="ri-delete-bin-line me-1"></i>Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
    .modal-icon {
        transform: translateY(-50%);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .modal-header.bg-gradient {
        padding-top: 2rem;
        padding-bottom: 1rem;
    }
    .modal.fade .modal-content {
        transform: scale(0.9);
        opacity: 0;
        transition: all 0.3s ease;
    }
    .modal.show .modal-content {
        transform: scale(1);
        opacity: 1;
    }
    .form-select:focus, .form-control:focus {
        border-color: #5b7cfe;
        box-shadow: 0 0 0 0.2rem rgba(91, 124, 254, 0.15);
    }
    .input-group-text {
        border: none;
    }
    .delete-modal-icon {
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
</style>
@endsection
