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
                    <i class="fas fa-users fa-8x text-blue"></i>
                </div>

                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-blue opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('groupes.index') }}" class="text-blue opacity-75">Groupes</a>
                                </li>
                                <li class="breadcrumb-item active text-blue" aria-current="page">Création</li>
                            </ol>
                        </nav>

                        <h1 class="display-4 fw-bold text-blue mb-3">Création d'un groupe</h1>
                        <p class="text-blue opacity-90 lead mb-4">
                            Ajoutez un nouveau groupe à l'application
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('groupes.index') }}" class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
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
                        Nouveau groupe
                    </h4>
                    <p class="text-muted mb-0 mt-1">
                        Remplissez les informations ci-dessous pour créer un nouveau groupe
                    </p>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('groupes.store') }}" method="POST">
                        @csrf

                        <!-- Nom du groupe -->
                        <div class="mb-4">
                            <label for="nom" class="form-label fw-semibold">
                                <i class="fas fa-tag text-primary me-2"></i>Nom du groupe
                            </label>
                            <input type="text"
                                   name="nom"
                                   id="nom"
                                   class="form-control form-control-lg @error('nom') is-invalid @enderror"
                                   placeholder="Ex: Groupe A, Groupe 1, etc."
                                   value="{{ old('nom') }}"
                                   required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Classe associée -->
                        <div class="mb-4">
                            <label for="idClasse" class="form-label fw-semibold">
                                <i class="fas fa-chalkboard text-primary me-2"></i>Classe associée
                            </label>
                            <select name="idClasse"
                                    id="idClasse"
                                    class="form-select form-select-lg @error('idClasse') is-invalid @enderror"
                                    required>
                                <option value="">-- Sélectionner une classe --</option>
                                @foreach($classes as $classe)
                                    <option value="{{ $classe->id }}" {{ old('idClasse') == $classe->id ? 'selected' : '' }}>
                                        {{ $classe->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idClasse')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Sélectionnez la classe à laquelle appartient ce groupe</small>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="d-flex justify-content-between align-items-center mt-4 pt-4 border-top">
                            <a href="{{ route('groupes.index') }}" class="btn btn-outline-secondary btn-lg px-5 rounded-pill">
                                <i class="fas fa-times me-2"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill shadow-primary hover-lift">
                                <i class="fas fa-save me-2"></i>Créer le groupe
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
    .hover-lift { transition: transform 0.2s; }
    .hover-lift:hover { transform: translateY(-2px); }
    .shadow-primary { box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3); }
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    .required::after { content: " *"; color: #dc3545; }
</style>
@endpush
