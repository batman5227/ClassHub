@extends('layouts.master')

@section('title')
    Utilisateurs - ClassHub
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Gestion des Utilisateurs</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Utilisateurs</li>
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
                        <i class="ri-user-settings-line me-2 fs-4 text-white"></i>
                        <h5 class="card-title mb-0 text-white">Liste des Utilisateurs</h5>
                    </div>
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        <i class="ri-add-line align-bottom"></i> Ajouter
                    </a>
                </div>
                <div class="card-body">
                    @if($users->isEmpty())
                    <div class="empty-state">
                        <i class="ri-user-settings-line"></i>
                        <h5>Aucun utilisateur</h5>
                        <a href="{{ route('users.create') }}" class="btn btn-primary mt-3">Ajouter</a>
                    </div>
                    @else
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-uppercase fw-bold">Nom</th>
                                    <th class="text-uppercase fw-bold">Email</th>
                                    <th class="text-uppercase fw-bold">Statut</th>
                                    <th class="text-uppercase fw-bold">Date</th>
                                    <th class="text-uppercase fw-bold text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td><span class="fw-semibold">{{ $user->name }}</span></td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->status === 'actif')
                                            <span class="badge bg-success">Actif</span>
                                        @else
                                            <span class="badge bg-danger">Inactif</span>
                                        @endif
                                    </td>
                                    <td><span class="text-muted">{{ $user->created_at->format('d/m/Y') }}</span></td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{ route('users.show', $user->id) }}" class="action-btn action-btn-view"><i class="ri-eye-line"></i></a>
                                            <a href="{{ route('users.edit', $user->id) }}" class="action-btn action-btn-edit"><i class="ri-edit-line"></i></a>
                                            <button type="button" class="action-btn action-btn-delete" onclick="confirmDelete('{{ route('users.destroy', $user->id) }}', '{{ $user->name }}')"><i class="ri-delete-bin-line"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $users->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Simple Delete Confirmation -->
<div id="deleteConfirmBox" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 9999; align-items: center; justify-content: center;">
    <div style="background: var(--bg-secondary); padding: 30px 40px; border-radius: 16px; text-align: center; max-width: 400px; border: 1px solid rgba(255,255,255,0.1);">
        <i class="ri-error-warning-line" style="font-size: 4rem; color: var(--accent-secondary);"></i>
        <h4 style="margin: 20px 0; color: var(--text-primary);">Confirmation</h4>
        <p id="deleteConfirmText" style="color: var(--text-secondary); margin-bottom: 25px;"></p>
        <div style="display: flex; gap: 15px; justify-content: center;">
            <button onclick="closeDeleteConfirm()" class="btn btn-light">Annuler</button>
            <a id="deleteConfirmBtn" href="#" class="btn btn-danger">Supprimer</a>
        </div>
    </div>
</div>

<script>
function confirmDelete(url, name) {
    document.getElementById('deleteConfirmText').textContent = 'Voulez-vous vraiment supprimer "' + name + '" ?';
    document.getElementById('deleteConfirmBtn').href = url;
    document.getElementById('deleteConfirmBox').style.display = 'flex';
}

function closeDeleteConfirm() {
    document.getElementById('deleteConfirmBox').style.display = 'none';
}
</script>
@endsection
