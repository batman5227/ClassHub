@extends('layouts.master')

@section('content')

{{-- ✅ SweetAlert2 chargé DIRECTEMENT ici, pas dans @push --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

<div class="container-fluid px-4 py-5">

    <!-- En-tête avec gradient -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient rounded-4 p-5 shadow-lg position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-users-cog fa-8x"></i>
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
                                <li class="breadcrumb-item active text-blue" aria-current="page">Rôles</li>
                            </ol>
                        </nav>
                        <h1 class="display-4 fw-bold text-blue mb-3">Gestion des rôles</h1>
                        <p class="text-blue opacity-90 lead mb-4">
                            Gérez les rôles et leurs permissions dans l'application
                        </p>
                        <div class="d-flex gap-3">
                            <div class="bg-white bg-opacity-20 rounded-3 px-4 py-2">
                                <small class="text-blue opacity-75 d-block">Total rôles</small>
                                <span class="text-blue fw-bold fs-4">{{ count($roles) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('roles.create') }}"
                           class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
                            <i class="fas fa-plus-circle me-2"></i>Nouveau rôle
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Tableau des rôles -->
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="card-header bg-white border-0 p-4">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-list text-primary me-2"></i>Liste des rôles
                    </h4>
                    <p class="text-muted mb-0 mt-1">{{ count($roles) }} rôle(s) trouvé(s)</p>
                </div>
                <div class="col-auto">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0"
                               id="search-roles" placeholder="Rechercher un rôle...">
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="roles-table">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3">Nom du rôle</th>
                            <th class="px-4 py-3">Description</th>
                            <th class="px-4 py-3">Permissions</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                            <tr class="role-row" data-name="{{ strtolower($role->nom) }}">
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 rounded-2 p-2 me-3">
                                            <i class="fas fa-user-tag text-primary"></i>
                                        </div>
                                        <div>
                                            <span class="fw-semibold">{{ $role->nom }}</span>
                                            <small class="text-muted d-block">
                                                ID: {{ substr($role->id, 0, 8) }}...
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    {{ $role->description ?? 'Aucune description' }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="d-flex flex-wrap gap-1">
                                        @forelse ($role->permissions->take(3) as $permission)
                                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
                                                {{ $permission->nom }}
                                            </span>
                                        @empty
                                            <span class="text-muted fst-italic">Aucune permission</span>
                                        @endforelse
                                        @if($role->permissions->count() > 3)
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-2">
                                                +{{ $role->permissions->count() - 3 }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('roles.show', $role->id) }}"
                                           class="btn btn-sm btn-outline-info rounded-pill px-3"
                                           title="Voir les détails">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('roles.edit', $role->id) }}"
                                           class="btn btn-sm btn-outline-warning rounded-pill px-3"
                                           title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('roles.affecter', $role->id) }}"
                                           class="btn btn-sm btn-outline-success rounded-pill px-3"
                                           title="Affecter des permissions">
                                            <i class="fas fa-plus-circle"></i>
                                        </a>
                                        <a href="{{ route('roles.retirer', $role->id) }}"
                                           class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                           title="Retirer des permissions">
                                            <i class="fas fa-minus-circle"></i>
                                        </a>

                                        {{-- ✅ Bouton supprimer - AUCUN data-bs-toggle --}}
                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger rounded-pill px-3 btn-delete"
                                                data-role-id="{{ $role->id }}"
                                                data-role-name="{{ $role->nom }}"
                                                title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                    <form id="delete-form-{{ $role->id }}"
                                          action="{{ route('roles.destroy', $role->id) }}"
                                          method="POST"
                                          style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="fas fa-users-slash fa-4x text-muted mb-3 d-block"></i>
                                        <h5 class="text-muted">Aucun rôle trouvé</h5>
                                        <p class="text-muted mb-3">Commencez par créer un nouveau rôle</p>
                                        <a href="{{ route('roles.create') }}"
                                           class="btn btn-primary rounded-pill px-4">
                                            <i class="fas fa-plus-circle me-2"></i>Créer un rôle
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($roles->count() > 0)
        <div class="card-footer bg-white border-0 p-4">
            <span class="text-muted">Affichage de {{ $roles->count() }} rôle(s)</span>
        </div>
        @endif
    </div>
</div>

{{-- ======================================================
     ✅ STYLES — directement dans la section, pas en @push
     ====================================================== --}}
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    }
    .hover-lift {
        transition: transform 0.2s ease;
    }
    .hover-lift:hover {
        transform: translateY(-2px);
    }
    .btn-outline-primary, .btn-outline-success, .btn-outline-danger,
    .btn-outline-info, .btn-outline-warning, .btn-outline-secondary {
        border-width: 2px;
        transition: all 0.2s ease;
    }
    .btn-outline-primary:hover, .btn-outline-success:hover,
    .btn-outline-danger:hover, .btn-outline-info:hover,
    .btn-outline-warning:hover, .btn-outline-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .badge { font-weight: 500; letter-spacing: 0.3px; }

    /* Fix z-index SweetAlert au-dessus de tout */
    .swal2-container { z-index: 99999 !important; }
</style>

{{-- ======================================================
     ✅ SCRIPT — directement en bas de section, pas en @push
     Garantit que le HTML est présent avant l'exécution
     ====================================================== --}}
<script>
(function () {

    // Petite fonction utilitaire : attend qu'une variable globale soit disponible
    function waitFor(globalVar, callback, tries) {
        tries = tries || 0;
        if (tries > 50) {
            console.error('[ROLES] ' + globalVar + ' non disponible après 5s');
            return;
        }
        if (typeof window[globalVar] !== 'undefined') {
            callback();
        } else {
            setTimeout(function () {
                waitFor(globalVar, callback, tries + 1);
            }, 100);
        }
    }

    // Lance tout une fois que Swal ET le DOM sont prêts
    function init() {

        // ----- Recherche -----
        var searchInput = document.getElementById('search-roles');
        if (searchInput) {
            searchInput.addEventListener('input', function () {
                var search = this.value.toLowerCase();
                document.querySelectorAll('.role-row').forEach(function (row) {
                    row.style.display = row.dataset.name.includes(search) ? '' : 'none';
                });
            });
        }

        // ----- Suppression SweetAlert -----
        var deleteButtons = document.querySelectorAll('.btn-delete');
        console.log('[ROLES] Boutons delete trouvés :', deleteButtons.length);

        deleteButtons.forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                var roleId   = this.getAttribute('data-role-id');
                var roleName = this.getAttribute('data-role-name');

                console.log('[ROLES] Clic sur suppression :', roleName, '| ID :', roleId);

                Swal.fire({
                    title: 'Supprimer ce rôle ?',
                    html:
                        '<p class="mb-1">Vous allez supprimer le rôle :</p>' +
                        '<strong class="fs-5 text-danger">' + roleName + '</strong>' +
                        '<p class="text-muted mt-2 mb-0"><small>Cette action est irréversible.</small></p>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Oui, supprimer',
                    cancelButtonText: 'Annuler',
                    reverseButtons: true,
                    focusCancel: true
                }).then(function (result) {
                    if (result.isConfirmed) {
                        var form = document.getElementById('delete-form-' + roleId);
                        if (form) {
                            form.submit();
                        } else {
                            console.error('[ROLES] Formulaire introuvable : delete-form-' + roleId);
                        }
                    }
                });
            });
        });
    }

    // ✅ On attend que Swal soit chargé (géré par "defer" sur la balise script CDN)
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            waitFor('Swal', init);
        });
    } else {
        waitFor('Swal', init);
    }

})();
</script>

@endsection
