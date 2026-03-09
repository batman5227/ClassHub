@extends('layouts.master')
@section('content')
<div class="container-fluid px-4 py-5">
    <!-- En-tête avec gradient -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient-primary rounded-4 p-5 shadow-lg position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-user-plus fa-8x text-white"></i>
                </div>
                <div class="position-absolute bottom-0 start-0 opacity-10">
                    <i class="fas fa-school fa-8x text-blue"></i>
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
                                <li class="breadcrumb-item active text-blue" aria-current="page">Affecter</li>
                            </ol>
                        </nav>

                        <h1 class="display-4 fw-bold text-blue mb-3">Affecter un utilisateur</h1>
                        <p class="text-blue opacity-90 lead mb-4">
                            Affectez <span class="fw-bold bg-white text-primary px-3 py-1 rounded-pill">{{ $user->nom }} {{ $user->prenom }}</span> à un site, cours d'appui et classe
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

    <div class="row">
        <!-- Formulaire d'affectation -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 p-4">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-plus-circle text-primary me-2"></i>
                        Nouvelle affectation
                    </h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('users-coursappuie-site-classes.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="userId" value="{{ $user->id }}">

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Site</label>
                            <select name="siteId" class="form-select form-select-lg @error('siteId') is-invalid @enderror" required>
                                <option value="">Sélectionnez un site</option>
                                @foreach($sites as $site)
                                    <option value="{{ $site->id }}" {{ old('siteId') == $site->id ? 'selected' : '' }}>
                                        {{ $site->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('siteId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Cours d'appui</label>
                            <select name="coursAppuieId" class="form-select form-select-lg @error('coursAppuieId') is-invalid @enderror" required>
                                <option value="">Sélectionnez un cours</option>
                                @foreach($coursAppuies as $cours)
                                    <option value="{{ $cours->id }}" {{ old('coursAppuieId') == $cours->id ? 'selected' : '' }}>
                                        {{ $cours->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('coursAppuieId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Classe</label>
                            <select name="classeId" class="form-select form-select-lg @error('classeId') is-invalid @enderror" required>
                                <option value="">Sélectionnez une classe</option>
                                @foreach($classes as $classe)
                                    <option value="{{ $classe->id }}" {{ old('classeId') == $classe->id ? 'selected' : '' }}>
                                        {{ $classe->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('classeId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill">
                            <i class="fas fa-save me-2"></i>Créer l'affectation
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Liste des affectations existantes -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 p-4">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-list text-primary me-2"></i>
                        Affectations existantes
                    </h4>
                </div>

                <div class="card-body p-0">
                    @if($affectations->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-empty-set fa-4x text-muted mb-3"></i>
                            <p class="text-muted">Aucune affectation pour cet utilisateur</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="px-4 py-3">Site</th>
                                        <th class="px-4 py-3">Cours</th>
                                        <th class="px-4 py-3">Classe</th>
                                        <th class="px-4 py-3 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($affectations as $affectation)
                                        <tr>
                                            <td class="px-4 py-3">{{ $affectation->site->nom }}</td>
                                            <td class="px-4 py-3">{{ $affectation->coursAppuie->nom }}</td>
                                            <td class="px-4 py-3">{{ $affectation->classe->nom }}</td>
                                            <td class="px-4 py-3 text-center">
                                                <form action="{{ route('users-coursappuie-site-classes.destroy', $affectation->id) }}"
                                                      method="POST"
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                            onclick="return confirm('Retirer cette affectation ?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
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
</style>
@endpush
