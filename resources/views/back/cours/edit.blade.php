@extends('layouts.master')

@section('title')
    Modifier un Cours - ClassHub
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Modifier un Cours</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cours.index') }}">Cours</a></li>
                        <li class="breadcrumb-item active">Modifier</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-gradient border-bottom">
                    <h5 class="card-title text-white">Modifier le Cours</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('cours.update', $cours->id) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom du cours</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ $cours->nom }}" required>
                            <div class="invalid-feedback">Veuillez entrer un nom.</div>
                        </div>
                        <div class="mb-3">
                            <label for="idMatiere" class="form-label">Matière</label>
                            <select class="form-select" id="idMatiere" name="idMatiere" required>
                                <option value="">Sélectionner une matière</option>
                                @foreach($matieres as $matiere)
                                    <option value="{{ $matiere->id }}" {{ $cours->idMatiere == $matiere->id ? 'selected' : '' }}>
                                        {{ $matiere->nom }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Veuillez sélectionner une matière.</div>
                        </div>
                        <div class="mt-4 pt-3 border-top d-flex justify-content-between">
                            <a href="{{ route('cours.index') }}" class="btn btn-light"><i class="ri-arrow-left-line me-1"></i>Retour</a>
                            <button type="submit" class="btn btn-success"><i class="ri-save-line me-1"></i>Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
