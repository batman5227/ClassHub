@extends('layouts.master')
@section('content')
<div class="container-fluid px-4 py-5">
    <!-- En-tête avec gradient rouge -->
    @if($role->permissions->isEmpty())
        <!-- État vide stylisé -->
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="fas fa-shield-alt fa-5x text-muted"></i>
            </div>
            <h3 class="fw-bold mb-3">Aucune permission à retirer</h3>
            <p class="text-muted mb-4">
                Le rôle <span class="fw-bold">{{ $role->nom }}</span> n'a aucune permission assignée.
            </p>
            <a href="{{ route('rolespermissions.create', $role->id) }}" class="btn btn-primary btn-lg rounded-pill px-5">
                <i class="fas fa-plus-circle me-2"></i>Ajouter des permissions
            </a>
        </div>
    @else
        <!-- Formulaire de retrait -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-header bg-white border-0 p-4">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="mb-0 fw-bold">
                            <i class="fas fa-trash-alt text-danger me-2"></i>
                            Retrait de permissions
                        </h4>
                        <p class="text-muted mb-0 mt-1">
                            Sélectionnez les permissions à retirer du rôle <span class="fw-bold text-danger">{{ $role->nom }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('rolespermissions.destroy', $role->id) }}" method="POST" id="remove-permissions-form">
                    @csrf
                    @method('DELETE')

                    <!-- Grille des permissions assignées -->
                    <div class="row g-3">
                        @foreach($role->permissions as $permission)
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="card border permission-card h-100">
                                    <div class="card-body p-3">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                           class="custom-control-input permission-checkbox-remove"
                                                           name="permissions[]"
                                                           value="{{ $permission->id }}"
                                                           id="remove_perm_{{ $permission->id }}">
                                                    <label class="custom-control-label" for="remove_perm_{{ $permission->id }}"></label>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <label class="fw-semibold mb-1 cursor-pointer" for="remove_perm_{{ $permission->id }}">
                                                    {{ $permission->nom }}
                                                </label>
                                                <div class="d-flex align-items-center">
                                                    <small class="text-muted font-mono">
                                                        <i class="fas fa-fingerprint me-1"></i>
                                                        {{ substr($permission->id, 0, 6) }}...{{ substr($permission->id, -4) }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Message d'alerte -->
                    <div class="alert alert-danger mt-4 rounded-3" id="no-selection-alert-remove" style="display: none;">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle fa-2x"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="alert-heading mb-1">Attention</h5>
                                <p class="mb-0">
                                    Aucune permission sélectionnée. Aucune modification ne sera effectuée.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="d-flex justify-content-between align-items-center mt-4 pt-4 border-top">
                        <div>
                            <span class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                <span id="selection-info-remove">0 permission sélectionnée pour retrait</span>
                            </span>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="reset" class="btn btn-light btn-lg px-5 rounded-pill">
                                <i class="fas fa-undo me-2"></i>Réinitialiser
                            </button>
                            <button type="submit" class="btn btn-danger btn-lg px-5 rounded-pill shadow-danger hover-lift">
                                <i class="fas fa-trash-alt me-2"></i>Retirer les permissions sélectionnées
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>

<style>
    .bg-gradient-danger {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .shadow-danger {
        box-shadow: 0 10px 30px rgba(245, 87, 108, 0.3);
    }
</style>

<script>
    // Script similaire pour la gestion des sélections
    document.querySelectorAll('.permission-checkbox-remove').forEach(cb => {
        cb.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.permission-checkbox-remove:checked');
            const count = checkboxes.length;

            document.getElementById('selection-info-remove').textContent =
                count + ' permission' + (count > 1 ? 's' : '') + ' sélectionnée' + (count > 1 ? 's' : '') + ' pour retrait';

            const alert = document.getElementById('no-selection-alert-remove');
            alert.style.display = count === 0 ? 'block' : 'none';
        });
    });
</script>
@endsection
