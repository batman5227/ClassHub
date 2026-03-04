@extends('layouts.master')
@section('content')
<div class="container-fluid px-4 py-5">
    <!-- En-tête avec gradient -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient-primary rounded-4 p-5 shadow-lg position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-info-circle fa-8x text-blue"></i>
                </div>
                <div class="position-absolute bottom-0 start-0 opacity-10">
                    <i class="fas fa-key fa-8x text-blue"></i>
                </div>

                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-blue opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('permissions.index') }}" class="text-blue opacity-75">Permissions</a>
                                </li>
                                <li class="breadcrumb-item active text-blue" aria-current="page">Détails</li>
                            </ol>
                        </nav>

                        <h1 class="display-4 fw-bold text-blue mb-3">Détails de la permission</h1>
                        <p class="text-blue opacity-90 lead mb-4">
                            Informations complètes sur la permission <span class="fw-bold bg-white text-primary px-3 py-1 rounded-pill">{{ $permission->nom }}</span>
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('permissions.index') }}" class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
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
                                <i class="fas fa-key fa-2x text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="fw-bold mb-0">{{ $permission->nom }}</h3>
                            <p class="text-muted mb-0">Nom de la permission</p>
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
                                <i class="fas fa-users fa-2x text-success"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="fw-bold mb-0">{{ $permission->roles->count() }}</h3>
                            <p class="text-muted mb-0">Rôles associés</p>
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
                            <h3 class="fw-bold mb-0">{{ $permission->created_at->format('d/m/Y') }}</h3>
                            <p class="text-muted mb-0">Date de création</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Détails -->
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 p-4">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        Informations détaillées
                    </h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="text-muted text-uppercase small fw-semibold">ID de la permission</label>
                            <div class="bg-light rounded-3 p-3 mt-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-fingerprint text-primary me-3"></i>
                                    <code class="fw-semibold">{{ $permission->id }}</code>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="text-muted text-uppercase small fw-semibold">Date de modification</label>
                            <div class="bg-light rounded-3 p-3 mt-2">
                                <i class="far fa-clock text-primary me-2"></i>
                                {{ $permission->updated_at->format('d/m/Y à H:i') }}
                            </div>
                        </div>

                        <div class="col-12 mb-4">
                            <label class="text-muted text-uppercase small fw-semibold">Description</label>
                            <div class="bg-light rounded-3 p-3 mt-2">
                                <p class="mb-0">{{ $permission->description ?? 'Aucune description fournie' }}</p>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="text-muted text-uppercase small fw-semibold">Rôles utilisant cette permission</label>
                            <div class="bg-light rounded-3 p-3 mt-2">
                                @if($permission->roles->isEmpty())
                                    <p class="text-muted mb-0">Aucun rôle n'utilise cette permission</p>
                                @else
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($permission->roles as $role)
                                            <span class="badge bg-primary rounded-pill px-3 py-2">
                                                <i class="fas fa-user-tag me-1"></i>
                                                {{ $role->nom }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="d-flex justify-content-center gap-3 mt-5">
        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-warning btn-lg px-5 rounded-pill shadow-sm hover-lift">
            <i class="fas fa-edit me-2"></i>Modifier
        </a>
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
</style>
@endpush
@endsection
