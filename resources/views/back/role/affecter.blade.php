@extends('layouts.master')
@section('content')
<div class="container-fluid px-4 py-5">
    <!-- En-tête avec gradient -->

    <!-- Statistiques rapides -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 hover-shadow-lg transition-all">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-user-tag fa-2x text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="fw-bold mb-0">{{ $role->nom }}</h3>
                            <p class="text-muted mb-0">Rôle actuel</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
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
                            <p class="text-muted mb-0">Sélectionnées</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 hover-shadow-lg transition-all">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-clock fa-2x text-info"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="fw-bold mb-0">{{ count($permissions) - count($rolePermissions) }}</h3>
                            <p class="text-muted mb-0">Disponibles</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 hover-shadow-lg transition-all">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-history fa-2x text-warning"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="fw-bold mb-0">{{ count($rolePermissions) }}</h3>
                            <p class="text-muted mb-0">Déjà assignées</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Formulaire principal -->
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="card-header bg-white border-0 p-4">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-shield-alt text-primary me-2"></i>
                        Configuration des permissions
                    </h4>
                    <p class="text-muted mb-0 mt-1">
                        Cochez les permissions à assigner au rôle <span class="fw-bold text-primary">{{ $role->nom }}</span>
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
            <form action="{{ route('rolespermissions.store', $role->id) }}" method="POST" id="permissions-form">
                @csrf

                <!-- Barre de recherche -->
                <div class="mb-4">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-transparent border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0 ps-0" id="search-permissions"
                               placeholder="Rechercher une permission...">
                    </div>
                </div>

                <!-- Grille des permissions -->
                <div class="row g-3" id="permissions-grid">
                    @foreach($permissions->groupBy(function($perm) {
                        return substr($perm->nom, 0, 1);
                    }) as $letter => $groupedPermissions)
                        <div class="col-12">
                            <h5 class="text-muted mb-3 border-bottom pb-2">
                                <span class="bg-light px-3 py-1 rounded-pill">{{ $letter }}</span>
                            </h5>
                        </div>
                        @foreach($groupedPermissions as $permission)
                            <div class="col-xl-3 col-lg-4 col-md-6 permission-item"
                                 data-name="{{ strtolower($permission->nom) }}">
                                <div class="card border permission-card h-100 {{ in_array($permission->id, $rolePermissions) ? 'border-primary selected' : '' }}">
                                    <div class="card-body p-3">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                           class="custom-control-input permission-checkbox"
                                                           name="permissions[]"
                                                           value="{{ $permission->id }}"
                                                           id="perm_{{ $permission->id }}"
                                                           {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="perm_{{ $permission->id }}"></label>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <label class="fw-semibold mb-1 cursor-pointer" for="perm_{{ $permission->id }}">
                                                    {{ $permission->nom }}
                                                </label>
                                                <div class="d-flex align-items-center">
                                                    <small class="text-muted font-mono">
                                                        <i class="fas fa-fingerprint me-1"></i>
                                                        {{ substr($permission->id, 0, 6) }}...{{ substr($permission->id, -4) }}
                                                    </small>
                                                    @if(in_array($permission->id, $rolePermissions))
                                                        <span class="badge bg-success bg-opacity-10 text-success ms-2">
                                                            <i class="fas fa-check-circle me-1"></i>Assignée
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>

                <!-- Message d'alerte -->
                <div class="alert alert-warning mt-4 rounded-3" id="no-selection-alert" style="display: none;">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle fa-2x"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="alert-heading mb-1">Attention</h5>
                            <p class="mb-0">
                                Aucune permission sélectionnée. Si vous continuez,
                                <strong class="text-danger">toutes les permissions actuelles seront retirées</strong>
                                du rôle {{ $role->nom }}.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="d-flex justify-content-between align-items-center mt-4 pt-4 border-top">
                    <div>
                        <span class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            <span id="selection-info">0 permission sélectionnée</span>
                        </span>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="reset" class="btn btn-light btn-lg px-5 rounded-pill" onclick="resetSelection()">
                            <i class="fas fa-undo me-2"></i>Réinitialiser
                        </button>
                        <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill shadow-primary hover-lift">
                            <i class="fas fa-save me-2"></i>Enregistrer les modifications
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

    .permission-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .permission-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border-color: #667eea;
    }

    .permission-card.selected {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        border-color: #667eea;
        border-width: 2px;
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

    .opacity-75 {
        opacity: 0.75;
    }

    .bg-opacity-20 {
        --bs-bg-opacity: 0.2;
    }

    .hover-shadow-lg:hover {
        box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
    }

    .transition-all {
        transition: all 0.3s ease;
    }
</style>
@endpush

@push('scripts')
<script>
    // Gestion des compteurs
    function updateSelectionStats() {
        const checkboxes = document.querySelectorAll('.permission-checkbox:checked');
        const count = checkboxes.length;

        document.getElementById('selected-count').textContent = count;
        document.getElementById('selection-info').textContent =
            count + ' permission' + (count > 1 ? 's' : '') + ' sélectionnée' + (count > 1 ? 's' : '');

        const alert = document.getElementById('no-selection-alert');
        alert.style.display = count === 0 ? 'block' : 'none';

        // Mise à jour du style des cartes
        document.querySelectorAll('.permission-card').forEach(card => {
            const checkbox = card.querySelector('.permission-checkbox');
            if (checkbox && checkbox.checked) {
                card.classList.add('selected', 'border-primary');
            } else {
                card.classList.remove('selected', 'border-primary');
            }
        });
    }

    // Sélection/Désélection tout
    document.getElementById('select-all-btn').addEventListener('click', function() {
        document.querySelectorAll('.permission-checkbox').forEach(cb => {
            cb.checked = true;
        });
        updateSelectionStats();
    });

    document.getElementById('deselect-all-btn').addEventListener('click', function() {
        document.querySelectorAll('.permission-checkbox').forEach(cb => {
            cb.checked = false;
        });
        updateSelectionStats();
    });

    // Recherche
    document.getElementById('search-permissions').addEventListener('input', function(e) {
        const search = e.target.value.toLowerCase();

        document.querySelectorAll('.permission-item').forEach(item => {
            const name = item.dataset.name;
            if (name.includes(search)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });

    // Clic sur la carte pour cocher/décocher
    document.querySelectorAll('.permission-card').forEach(card => {
        card.addEventListener('click', function(e) {
            // Éviter la double détection si on clique directement sur la checkbox
            if (e.target.type !== 'checkbox') {
                const checkbox = this.querySelector('.permission-checkbox');
                if (checkbox) {
                    checkbox.checked = !checkbox.checked;
                    updateSelectionStats();
                }
            }
        });
    });

    // Écouteurs sur les checkboxes
    document.querySelectorAll('.permission-checkbox').forEach(cb => {
        cb.addEventListener('change', updateSelectionStats);
    });

    // Réinitialisation
    window.resetSelection = function() {
        document.querySelectorAll('.permission-checkbox').forEach(cb => {
            cb.checked = {{ json_encode(in_array($permission->id, $rolePermissions)) }};
        });
        updateSelectionStats();
    };

    // Initialisation
    updateSelectionStats();
</script>
@endpush
@endsection
