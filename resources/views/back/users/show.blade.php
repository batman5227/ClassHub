@extends('layouts.master')
<<<<<<< HEAD

@section('title')
    Détails de l'Utilisateur - ClassHub
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Détails de l'Utilisateur</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Utilisateurs</a></li>
                        <li class="breadcrumb-item active">Détails</li>
                    </ol>
=======
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

                        <h1 class="display-4 fw-bold text-blue mb-3">Détails de l'utilisateur</h1>
                        <p class="text-blue opacity-90 lead mb-4">
                            Informations complètes sur <span class="fw-bold bg-white text-primary px-3 py-1 rounded-pill">{{ $user->nom }} {{ $user->prenom }}</span>
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('users.index') }}" class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
                            <i class="fas fa-arrow-left me-2 text-primary"></i>Retour
                        </a>
                    </div>
>>>>>>> 648231892ef47f692adac586301ec21d732a5abc
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-gradient border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="avatar me-3" style="width:50px;height:50px;font-size:18px">{{ substr($user->name, 0, 2) }}</div>
                        <div><h5 class="card-title mb-0 text-white">{{ $user->name }}</h5><span class="text-white-50">Utilisateur</span></div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr><td class="text-muted w-50"><strong>Nom:</strong></td><td class="fw-semibold">{{ $user->name }}</td></tr>
                        <tr><td class="text-muted"><strong>Email:</strong></td><td>{{ $user->email }}</td></tr>
                        <tr><td class="text-muted"><strong>Statut:</strong></td>
                            <td>
                                @if($user->status === 'actif')
                                    <span class="badge bg-success">Actif</span>
                                @else
                                    <span class="badge bg-danger">Inactif</span>
                                @endif
                            </td>
                        </tr>
                        <tr><td class="text-muted"><strong>Créé le:</strong></td><td>{{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : 'N/A' }}</td></tr>
                    </table>
                    <div class="mt-4 pt-3 border-top d-flex justify-content-between">
                        <a href="{{ route('users.index') }}" class="btn btn-light"><i class="ri-arrow-left-line me-1"></i>Retour</a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success"><i class="ri-edit-line me-1"></i>Modifier</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
=======
    <!-- Dans la section Identité, remplace l'icône par la photo -->
<div class="d-flex align-items-center">
    @if($user->photo)
        <img src="{{ asset('storage/' . $user->photo) }}"
             alt="{{ $user->nom }}"
             class="rounded-circle me-3"
             style="width: 60px; height: 60px; object-fit: cover;">
    @else
        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3"
             style="width: 60px; height: 60px;">
            <i class="fas fa-user-circle fa-3x text-primary"></i>
        </div>
    @endif
    <div>
        <h3 class="fw-bold mb-0">{{ $user->nom }} {{ $user->prenom }}</h3>
        <p class="text-muted mb-0">ID: {{ substr($user->id, 0, 6) }}...</p>
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
        <div class="col-lg-12">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold">
                            <i class="fas fa-info-circle text-primary me-2"></i>
                            Informations détaillées
                        </h4>
                        <span class="badge {{ $user->status === 'actif' ? 'bg-success' : 'bg-danger' }} rounded-pill px-4 py-2 fs-6">
                            <i class="fas {{ $user->status === 'actif' ? 'fa-check-circle' : 'fa-times-circle' }} me-2"></i>
                            {{ ucfirst($user->status) }}
                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <!-- Identité -->
                        <div class="col-md-6 mb-4">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <h5 class="text-primary mb-3">
                                    <i class="fas fa-id-card me-2"></i>Identité
                                </h5>

                                <div class="mb-3">
                                    <label class="text-muted small text-uppercase">Nom complet</label>
                                    <div class="d-flex align-items-center mt-1">
                                        <div class="bg-primary bg-opacity-10 rounded-2 p-2 me-3">
                                            <i class="fas fa-user text-primary"></i>
                                        </div>
                                        <div>
                                            <p class="fw-semibold mb-0">{{ $user->nom }} {{ $user->prenom }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="text-muted small text-uppercase">ID Utilisateur</label>
                                    <div class="d-flex align-items-center mt-1">
                                        <div class="bg-info bg-opacity-10 rounded-2 p-2 me-3">
                                            <i class="fas fa-fingerprint text-info"></i>
                                        </div>
                                        <div>
                                            <code class="fw-semibold">{{ $user->id }}</code>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="text-muted small text-uppercase">Statut du compte</label>
                                    <div class="mt-2">
                                        @if($user->status === 'actif')
                                            <span class="badge bg-success rounded-pill px-4 py-2">
                                                <i class="fas fa-check-circle me-1"></i>Actif
                                            </span>
                                        @else
                                            <span class="badge bg-danger rounded-pill px-4 py-2">
                                                <i class="fas fa-times-circle me-1"></i>Inactif
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact -->
                        <div class="col-md-6 mb-4">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <h5 class="text-primary mb-3">
                                    <i class="fas fa-address-card me-2"></i>Contact
                                </h5>

                                <div class="mb-3">
                                    <label class="text-muted small text-uppercase">Adresse email</label>
                                    <div class="d-flex align-items-center mt-1">
                                        <div class="bg-success bg-opacity-10 rounded-2 p-2 me-3">
                                            <i class="fas fa-envelope text-success"></i>
                                        </div>
                                        <div>
                                            <p class="fw-semibold mb-0">{{ $user->email }}</p>
                                            <small class="text-muted">Principal</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="text-muted small text-uppercase">Téléphone</label>
                                    <div class="d-flex align-items-center mt-1">
                                        <div class="bg-warning bg-opacity-10 rounded-2 p-2 me-3">
                                            <i class="fas fa-phone-alt text-warning"></i>
                                        </div>
                                        <div>
                                            <p class="fw-semibold mb-0">{{ $user->telephone }}</p>
                                            <small class="text-muted">Principal</small>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="text-muted small text-uppercase">Email vérifié</label>
                                    <div class="mt-2">
                                        @if($user->email_verified_at)
                                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">
                                                <i class="fas fa-check-circle me-1"></i>
                                                Vérifié le {{ $user->email_verified_at->format('d/m/Y à H:i') }}
                                            </span>
                                        @else
                                            <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-2">
                                                <i class="fas fa-exclamation-triangle me-1"></i>
                                                Non vérifié
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dates et activités -->
                        <div class="col-md-12">
                            <div class="bg-light rounded-4 p-4">
                                <h5 class="text-primary mb-3">
                                    <i class="fas fa-clock me-2"></i>Activité du compte
                                </h5>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="bg-primary bg-opacity-10 rounded-2 p-3 me-3">
                                                    <i class="fas fa-calendar-plus text-primary fa-lg"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Date de création</small>
                                                <span class="fw-semibold">{{ $user->created_at->format('d/m/Y à H:i') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="bg-info bg-opacity-10 rounded-2 p-3 me-3">
                                                    <i class="fas fa-calendar-check text-info fa-lg"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Dernière modification</small>
                                                <span class="fw-semibold">{{ $user->updated_at->format('d/m/Y à H:i') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="bg-warning bg-opacity-10 rounded-2 p-3 me-3">
                                                    <i class="fas fa-history text-warning fa-lg"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Membre depuis</small>
                                                <span class="fw-semibold">{{ $user->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
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

        @if($user->status === 'actif')
        <button type="button"
                class="btn btn-danger btn-lg px-5 rounded-pill shadow-sm hover-lift btn-deactivate"
                data-id="{{ $user->id }}"
                data-name="{{ $user->nom }} {{ $user->prenom }}">
            <i class="fas fa-ban me-2"></i>Désactiver
        </button>
        @else
        <button type="button"
                class="btn btn-success btn-lg px-5 rounded-pill shadow-sm hover-lift btn-activate"
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

    <!-- Formulaires cachés pour les actions -->
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
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
                        <p class="text-muted">L'utilisateur ne pourra plus se connecter à l'application.</p>
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
>>>>>>> 648231892ef47f692adac586301ec21d732a5abc
@endsection
