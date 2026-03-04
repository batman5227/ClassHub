@extends('layouts.master')
@section('content')
<div class="container-fluid px-4 py-5">
    <!-- En-tête avec gradient -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient-primary rounded-4 p-5 shadow-lg position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-user-tag fa-8x text-blue"></i>
                </div>
                <div class="position-absolute bottom-0 start-0 opacity-10">
                    <i class="fas fa-users-cog fa-8x text-blue"></i>
                </div>

                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-blue opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('users.index') }}" class="text-blue opacity-75">Utilisateurs</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('users.show', $user->id) }}" class="text-blue opacity-75">{{ $user->nom }} {{ $user->prenom }}</a>
                                </li>
                                <li class="breadcrumb-item active text-blue" aria-current="page">Assigner des rôles</li>
                            </ol>
                        </nav>

                        <h1 class="display-4 fw-bold text-blue mb-3">Assigner des rôles</h1>
                        <p class="text-blue opacity-90 lead mb-4">
                            Gérez les rôles de l'utilisateur <span class="fw-bold bg-white text-primary px-3 py-1 rounded-pill">{{ $user->nom }} {{ $user->prenom }}</span>
                        </p>

                        <div class="d-flex gap-3">
                            <div class="bg-white bg-opacity-20 rounded-3 px-4 py-2">
                                <small class="text-blue opacity-75 d-block">Rôles actuels</small>
                                <span class="text-blue fw-bold">{{ count($user->roles) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
                            <i class="fas fa-arrow-left me-2 text-primary"></i>Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques rapides -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 hover-shadow-lg transition-all">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-user fa-2x text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="fw-bold mb-0">{{ $user->nom }} {{ $user->prenom }}</h3>
                            <p class="text-muted mb-0">Utilisateur</p>
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
                                <i class="fas fa-check-circle fa-2x text-success"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="fw-bold mb-0" id="selected-count">0</h3>
                            <p class="text-muted mb-0">Rôles sélectionnés</p>
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
                                <i class="fas fa-tags fa-2x text-info"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="fw-bold mb-0">{{ count($roles) }}</h3>
                            <p class="text-muted mb-0">Rôles disponibles</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire d'assignation -->
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="card-header bg-white border-0 p-4">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-user-tag text-primary me-2"></i>
                        Assigner des rôles
                    </h4>
                    <p class="text-muted mb-0 mt-1">
                        Sélectionnez les rôles à assigner à l'utilisateur
                    </p>
                </div>
                <div class="col-auto">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-primary rounded-pill px-4" id="select-all-btn">
                            <i class="fas fa-check-double me-2"></i>Tout sélectionner
                        </button>
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" id="deselect-all-btn">
                            <i class="fas fa-times me-2"></i>Tout désélectionner
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('users.roles.store', $user->id) }}" method="POST">
                @csrf

                <!-- Barre de recherche -->
                <div class="mb-4">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-transparent border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0 ps-0" id="search-roles"
                               placeholder="Rechercher un rôle...">
                    </div>
                </div>

                <!-- Grille des rôles -->
                <div class="row g-3" id="roles-grid">
                    @forelse($roles as $role)
                        <div class="col-xl-3 col-lg-4 col-md-6 role-item"
                             data-name="{{ strtolower($role->nom) }}">
                            <div class="card border role-card h-100 {{ in_array($role->id, $userRoles) ? 'border-primary selected' : '' }}">
                                <div class="card-body p-3">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox"
                                                       class="custom-control-input role-checkbox"
                                                       name="roles[]"
                                                       value="{{ $role->id }}"
                                                       id="role_{{ $role->id }}"
                                                       {{ in_array($role->id, $userRoles) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="role_{{ $role->id }}"></label>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <label class="fw-semibold mb-1 cursor-pointer" for="role_{{ $role->id }}">
                                                {{ $role->nom }}
                                            </label>
                                            <div class="d-flex align-items-center">
                                                <small class="text-muted font-mono">
                                                    <i class="fas fa-fingerprint me-1"></i>
                                                    {{ substr($role->id, 0, 6) }}...{{ substr($role->id, -4) }}
                                                </small>
                                                @if(in_array($role->id, $userRoles))
                                                    <span class="badge bg-success bg-opacity-10 text-success ms-2">
                                                        <i class="fas fa-check-circle me-1"></i>Déjà assigné
                                                    </span>
                                                @endif
                                            </div>
                                            @if($role->description)
                                                <small class="text-muted d-block mt-2">{{ Str::limit($role->description, 50) }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center py-5">
                                <i class="fas fa-tags fa-4x text-muted mb-3"></i>
                                <h5 class="text-muted">Aucun rôle disponible</h5>
                                <p class="text-muted">Créez d'abord des rôles dans l'application</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Message d'alerte -->
                <div class="alert alert-warning mt-4 rounded-3" id="no-selection-alert" style="display: none;">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle fa-2x text-warning"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="alert-heading mb-1">Attention</h5>
                            <p class="mb-0">
                                Aucun rôle sélectionné. Aucune modification ne sera effectuée.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="d-flex justify-content-between align-items-center mt-4 pt-4 border-top">
                    <div>
                        <span class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            <span id="selection-info">0 rôle sélectionné</span>
                        </span>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill shadow-primary hover-lift">
                            <i class="fas fa-save me-2"></i>Assigner les rôles
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .text-blue {
        color: #ffffff !important;
    }

    .hover-lift {
        transition: transform 0.2s;
    }

    .hover-lift:hover {
        transform: translateY(-2px);
    }

    .shadow-primary {
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    .role-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .role-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border-color: #667eea;
    }

    .role-card.selected {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        border-color: #667eea;
        border-width: 2px;
    }

    .font-mono {
        font-family: 'SF Mono', Monaco, 'Cascadia Code', 'Roboto Mono', monospace;
        font-size: 0.8rem;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .opacity-10 {
        opacity: 0.1;
    }

    .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }

    .bg-opacity-20 {
        --bs-bg-opacity: 0.2;
    }
</style>
@endpush

@push('scripts')
<script>
    function updateSelectionStats() {
        const checkboxes = document.querySelectorAll('.role-checkbox:checked');
        const count = checkboxes.length;

        document.getElementById('selected-count').textContent = count;
        document.getElementById('selection-info').textContent =
            count + ' rôle' + (count > 1 ? 's' : '') + ' sélectionné' + (count > 1 ? 's' : '');

        const alert = document.getElementById('no-selection-alert');
        alert.style.display = count === 0 ? 'block' : 'none';

        document.querySelectorAll('.role-card').forEach(card => {
            const checkbox = card.querySelector('.role-checkbox');
            if (checkbox && checkbox.checked) {
                card.classList.add('selected', 'border-primary');
            } else {
                card.classList.remove('selected', 'border-primary');
            }
        });
    }

    document.getElementById('select-all-btn').addEventListener('click', function() {
        document.querySelectorAll('.role-checkbox').forEach(cb => {
            cb.checked = true;
        });
        updateSelectionStats();
    });

    document.getElementById('deselect-all-btn').addEventListener('click', function() {
        document.querySelectorAll('.role-checkbox').forEach(cb => {
            cb.checked = false;
        });
        updateSelectionStats();
    });

    document.getElementById('search-roles').addEventListener('input', function(e) {
        const search = e.target.value.toLowerCase();
        document.querySelectorAll('.role-item').forEach(item => {
            const name = item.dataset.name;
            if (name.includes(search)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });

    document.querySelectorAll('.role-card').forEach(card => {
        card.addEventListener('click', function(e) {
            if (e.target.type !== 'checkbox') {
                const checkbox = this.querySelector('.role-checkbox');
                if (checkbox) {
                    checkbox.checked = !checkbox.checked;
                    updateSelectionStats();
                }
            }
        });
    });

    document.querySelectorAll('.role-checkbox').forEach(cb => {
        cb.addEventListener('change', updateSelectionStats);
    });

    updateSelectionStats();
</script>
@endpush
@endsection
