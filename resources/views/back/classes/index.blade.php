@extends('layouts.master')

@section('title')
    Classes - ClassHub
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
                        Gestion des Classes
                    </div>
                </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Classes</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card classe-card">
                <div class="card-header bg-gradient border-bottom d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="ri-list-check me-2 fs-4 text-white"></i>
                        <h5 class="card-title mb-0 text-white">Liste des Classes</h5>
                    </div>
                    <a href="{{ route('classes.create') }}" class="btn classe-btn classe-btn-primary">
                        <i class="ri-add-line align-bottom"></i> Ajouter une classe
                    </a>
                </div>
                <div class="card-body">
                    @if($classes->isEmpty())
                    <div class="classe-empty-state">
                        <div class="classe-empty-icon">
                            <i class="ri-school-line"></i>
                        </div>
                        <h5 class="classe-empty-title">Aucune classe trouvée</h5>
                        <p class="classe-empty-text">Commencez par ajouter votre première classe</p>
                        <a href="{{ route('classes.create') }}" class="btn classe-btn classe-btn-primary mt-3">
                            <i class="ri-add-line me-1"></i>Ajouter une classe
                        </a>
                    </div>
                    @else
                    <div class="table-responsive">
                        <table id="classes-table" class="table table-hover table-bordered dt-responsive nowrap table-striped align-middle classe-table" style="width:100%">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-uppercase fw-bold">Nom</th>
                                    <th class="text-uppercase fw-bold">Site</th>
                                    <th class="text-uppercase fw-bold">Date de création</th>
                                    <th class="text-uppercase fw-bold text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($classes as $classe)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="classe-avatar me-3">
                                                {{ substr($classe->nom, 0, 2) }}
                                            </div>
                                            <span class="fw-semibold">{{ $classe->nom }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="classe-badge classe-badge-site">
                                            <i class="ri-map-pin-line me-1"></i>{{ $classe->sites->nom ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-muted">
                                            <i class="ri-calendar-line me-1"></i>
                                            {{ $classe->created_at->format('d/m/Y') }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{ route('classes.show', $classe->id) }}" class="classe-action-btn classe-action-btn-view" title="Voir">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                            <a href="{{ route('classes.edit', $classe->id) }}" class="classe-action-btn classe-action-btn-edit" title="Modifier">
                                                <i class="ri-edit-line"></i>
                                            </a>
                                            <button type="button" class="classe-action-btn classe-action-btn-delete"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $classe->id }}"
                                                title="Supprimer">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $classes->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Delete Modals -->
@foreach($classes as $classe)
<div class="modal fade" id="deleteModal{{ $classe->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
            <div class="modal-body text-center p-4">
                <div class="delete-modal-icon mb-3">
                    <div class="bg-danger-subtle rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="ri-delete-bin-line text-danger fs-1"></i>
                    </div>
                </div>
                <h4 class="fw-bold mb-2">Supprimer la classe</h4>
                <p class="text-muted mb-3">Êtes-vous sûr de vouloir supprimer cette classe ? Cette action est irréversible.</p>
                <div class="bg-light rounded-3 p-3 mb-4">
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <div class="classe-avatar me-2" style="width: 40px; height: 40px; font-size: 14px;">
                            {{ substr($classe->nom, 0, 2) }}
                        </div>
                        <span class="fw-semibold">{{ $classe->nom }}</span>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-light flex-grow-1 btn-lg" data-bs-dismiss="modal">
                        <i class="ri-arrow-left-line me-1"></i>Annuler
                    </button>
                    <form action="{{ route('classes.destroy', $classe->id) }}" method="POST" class="flex-grow-1">
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
    .delete-modal-icon {
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
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
</style>
@endsection
