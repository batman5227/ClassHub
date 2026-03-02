@extends('layouts.master')
@section('content')
<div class="container-fluid px-4 py-5">
    <!-- En-tête avec gradient -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient-primary rounded-4 p-5 shadow-lg position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-info-circle fa-8x text-white"></i>
                </div>
                <div class="position-absolute bottom-0 start-0 opacity-10">
                    <i class="fas fa-user-tag fa-8x text-blue"></i>
                </div>

                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-blue opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('roles.index') }}" class="text-blue opacity-75">Rôles</a>
                                </li>
                                <li class="breadcrumb-item active text-blue" aria-current="page">Détails</li>
                            </ol>
                        </nav>

                        <h1 class="display-4 fw-bold text-blue mb-3">Détails du rôle</h1>
                        <p class="text-blue opacity-90 lead mb-4">
                            Informations complètes sur le rôle <span class="fw-bold bg-white text-primary px-3 py-1 rounded-pill">{{ $role->nom }}</span>
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('roles.index') }}" class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
                            <i class="fas fa-arrow-left me-2"></i>Retour
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
                                <i class="fas fa-user-tag fa-2x text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="fw-bold mb-0">{{ $role->nom }}</h3>
                            <p class="text-muted mb-0">Nom du rôle</p>
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
                                <i class="fas fa-key fa-2x text-success"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="fw-bold mb-0">{{ $role->permissions->count() }}</h3>
                            <p class="text-muted mb-0">Permissions</p>
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
                                <i class="fas fa-calendar-alt fa-2x text-info"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="fw-bold mb-0">{{ $role->created_at->format('d/m/Y') }}</h3>
                            <p class="text-muted mb-0">Date de création</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Détails -->
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">
                <div class="card-header bg-white border-0 p-4">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        Informations générales
                    </h4>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="text-muted text-uppercase small fw-semibold">ID du rôle</label>
                        <div class="bg-light rounded-3 p-3 mt-2">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-fingerprint text-primary me-3"></i>
                                <code class="fw-semibold">{{ $role->id }}</code>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="text-muted text-uppercase small fw-semibold">Description</label>
                        <div class="bg-light rounded-3 p-3 mt-2">
                            <p class="mb-0">{{ $role->description ?? 'Aucune description fournie' }}</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="text-muted text-uppercase small fw-semibold">Date de modification</label>
                        <div class="bg-light rounded-3 p-3 mt-2">
                            <i class="far fa-clock text-primary me-2"></i>
                            {{ $role->updated_at->format('d/m/Y à H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold">
                            <i class="fas fa-shield-alt text-primary me-2"></i>
                            Permissions assignées
                        </h4>
                        <span class="badge bg-primary rounded-pill px-3 py-2">
                            {{ $role->permissions->count() }} permission(s)
                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    @if($role->permissions->isEmpty())
                        <div class="text-center py-4">
                            <i class="fas fa-shield-alt fa-4x text-muted mb-3"></i>
                            <p class="text-muted">Aucune permission assignée à ce rôle</p>
                            <a href="{{ route('roles.affecter', $role->id) }}" class="btn btn-primary rounded-pill px-4 mt-2">
                                <i class="fas fa-plus-circle me-2"></i>Assigner des permissions
                            </a>
                        </div>
                    @else
                        <div class="row g-2">
                            @foreach($role->permissions as $permission)
                                <div class="col-md-6">
                                    <div class="bg-light rounded-3 p-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            <div>
                                                <span class="fw-semibold">{{ $permission->nom }}</span>
                                                <small class="text-muted d-block">
                                                    <i class="fas fa-fingerprint me-1"></i>
                                                    {{ substr($permission->id, 0, 6) }}...
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="d-flex justify-content-center gap-3 mt-5">
        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-lg px-5 rounded-pill shadow-sm hover-lift">
            <i class="fas fa-edit me-2"></i>Modifier
        </a>
        <a href="{{ route('roles.affecter', $role->id) }}" class="btn btn-success btn-lg px-5 rounded-pill shadow-sm hover-lift">
            <i class="fas fa-plus-circle me-2"></i>Ajouter des permissions
        </a>
        <a href="{{ route('roles.retirer', $role->id) }}" class="btn btn-danger btn-lg px-5 rounded-pill shadow-sm hover-lift">
            <i class="fas fa-minus-circle me-2"></i>Retirer des permissions
        </a>
    </div>
</div>

@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
</style>
@endpush
@endsection
