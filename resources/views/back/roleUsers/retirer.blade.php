@extends('layouts.master')
@section('content')
<div class="container-fluid px-4 py-5">
    <!-- En-tête avec gradient rouge -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient-danger rounded-4 p-5 shadow-lg position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-user-minus fa-8x text-blue"></i>
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
                                <li class="breadcrumb-item active text-blue" aria-current="page">Retirer des rôles</li>
                            </ol>
                        </nav>

                        <h1 class="display-4 fw-bold text-blue mb-3">Retirer des rôles</h1>
                        <p class="text-blue opacity-90 lead mb-4">
                            Retirez des rôles à l'utilisateur <span class="fw-bold bg-white text-primary px-3 py-1 rounded-pill">{{ $user->nom }} {{ $user->prenom }}</span>
                        </p>
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

    @if($user->roles->isEmpty())
        <!-- État vide -->
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="fas fa-user-tag fa-5x text-muted"></i>
            </div>
            <h3 class="fw-bold mb-3">Aucun rôle à retirer</h3>
            <p class="text-muted mb-4">
                L'utilisateur <span class="fw-bold">{{ $user->nom }} {{ $user->prenom }}</span> n'a aucun rôle assigné.
            </p>
            <a href="{{ route('users.roles.assigner', $user->id) }}" class="btn btn-primary btn-lg rounded-pill px-5">
                <i class="fas fa-plus-circle me-2"></i>Assigner des rôles
            </a>
        </div>
    @else
        <!-- Formulaire de retrait -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-header bg-white border-0 p-4">
                <h4 class="mb-0 fw-bold">
                    <i class="fas fa-user-minus text-danger me-2"></i>
                    Retirer des rôles
                </h4>
                <p class="text-muted mb-0 mt-1">
                    Sélectionnez les rôles à retirer à l'utilisateur
                </p>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('users.roles.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <!-- Grille des rôles assignés -->
                    <div class="row g-3">
                        @foreach($user->roles as $role)
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="card border role-card h-100">
                                    <div class="card-body p-3">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                           class="custom-control-input role-checkbox-remove"
                                                           name="roles[]"
                                                           value="{{ $role->id }}"
                                                           id="role_{{ $role->id }}">
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
                                                </div>
                                                @if($role->description)
                                                    <small class="text-muted d-block mt-2">{{ Str::limit($role->description, 50) }}</small>
                                                @endif
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
                                <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
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
                                <span id="selection-info-remove">0 rôle sélectionné pour retrait</span>
                            </span>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-danger btn-lg px-5 rounded-pill shadow-danger hover-lift">
                                <i class="fas fa-trash-alt me-2"></i>Retirer les rôles sélectionnés
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

    .text-blue {
        color: #ffffff !important;
    }

    .role-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .role-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border-color: #f5576c;
    }

    .font-mono {
        font-family: 'SF Mono', Monaco, 'Cascadia Code', 'Roboto Mono', monospace;
        font-size: 0.8rem;
    }

    .cursor-pointer {
        cursor: pointer;
    }
</style>

<script>
    document.querySelectorAll('.role-checkbox-remove').forEach(cb => {
        cb.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.role-checkbox-remove:checked');
            const count = checkboxes.length;

            document.getElementById('selection-info-remove').textContent =
                count + ' rôle' + (count > 1 ? 's' : '') + ' sélectionné' + (count > 1 ? 's' : '') + ' pour retrait';

            const alert = document.getElementById('no-selection-alert-remove');
            alert.style.display = count === 0 ? 'block' : 'none';
        });
    });
</script>
@endsection
