@extends('layouts.master')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

<div class="container-fluid px-4 py-5">

    <!-- En-tête avec gradient -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient rounded-4 p-5 shadow-lg position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-people-arrows fa-8x"></i>
                </div>
                <div class="position-absolute bottom-0 start-0 opacity-10">
                    <i class="fas fa-user-tag fa-8x"></i>
                </div>
                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-blue opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active text-blue" aria-current="page">Affectations</li>
                            </ol>
                        </nav>
                        <h1 class="display-4 fw-bold text-blue mb-3">Gestion des affectations</h1>
                        <p class="text-blue opacity-90 lead mb-4">Liste des rôles assignés aux utilisateurs</p>
                        <div class="d-flex gap-3">
                            <div class="bg-white bg-opacity-20 rounded-3 px-4 py-2">
                                <small class="text-blue opacity-75 d-block">Total affectations</small>
                                <span class="text-blue fw-bold">{{ $roleUsers->count() }}</span>
                            </div>
                            <div class="bg-white bg-opacity-20 rounded-3 px-4 py-2">
                                <small class="text-blue opacity-75 d-block">Utilisateurs distincts</small>
                                <span class="text-blue fw-bold">{{ $roleUsers->groupBy('idUsers')->count() }}</span>
                            </div>
                            <div class="bg-white bg-opacity-20 rounded-3 px-4 py-2">
                                <small class="text-blue opacity-75 d-block">Rôles distincts</small>
                                <span class="text-blue fw-bold">{{ $roleUsers->groupBy('idRole')->count() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('users.index') }}" class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
                            <i class="fas fa-users me-2 text-primary"></i>Gérer les utilisateurs
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Filtres -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">
            <div class="row g-3 align-items-center">
                <div class="col-lg-6">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" id="search-assignments"
                               placeholder="Rechercher par utilisateur ou rôle...">
                    </div>
                </div>
                <div class="col-lg-3">
                    <select class="form-select" id="filter-user">
                        <option value="">Tous les utilisateurs</option>
                        @foreach($roleUsers->groupBy('idUsers') as $userId => $userAssignments)
                            <option value="{{ $userId }}">
                                {{ $userAssignments->first()->user->nom }} {{ $userAssignments->first()->user->prenom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3">
                    <select class="form-select" id="filter-role">
                        <option value="">Tous les rôles</option>
                        @foreach($roleUsers->groupBy('idRole') as $roleId => $roleAssignments)
                            <option value="{{ $roleId }}">{{ $roleAssignments->first()->role->nom }}</option>
                        @endforeach
                    </select>
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
                        <i class="fas fa-list text-primary me-2"></i>Liste des affectations
                    </h4>
                    <p class="text-muted mb-0 mt-1">{{ $roleUsers->count() }} affectation(s) trouvée(s)</p>
                </div>
                <div class="col-auto">
                    <span class="text-muted">
                        <span id="displayed-count">{{ $roleUsers->count() }}</span> affichée(s)
                    </span>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3">Utilisateur</th>
                            <th class="px-4 py-3">Rôle assigné</th>
                            <th class="px-4 py-3">Description du rôle</th>
                            <th class="px-4 py-3">Date d'affectation</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roleUsers as $assignment)
                            <tr class="assignment-row"
                                data-user-id="{{ $assignment->idUsers }}"
                                data-role-id="{{ $assignment->idRole }}"
                                data-search="{{ strtolower($assignment->user->nom . ' ' . $assignment->user->prenom . ' ' . $assignment->role->nom) }}">
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 rounded-2 p-2 me-3">
                                            <i class="fas fa-user-circle text-primary fa-2x"></i>
                                        </div>
                                        <div>
                                            <span class="fw-semibold">{{ $assignment->user->nom }} {{ $assignment->user->prenom }}</span>
                                            <small class="text-muted d-block">
                                                <i class="fas fa-envelope me-1"></i>{{ $assignment->user->email }}
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-success bg-opacity-10 rounded-2 p-2 me-3">
                                            <i class="fas fa-tag text-success"></i>
                                        </div>
                                        <span class="fw-semibold">{{ $assignment->role->nom }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="text-muted">{{ $assignment->role->description ?? 'Aucune description' }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <i class="far fa-calendar-alt text-muted me-2"></i>
                                    {{ $assignment->created_at->format('d/m/Y') }}
                                    <small class="text-muted d-block">{{ $assignment->created_at->diffForHumans() }}</small>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('users.show', $assignment->idUsers) }}"
                                           class="btn btn-sm btn-outline-info rounded-pill px-3"
                                           title="Voir l'utilisateur">
                                            <i class="fas fa-user"></i>
                                        </a>
                                        <a href="{{ route('roles.show', $assignment->idRole) }}"
                                           class="btn btn-sm btn-outline-success rounded-pill px-3"
                                           title="Voir le rôle">
                                            <i class="fas fa-tag"></i>
                                        </a>
                                        {{-- ✅ Pas de data-bs-toggle --}}
                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger rounded-pill px-3 btn-delete"
                                                data-assign-id="{{ $assignment->id }}"
                                                data-assign-user="{{ $assignment->user->nom }} {{ $assignment->user->prenom }}"
                                                data-assign-role="{{ $assignment->role->nom }}"
                                                title="Retirer cette affectation">
                                            <i class="fas fa-unlink"></i>
                                        </button>
                                    </div>
                                    <form id="delete-form-{{ $assignment->id }}"
                                          action="{{ route('roleUsers.destroy', $assignment->id) }}"
                                          method="POST"
                                          style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="fas fa-people-arrows fa-4x text-muted mb-3 d-block"></i>
                                    <h5 class="text-muted">Aucune affectation trouvée</h5>
                                    <a href="{{ route('users.index') }}" class="btn btn-primary rounded-pill px-4 mt-2">
                                        <i class="fas fa-users me-2"></i>Gérer les utilisateurs
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($roleUsers->count() > 0)
        <div class="card-footer bg-white border-0 p-4">
            <span class="text-muted">Total : {{ $roleUsers->count() }} affectation(s)</span>
        </div>
        @endif
    </div>
</div>

<style>
    .bg-gradient-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important; }
    .hover-lift { transition: transform 0.2s ease; }
    .hover-lift:hover { transform: translateY(-2px); }
    .btn-outline-info, .btn-outline-success, .btn-outline-danger { border-width: 2px; transition: all 0.2s ease; }
    .btn-outline-info:hover, .btn-outline-success:hover, .btn-outline-danger:hover {
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
        var searchInput   = document.getElementById('search-assignments');
        var filterUser    = document.getElementById('filter-user');
        var filterRole    = document.getElementById('filter-role');
        var rows          = document.querySelectorAll('.assignment-row');
        var countSpan     = document.getElementById('displayed-count');

        function filterTable() {
            var search    = searchInput.value.toLowerCase();
            var userVal   = filterUser.value;
            var roleVal   = filterRole.value;
            var visible   = 0;
            rows.forEach(function(row) {
                var ok = (search === '' || row.dataset.search.includes(search))
                      && (userVal === '' || row.dataset.userId === userVal)
                      && (roleVal === '' || row.dataset.roleId === roleVal);
                row.style.display = ok ? '' : 'none';
                if (ok) visible++;
            });
            countSpan.textContent = visible;
        }

        searchInput.addEventListener('input', filterTable);
        filterUser.addEventListener('change', filterTable);
        filterRole.addEventListener('change', filterTable);

        document.querySelectorAll('.btn-delete').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var id       = this.getAttribute('data-assign-id');
                var userName = this.getAttribute('data-assign-user');
                var roleName = this.getAttribute('data-assign-role');

                Swal.fire({
                    title: 'Retirer cette affectation ?',
                    html: '<p>Rôle <strong class="text-danger">' + roleName + '</strong>'
                        + ' de <strong>' + userName + '</strong></p>'
                        + '<p class="text-muted"><small>Cette action retirera le rôle à l\'utilisateur.</small></p>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Oui, retirer',
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
