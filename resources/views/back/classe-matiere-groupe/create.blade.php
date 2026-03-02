@extends('layouts.master')

@section('title')
    Créer une Association - ClassHub
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Créer une Association</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('classe-matiere-groupe.index') }}">Associations</a></li>
                        <li class="breadcrumb-item active">Créer</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-gradient border-bottom">
                    <h5 class="card-title mb-0 text-white">Nouvelle Association</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('classe-matiere-groupe.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="classe_id" class="form-label">Classe</label>
                            <select class="form-select" id="classe_id" name="classe_id" required>
                                <option value="">Sélectionner une classe</option>
                                @foreach($classes as $classe)
                                    <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="matiere_id" class="form-label">Matière</label>
                            <select class="form-select" id="matiere_id" name="matiere_id" required>
                                <option value="">Sélectionner une matière</option>
                                @foreach($matieres as $matiere)
                                    <option value="{{ $matiere->id }}">{{ $matiere->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="groupe_id" class="form-label">Groupe</label>
                            <select class="form-select" id="groupe_id" name="groupe_id" required>
                                <option value="">Sélectionner un groupe</option>
                                @foreach($groupes as $groupe)
                                    <option value="{{ $groupe->id }}">{{ $groupe->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('classe-matiere-groupe.index') }}" class="btn btn-light">
                                <i class="ri-arrow-left-line me-1"></i>Retour
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ri-save-line me-1"></i>Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
