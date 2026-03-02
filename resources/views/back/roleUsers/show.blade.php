@extends('layouts.master')
@section('content')
<div class="container-fluid px-4 py-5">
    <!-- En-tête avec gradient -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient-primary rounded-4 p-5 shadow-lg position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-user-circle fa-8x text-blue"></i>
                </div>
                <div class="position-absolute bottom-0 start-0 opacity-10">
                    <i class="fas fa-id-card fa-8x text-blue"></i>
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
                                <li class="breadcrumb-item active text-blue" aria-current="page">Détails</li>
                            </ol>
                        </nav>

                        <h1 class="display-4 fw-bold text-blue mb-3">Profil utilisateur</h1>
                        <p class="text-blue opacity-90 lead mb-4">
                            Informations complètes de <span class="fw-bold bg-white text-primary px-3 py-1 rounded-pill">{{ $user->nom }} {{ $user->prenom }}</span>
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('users.index') }}" class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
                            <i class="fas fa-arrow-left me-2 text-primary"></i>Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cartes de statistiques rapides -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 hover-shadow-lg transition-all">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-user-circle fa-2x text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="fw-bold mb-0">{{ $user->nom }} {{ $user->prenom }}</h3>
                            <p class="text-muted mb-0">Nom complet</p>
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
                                <i class="fas fa-envelope fa-2x text-success"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="fw-bold mb-0 text-truncate">{{ $user->email }}</h3>
                            <p class="text-muted mb-0">Email</p>
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
                                <i class="fas fa-phone fa-2x text-info"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="fw-bold mb-0">{{ $user->telephone }}</h3>
                            <p class="text-muted mb-0">Téléphone</p>
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
                                <i class="fas fa-calendar-alt fa-2x text-warning"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="fw-bold mb-0">{{ $user->created_at->format('d/m/Y') }}</h3>
                            <p class="text-muted mb-0">Membre depuis</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Détails complets de l'utilisateur -->
    <div class="row g-4">
        <!-- Colonne gauche - Identité et Contact -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">
                <div class="card-header bg-white border-0 p-4">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-id-card text-primary me-2"></i>
                        Identité & Contact
                    </h4>
                </div>
                <div class="card-body p-4">
                    <!-- Identité -->
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">
                            <i class="fas fa-user me-2"></i>Identité
                        </h6>
                        <div class="bg-light rounded-3 p-3">
                            <div class="row">
                                <div class="col-6">
                                    <small class="text-muted d-block">Nom</small>
                                    <span class="fw-semibold">{{ $user->nom }}</span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Prénom</small>
                                    <span class="fw-semibold">{{ $user->prenom }}</span>
                                </div>
                            </div>
                            <div class="mt-2">
                                <small class="text-muted d-block">ID Utilisateur</small>
                                <code class="text-primary">{{ $user->id }}</code>
                            </div>
                        </div>
                    </div>

                    <!-- Contact -->
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">
                            <i class="fas fa-address-card me-2"></i>Contact
                        </h6>
                        <div class="bg-light rounded-3 p-3">
                            <div class="mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-envelope text-primary me-3" style="width: 20px;"></i>
                                    <div>
                                        <span>{{ $user->email }}</span>
                                        @if($user->email_verified_at)
                                            <span class="badge bg-success bg-opacity-10 text-success ms-2">
                                                <i class="fas fa-check-circle me-1"></i>Vérifié
                                            </span>
                                        @else
                                            <span class="badge bg-warning bg-opacity-10 text-warning ms-2">
                                                <i class="fas fa-clock me-1"></i>Non vérifié
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-phone-alt text-primary me-3" style="width: 20px;"></i>
                                    <span>{{ $user->telephone }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statut -->
                    <div>
                        <h6 class="text-primary mb-3">
                            <i class="fas fa-toggle-on me-2"></i>Statut du compte
                        </h6>
                        <div class="bg-light rounded-3 p-3">
                            @if($user->status === 'actif')
                                <div class="d-flex align-items-center text-success">
                                    <i class="fas fa-check-circle fa-2x me-3"></i>
                                    <div>
                                        <span class="fw-bold d-block">Compte actif</span>
                                        <small>L'utilisateur peut se connecter à l'application</small>
                                    </div>
                                </div>
                            @else
                                <div class="d-flex align-items-center text-danger">
                                    <i class="fas fa-times-circle fa-2x me-3"></i>
                                    <div>
                                        <span class="fw-bold d-block">Compte inactif</span>
                                        <small>L'utilisateur ne peut pas se connecter</small>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Colonne droite - Rôles et Activité -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold">
                            <i class="fas fa-shield-alt text-primary me-2"></i>
                            Rôles & Activité
                        </h4>
                        <div>
                            <a href="{{ route('users.roles.assigner', $user->id) }}"
                               class="btn btn-sm btn-outline-success rounded-pill px-3"
                               data-bs-toggle="tooltip" title="Assigner des rôles">
                                <i class="fas fa-plus-circle me-1"></i>Assigner
                            </a>
                            <a href="{{ route('users.roles.retirer', $user->id) }}"
                               class="btn btn-sm btn-outline-danger rounded-pill px-3"
                               data-bs-toggle="tooltip" title="Retirer des rôles">
                                <i class="fas fa-minus-circle me-1"></i>Retirer
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <!-- Rôles assignés -->
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">
                            <i class="fas fa-tags me-2"></i>Rôles assignés
                            <span class="badge bg-primary ms-2">{{ $user->roles->count() }}</span>
                        </h6>

                        @if($user->roles->isEmpty())
                            <div class="text-center py-4 bg-light rounded-3">
                                <i class="fas fa-user-tag fa-3x text-muted mb-2"></i>
                                <p class="text-muted mb-2">Aucun rôle assigné</p>
                                <a href="{{ route('users.roles.assigner', $user->id) }}" class="btn btn-primary btn-sm rounded-pill">
                                    <i class="fas fa-plus-circle me-1"></i>Assigner un rôle
                                </a>
                            </div>
                        @else
                            <div class="row g-2">
                                @foreach($user->roles as $role)
                                    <div class="col-md-6">
                                        <div class="bg-light rounded-3 p-3">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-check-circle text-success me-2"></i>
                                                <div>
                                                    <span class="fw-semibold">{{ $role->nom }}</span>
                                                    @if($role->description)
                                                        <small class="text-muted d-block">{{ Str::limit($role->description, 40) }}</small>
                                                    @endif
                                                    <small class="text-muted d-block">
                                                        <i class="fas fa-fingerprint me-1"></i>
                                                        {{ substr($role->id, 0, 6) }}...
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Activité du compte -->
                    <div>
                        <h6 class="text-primary mb-3">
                            <i class="fas fa-history me-2"></i>Activité du compte
                        </h6>
                        <div class="bg-light rounded-3 p-3">
                            <div class="row">
                                <div class="col-6">
                                    <small class="text-muted d-block">Date de création</small>
                                    <span class="fw-semibold">{{ $user->created_at->format('d/m/Y H:i') }}</span>
                                    <small class="text-muted d-block">{{ $user->created_at->diffForHumans() }}</small>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Dernière modification</small>
                                    <span class="fw-semibold">{{ $user->updated_at->format('d/m/Y H:i') }}</span>
                                    <small class="text-muted d-block">{{ $user->updated_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="d-flex justify-content-center gap-3 mt-5">
        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-lg px-5 rounded-pill shadow-sm hover-lift">
            <i class="fas fa-edit me-2"></i>Modifier
        </a>

        <a href="{{ route('users.roles.assigner', $user->id) }}" class="btn btn-success btn-lg px-5 rounded-pill shadow-sm hover-lift">
            <i class="fas fa-plus-circle me-2"></i>Assigner des rôles
        </a>

        <a href="{{ route('users.roles.retirer', $user->id) }}" class="btn btn-danger btn-lg px-5 rounded-pill shadow-sm hover-lift">
            <i class="fas fa-minus-circle me-2"></i>Retirer des rôles
        </a>

        @if($user->status === 'actif')
        <button type="button"
                class="btn btn-outline-warning btn-lg px-5 rounded-pill shadow-sm hover-lift btn-deactivate"
                data-id="{{ $user->id }}"
                data-name="{{ $user->nom }} {{ $user->prenom }}">
            <i class="fas fa-ban me-2"></i>Désactiver
        </button>
        @else
        <button type="button"
                class="btn btn-outline-success btn-lg px-5 rounded-pill shadow-sm hover-lift btn-activate"
                data-id="{{ $user->id }}"
                data-name="{{ $user->nom }} {{ $user->prenom }}">
            <i class="fas fa-check-circle me-2"></i>Activer
        </button>
        @endif

        <button type="button"
                class="btn btn-outline-danger btn-lg px-5 rounded-pill shadow-sm hover-lift btn-delete"
                data-id="{{ $user->id }}"
                data-name="{{ $user->nom }} {{ $user->prenom }}">
            <i class="fas fa-trash me-2"></i>Supprimer
        </button>
    </div>

    <!-- Formulaires cachés -->
    <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <form id="activate-form-{{ $user->id }}" action="{{ route('users.activate', $user->id) }}" method="POST" style="display: none;">
        @csrf
        @method('PUT')
    </form>

    <form id="deactivate-form-{{ $user->id }}" action="{{ route('users.deactivate', $user->id) }}" method="POST" style="display: none;">
        @csrf
        @method('PUT')
    </form>
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

    .hover-shadow-lg:hover {
        box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
    }

    .transition-all {
        transition: all 0.3s ease;
    }

    .opacity-10 {
        opacity: 0.1;
    }

    .opacity-75 {
        opacity: 0.75;
    }

    .opacity-90 {
        opacity: 0.9;
    }

    .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }

    .bg-opacity-20 {
        --bs-bg-opacity: 0.2;
    }

    code {
        background: none;
        color: #667eea;
        font-size: 0.9rem;
    }

    .text-truncate {
        max-width: 200px;
    }

    .btn-outline-success, .btn-outline-warning, .btn-outline-danger {
        border-width: 2px;
    }

    .btn-outline-success:hover, .btn-outline-warning:hover, .btn-outline-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Suppression
        document.querySelector('.btn-delete')?.addEventListener('click', function(e) {
            e.preventDefault();

            const userId = this.dataset.id;
            const userName = this.dataset.name;

            Swal.fire({
                title: 'Confirmation',
                html: `
                    <div class="text-center">
                        <i class="fas fa-exclamation-triangle text-warning fa-4x mb-3"></i>
                        <h5>Supprimer l'utilisateur "${userName}" ?</h5>
                        <p class="text-muted">Cette action est irréversible.</p>
                        <p class="text-danger fw-bold">Toutes les données associées seront perdues.</p>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler',
                background: 'white',
                customClass: {
                    popup: 'rounded-4 shadow-lg'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${userId}`).submit();
                }
            });
        });

        // Activation
        document.querySelector('.btn-activate')?.addEventListener('click', function(e) {
            e.preventDefault();

            const userId = this.dataset.id;
            const userName = this.dataset.name;

            Swal.fire({
                title: 'Confirmation',
                html: `
                    <div class="text-center">
                        <i class="fas fa-check-circle text-success fa-4x mb-3"></i>
                        <h5>Activer l'utilisateur "${userName}" ?</h5>
                        <p class="text-muted">L'utilisateur pourra se connecter à l'application.</p>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, activer',
                cancelButtonText: 'Annuler',
                background: 'white',
                customClass: {
                    popup: 'rounded-4 shadow-lg'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`activate-form-${userId}`).submit();
                }
            });
        });

        // Désactivation
        document.querySelector('.btn-deactivate')?.addEventListener('click', function(e) {
            e.preventDefault();

            const userId = this.dataset.id;
            const userName = this.dataset.name;

            Swal.fire({
                title: 'Confirmation',
                html: `
                    <div class="text-center">
                        <i class="fas fa-ban text-warning fa-4x mb-3"></i>
                        <h5>Désactiver l'utilisateur "${userName}" ?</h5>
                        <p class="text-muted">L'utilisateur ne pourra plus se connecter.</p>
                        <p class="text-info">Cette action est réversible.</p>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ffc107',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, désactiver',
                cancelButtonText: 'Annuler',
                background: 'white',
                customClass: {
                    popup: 'rounded-4 shadow-lg'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`deactivate-form-${userId}`).submit();
                }
            });
        });
    });
</script>
@endpush
@endsection
