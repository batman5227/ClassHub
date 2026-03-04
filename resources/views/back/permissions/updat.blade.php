@extends('layouts.master')
@section('content')
<div class="container-fluid px-4 py-5">
    <!-- En-tête avec gradient -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient-primary rounded-4 p-5 shadow-lg position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-edit fa-8x text-blue"></i>
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
                                <li class="breadcrumb-item active text-blue" aria-current="page">Modification</li>
                            </ol>
                        </nav>

                        <h1 class="display-4 fw-bold text-blue mb-3">Modification d'une permission</h1>
                        <p class="text-blue opacity-90 lead mb-4">
                            Modifiez les informations de la permission <span class="fw-bold bg-white text-primary px-3 py-1 rounded-pill">{{ $permission->nom }}</span>
                        </p>

                        <div class="d-flex gap-3">
                            <div class="bg-white bg-opacity-20 rounded-3 px-4 py-2">
                                <small class="text-blue opacity-75 d-block">ID de la permission</small>
                                <span class="text-blue fw-bold font-mono">{{ substr($permission->id, 0, 8) }}...</span>
                            </div>
                        </div>
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

    <!-- Formulaire de modification -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 p-4">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-edit text-primary me-2"></i>
                        Modifier la permission
                    </h4>
                    <p class="text-muted mb-0 mt-1">
                        Modifiez les informations ci-dessous pour mettre à jour la permission
                    </p>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nom" class="form-label fw-semibold">
                                <i class="fas fa-tag text-primary me-2"></i>Nom de la permission
                            </label>
                            <input type="text"
                                   name="nom"
                                   id="nom"
                                   class="form-control form-control-lg @error('nom') is-invalid @enderror"
                                   placeholder="Ex: créer_article, modifier_article, etc."
                                   value="{{ old('nom', $permission->nom) }}"
                                   required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                Utilisez des minuscules et des underscores (ex: gerer_utilisateurs)
                            </small>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">
                                <i class="fas fa-align-left text-primary me-2"></i>Description
                            </label>
                            <textarea name="description"
                                      id="description"
                                      class="form-control form-control-lg @error('description') is-invalid @enderror"
                                      rows="4"
                                      placeholder="Décrivez l'utilité de cette permission...">{{ old('description', $permission->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                Une description claire aidera à comprendre l'usage de cette permission
                            </small>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4 pt-4 border-top">
                            <a href="{{ route('permissions.index') }}" class="btn btn-outline-secondary btn-lg px-5 rounded-pill">
                                <i class="fas fa-times me-2"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill shadow-primary hover-lift">
                                <i class="fas fa-save me-2"></i>Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
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

    .opacity-10 {
        opacity: 0.1;
    }

    .opacity-75 {
        opacity: 0.75;
    }

    .opacity-90 {
        opacity: 0.9;
    }

    .bg-opacity-20 {
        --bs-bg-opacity: 0.2;
    }

    .font-mono {
        font-family: 'SF Mono', Monaco, 'Cascadia Code', 'Roboto Mono', monospace;
        font-size: 0.9rem;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
</style>
@endpush
@endsection
