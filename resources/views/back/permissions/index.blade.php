@extends('layouts.master')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

<div class="container-fluid px-4 py-5">

    <!-- En-tête -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient rounded-4 p-5 shadow-lg position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-key fa-8x"></i>
                </div>
                <div class="position-absolute bottom-0 start-0 opacity-10">
                    <i class="fas fa-shield-alt fa-8x"></i>
                </div>
                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-blue opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active text-blue" aria-current="page">Permissions</li>
                            </ol>
                        </nav>
                        <h1 class="display-4 fw-bold text-blue mb-3">Gestion des permissions</h1>
                        <p class="text-blue opacity-90 lead mb-4">Gérez les permissions de l'application</p>
                        <div class="d-flex gap-3">
                            <div class="bg-white bg-opacity-20 rounded-3 px-4 py-2">
                                <small class="text-blue opacity-75 d-block">Total permissions</small>
                                <span class="text-blue fw-bold">{{ count($permissions) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('permissions.create') }}"
                           class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
                            <i class="fas fa-plus-circle me-2 text-primary"></i>Nouvelle permission
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Tableau -->
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="card-header bg-white border-0 p-4">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-list text-primary me-2"></i>Liste des permissions
                    </h4>
                    <p class="text-muted mb-0 mt-1">{{ count($permissions) }} permission(s) trouvée(s)</p>
                </div>
                <div class="col-auto">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" id="search-permissions"
                               placeholder="Rechercher une permission...">
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3">Nom de la permission</th>
                            <th class="px-4 py-3">Description</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permissions as $permission)
                            <tr class="permission-row" data-name="{{ strtolower($permission->nom) }}">
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 rounded-2 p-2 me-3">
                                            <i class="fas fa-key text-primary"></i>
                                        </div>
                                        <div>
                                            <span class="fw-semibold">{{ $permission->nom }}</span>
                                            <small class="text-muted d-block">
                                                {{ substr($permission->id, 0, 6) }}...{{ substr($permission->id, -4) }}
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">{{ $permission->description ?? 'Aucune description' }}</td>
                                <td class="px-4 py-3 text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('permissions.show', $permission->id) }}"
                                           class="btn btn-sm btn-outline-info rounded-pill px-3"
                                           title="Voir les détails">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('permissions.edit', $permission->id) }}"
                                           class="btn btn-sm btn-outline-warning rounded-pill px-3"
                                           title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        {{-- ✅ Pas de data-bs-toggle --}}
                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger rounded-pill px-3 btn-delete"
                                                data-perm-id="{{ $permission->id }}"
                                                data-perm-name="{{ $permission->nom }}"
                                                title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    <form id="delete-form-{{ $permission->id }}"
                                          action="{{ route('permissions.destroy', $permission) }}"
                                          method="POST"
                                          style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-5">
                                    <i class="fas fa-key fa-4x text-muted mb-3 d-block"></i>
                                    <h5 class="text-muted">Aucune permission trouvée</h5>
                                    <a href="{{ route('permissions.create') }}"
                                       class="btn btn-primary rounded-pill px-4 mt-2">
                                        <i class="fas fa-plus-circle me-2"></i>Créer une permission
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($permissions->count() > 0)
        <div class="card-footer bg-white border-0 p-4">
            <span class="text-muted">Affichage de {{ $permissions->count() }} permission(s)</span>
        </div>
        @endif
    </div>
</div>

<style>
    .bg-gradient-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important; }
    .hover-lift { transition: transform 0.2s ease; }
    .hover-lift:hover { transform: translateY(-2px); }
    .btn-outline-info, .btn-outline-warning, .btn-outline-danger { border-width: 2px; transition: all 0.2s ease; }
    .btn-outline-info:hover, .btn-outline-warning:hover, .btn-outline-danger:hover {
        transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .swal2-container { z-index: 99999 !important; }
</style>

<script>
(function () {
    function waitFor(v, cb, t) {
        t = t || 0;
        if (t > 50) return;
        typeof window[v] !== 'undefined' ? cb() : setTimeout(function(){ waitFor(v, cb, t+1); }, 100);
    }

    function init() {
        var searchInput = document.getElementById('search-permissions');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                var search = this.value.toLowerCase();
                document.querySelectorAll('.permission-row').forEach(function(row) {
                    row.style.display = row.dataset.name.includes(search) ? '' : 'none';
                });
            });
        }

        document.querySelectorAll('.btn-delete').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var id   = this.getAttribute('data-perm-id');
                var name = this.getAttribute('data-perm-name');

                Swal.fire({
                    title: 'Supprimer cette permission ?',
                    html: '<p>Permission : <strong class="text-danger">' + name + '</strong></p>'
                        + '<p class="text-muted"><small>Cette action est irréversible.</small></p>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Oui, supprimer',
                    cancelButtonText: 'Annuler',
                    reverseButtons: true,
                    focusCancel: true
                }).then(function(result) {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            });
        });
    }

    document.readyState === 'loading'
        ? document.addEventListener('DOMContentLoaded', function(){ waitFor('Swal', init); })
        : waitFor('Swal', init);
})();
</script>

@endsection
