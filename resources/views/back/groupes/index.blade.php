@extends('layouts.master')

@section('title')
    Groupes - ClassHub
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Gestion des Groupes</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Groupes</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-gradient border-bottom d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="ri-group-line me-2 fs-4 text-white"></i>
                        <h5 class="card-title mb-0 text-white">Liste des Groupes</h5>
                    </div>
                    <a href="{{ route('groupes.create') }}" class="btn btn-primary">
                        <i class="ri-add-line align-bottom"></i> Ajouter un groupe
                    </a>
                </div>
                <div class="card-body">
                    @if($groupes->isEmpty())
                    <div class="empty-state">
                        <i class="ri-group-line"></i>
                        <h5>Aucun groupe trouvé</h5>
                        <p>Commencez par ajouter votre premier groupe</p>
                        <a href="{{ route('groupes.create') }}" class="btn btn-primary mt-3">
                            <i class="ri-add-line me-1"></i>Ajouter un groupe
                        </a>
                    </div>
                    @else
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-uppercase fw-bold">Nom</th>
                                    <th class="text-uppercase fw-bold">Description</th>
                                    <th class="text-uppercase fw-bold">Date de création</th>
                                    <th class="text-uppercase fw-bold text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($groupes as $groupe)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-3">{{ substr($groupe->nom, 0, 2) }}</div>
                                            <span class="fw-semibold">{{ $groupe->nom }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $groupe->description ?? 'Aucune description' }}</td>
                                    <td><span class="text-muted"><i class="ri-calendar-line me-1"></i>{{ $groupe->created_at->format('d/m/Y') }}</span></td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{ route('groupes.show', $groupe->id) }}" class="action-btn action-btn-view"><i class="ri-eye-line"></i></a>
                                            <a href="{{ route('groupes.edit', $groupe->id) }}" class="action-btn action-btn-edit"><i class="ri-edit-line"></i></a>
                                            <button type="button" class="action-btn action-btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $groupe->id }}">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="deleteModal{{ $groupe->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header"><h5 class="modal-title">Confirmation</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                            <div class="modal-body text-center py-4">
                                                <i class="ri-error-warning-line text-danger" style="font-size: 4rem;"></i>
                                                <p class="mt-3">Supprimer <strong>{{ $groupe->nom }}</strong>?</p>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                                                <form action="{{ route('groupes.destroy', $groupe->id) }}" method="POST">@csrf @method('DELETE')<button type="submit" class="btn btn-danger">Supprimer</button></form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $groupes->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
