@extends('layouts.master')

@section('title')
    Affectation des Rôles - ClassHub
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Affectation des Rôles aux Utilisateurs</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-gradient border-bottom d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="ri-shield-user-line me-2 fs-4 text-white"></i>
                        <h5 class="card-title mb-0 text-white">Liste des Affectations</h5>
                    </div>
                    <a href="{{ route('role-users.create') }}" class="btn btn-primary">
                        <i class="ri-add-line align-bottom"></i> Affecter un rôle
                    </a>
                </div>
                <div class="card-body">
                    @if($rolesUsers->isEmpty())
                        <div class="empty-state">
                            <i class="ri-shield-user-line"></i>
                            <h5>Aucune affectation trouvée</h5>
                            <p>Commencez par affecter un rôle à un utilisateur</p>
                            <a href="{{ route('role-users.create') }}" class="btn btn-primary mt-3">
                                <i class="ri-add-line me-1"></i> Affecter un rôle
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-uppercase fw-bold">Utilisateur</th>
                                        <th class="text-uppercase fw-bold">Rôle</th>
                                        <th class="text-uppercase fw-bold">Date d'affectation</th>
                                        <th class="text-uppercase fw-bold text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rolesUsers as $ru)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-3">{{ substr($ru->user->name ?? 'N/A', 0, 2) }}</div>
                                                <span class="fw-semibold">{{ $ru->user->name ?? 'N/A' }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-success-subtle text-success">
                                                {{ $ru->role->nom ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td><span class="text-muted"><i class="ri-calendar-line me-1"></i>{{ $ru->created_at->format('d/m/Y') }}</span></td>
                                        <td class="text-center">
                                            <div class="d-flex gap-2 justify-content-center">
                                                <a href="{{ route('role-users.show', $ru->id) }}" class="action-btn action-btn-view">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="{{ route('role-users.edit', $ru->id) }}" class="action-btn action-btn-edit">
                                                    <i class="ri-edit-line"></i>
                                                </a>
                                                <button type="button" class="action-btn action-btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $ru->id }}">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deleteModal{{ $ru->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirmation</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body text-center py-4">
                                                    <i class="ri-error-warning-line text-danger" style="font-size: 4rem;"></i>
                                                    <p class="mt-3">Supprimer l'affectation de <strong>{{ $ru->user->name ?? 'N/A' }}</strong> au rôle <strong>{{ $ru->role->nom ?? 'N/A' }}</strong>?</p>
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                                                    <form action="{{ route('role-users.destroy', $ru->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $rolesUsers->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
