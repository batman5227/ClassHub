@extends('layouts.master')
@section('content')
<div class="container-fluid px-4 py-5">
    <!-- En-tête avec gradient -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient-primary rounded-4 p-5 shadow-lg position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-plus-circle fa-8x text-blue"></i>
                </div>
                <div class="position-absolute bottom-0 start-0 opacity-10">
                    <i class="fas fa-chalkboard-teacher fa-8x text-blue"></i>
                </div>

                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-blue opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('classes.index') }}" class="text-blue opacity-75">Classes</a>
                                </li>
                                <li class="breadcrumb-item active text-blue" aria-current="page">Création</li>
                            </ol>
                        </nav>

                        <h1 class="display-4 fw-bold text-blue mb-3">Création d'une classe</h1>
                        <p class="text-blue opacity-90 lead mb-4">
                            Ajoutez une nouvelle classe à l'application
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('classes.index') }}" class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
                            <i class="fas fa-arrow-left me-2 text-primary"></i>Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire de création -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 p-4">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-plus-circle text-primary me-2"></i>
                        Nouvelle classe
                    </h4>
                    <p class="text-muted mb-0 mt-1">
                        Remplissez les informations ci-dessous pour créer une nouvelle classe
                    </p>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('classes.store') }}" method="POST">
                        @csrf

                        <!-- Année scolaire -->
                        <div class="mb-4">
                            <label for="idAnneeScolaire" class="form-label fw-semibold">
                                <i class="fas fa-calendar-alt text-primary me-2"></i>Année scolaire
                            </label>
                            <select name="idAnneeScolaire"
                                    id="idAnneeScolaire"
                                    class="form-select form-select-lg @error('idAnneeScolaire') is-invalid @enderror"
                                    required>
                                <option value="">-- Sélectionner une année scolaire --</option>
                                @foreach($anneesScolaires as $annee)
                                    <option value="{{ $annee->id }}"
                                        {{ old('idAnneeScolaire', $anneeActive?->id) == $annee->id ? 'selected' : '' }}
                                        {{ $annee->is_active ? 'data-active="true"' : '' }}>
                                        {{ $annee->annee }} {{ $annee->is_active ? '(Active)' : '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idAnneeScolaire')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">L'année scolaire à laquelle cette classe appartient</small>
                        </div>

                        <!-- Nom de la classe -->
                        <div class="mb-4">
                            <label for="nom" class="form-label fw-semibold">
                                <i class="fas fa-tag text-primary me-2"></i>Nom de la classe
                            </label>
                            <input type="text"
                                   name="nom"
                                   id="nom"
                                   class="form-control form-control-lg @error('nom') is-invalid @enderror"
                                   placeholder="Ex: 6ème, 5ème, Terminale D, etc."
                                   value="{{ old('nom') }}"
                                   required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Site associé -->
                        <div class="mb-4">
                            <label for="idSites" class="form-label fw-semibold">
                                <i class="fas fa-map-marker-alt text-primary me-2"></i>Site associé
                            </label>
                            <select name="idSites"
                                    id="idSites"
                                    class="form-select form-select-lg @error('idSites') is-invalid @enderror">
                                <option value="">-- Sélectionner un site --</option>
                                @foreach($sites as $site)
                                    <option value="{{ $site->id }}" {{ old('idSites') == $site->id ? 'selected' : '' }}>
                                        {{ $site->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idSites')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Sélectionnez le site où se trouve cette classe (optionnel)</small>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="d-flex justify-content-between align-items-center mt-4 pt-4 border-top">
                            <a href="{{ route('classes.index') }}" class="btn btn-outline-secondary btn-lg px-5 rounded-pill">
                                <i class="fas fa-times me-2"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill shadow-primary hover-lift">
                                <i class="fas fa-save me-2"></i>Créer la classe
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
