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
                    <i class="fas fa-map-marker-alt fa-8x text-blue"></i>
                </div>

                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-blue opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('sites.index') }}" class="text-blue opacity-75">Sites</a>
                                </li>
                                <li class="breadcrumb-item active text-blue" aria-current="page">Modification</li>
                            </ol>
                        </nav>

                        <h1 class="display-4 fw-bold text-blue mb-3">Modification d'un site</h1>
                        <p class="text-blue opacity-90 lead mb-4">
                            Modifiez les informations de <span class="fw-bold bg-blue text-primary px-3 py-1 rounded-pill">{{ $site->nom }}</span>
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('sites.index') }}" class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
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
                        Modifier le site
                    </h4>
                    <p class="text-muted mb-0 mt-1">
                        Modifiez les informations ci-dessous pour mettre à jour le site
                    </p>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('sites.update', $site->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nom du site -->
                        <div class="mb-4">
                            <label for="nom" class="form-label fw-semibold">
                                <i class="fas fa-tag text-primary me-2"></i>Nom du site
                            </label>
                            <input type="text"
                                   name="nom"
                                   id="nom"
                                   class="form-control form-control-lg @error('nom') is-invalid @enderror"
                                   placeholder="Ex: Site de Ouagadougou, Site de Bobo, etc."
                                   value="{{ old('nom', $site->nom) }}"
                                   required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Localisation -->
                        <div class="mb-4">
                            <label for="localisation" class="form-label fw-semibold">
                                <i class="fas fa-map-pin text-primary me-2"></i>Localisation
                            </label>
                            <textarea name="localisation"
                                      id="localisation"
                                      rows="3"
                                      class="form-control form-control-lg @error('localisation') is-invalid @enderror"
                                      placeholder="Ex: 12°21'56.3"N 1°32'43.7"O, Rue 12.35, Ouagadougou"
                                      required>{{ old('localisation', $site->localisation) }}</textarea>
                            @error('localisation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Adresse complète ou coordonnées GPS du site</small>
                        </div>

                        <!-- ID Cours d'appui (optionnel) -->
                        <div class="mb-4">
                            <label for="idCoursDappuie" class="form-label fw-semibold">
                                <i class="fas fa-book-open text-primary me-2"></i>Cours d'appui associé (optionnel)
                            </label>
                            <input type="text"
                                   name="idCoursDappuie"
                                   id="idCoursDappuie"
                                   class="form-control form-control-lg @error('idCoursDappuie') is-invalid @enderror"
                                   placeholder="ID du cours d'appui"
                                   value="{{ old('idCoursDappuie', $site->idCoursDappuie) }}">
                            @error('idCoursDappuie')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Laissez vide si ce site n'est pas lié à un cours spécifique</small>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="d-flex justify-content-between align-items-center mt-4 pt-4 border-top">
                            <a href="{{ route('sites.index') }}" class="btn btn-outline-secondary btn-lg px-5 rounded-pill">
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
@endsection

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

    .shadow-primary {
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
</style>
@endpush
