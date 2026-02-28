@extends('layouts.master')

@section('title')
    Modifier un Document - ClassHub
@endsection

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Modifier un Document</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('documents.index') }}">Documents</a></li>
                        <li class="breadcrumb-item active">Modifier</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('documents.update', $documents->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom du document</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ $documents->nom }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="idMatiere" class="form-label">Matière parente (optionnel)</label>
                            <select class="form-select" id="idMatiere" name="idMatiere">
                                <option value="">Sélectionner une matière</option>
                                @foreach(\App\Models\Documents::whereNull('idMatiere')->get() as $doc)
                                <option value="{{ $doc->id }}" {{ $documents->idMatiere == $doc->id ? 'selected' : '' }}>{{ $doc->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fichier" class="form-label">Fichier</label>
                            <input type="file" class="form-control" id="fichier" name="fichier">
                            @if($documents->fichier)
                            <small class="text-muted">Fichier actuel: {{ $documents->fichier }}</small>
                            @endif
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                            <a href="{{ route('documents.index') }}" class="btn btn-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
