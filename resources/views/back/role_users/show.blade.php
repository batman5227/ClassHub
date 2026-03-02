@extends('layouts.master')

@section('title')
    Détails de l'Affectation - ClassHub
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Détails de l'Affectation</h4>
                <a href="{{ route('role-users.index') }}" class="btn btn-light">
                    <i class="ri-arrow-left-line me-1"></i> Retour
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Informations</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td class="text-muted w-50"><strong>Utilisateur:</strong></td>
                            <td>{{ $roleUser->user->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><strong>Email:</strong></td>
                            <td>{{ $roleUser->user->email ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><strong>Rôle:</strong></td>
                            <td>
                                <span class="badge bg-success-subtle text-success">
                                    {{ $roleUser->role->nom ?? 'N/A' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted"><strong>Date d'affectation:</strong></td>
                            <td>{{ $roleUser->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column gap-2">
                        <a href="{{ route('role-users.edit', $roleUser->id) }}" class="btn btn-primary">
                            <i class="ri-edit-line me-1"></i> Modifier
                        </a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="ri-delete-bin-line me-1"></i> Supprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="ri-alert-warning-line text-warning fs-1 mb-3"></i>
                <p>Êtes-vous sûr de vouloir supprimer cette affectation ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                <form action="{{ route('role-users.destroy', $roleUser->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
