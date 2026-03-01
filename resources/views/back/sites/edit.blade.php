@extends('layouts.master')

@section('title')
    Modifier un Site - ClassHub
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Modifier un Site</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('sites.index') }}">Sites</a></li>
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
                    <h5 class="card-title text-white">Modifier le Site</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('sites.update', $site->id) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom du site</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ $site->nom }}" required>
                            <div class="invalid-feedback">Veuillez entrer un nom de site.</div>
                        </div>
                        <div class="mb-3">
                            <label for="localisation" class="form-label">Localisation</label>
                            <input type="text" class="form-control" id="localisation" name="localisation" value="{{ $site->localisation }}" required>
                            <div class="invalid-feedback">Veuillez entrer une localisation.</div>
                        </div>
                        <div class="mt-4 pt-3 border-top d-flex justify-content-between">
                            <a href="{{ route('sites.index') }}" class="btn btn-light"><i class="ri-arrow-left-line me-1"></i>Retour</a>
                            <button type="submit" class="btn btn-success"><i class="ri-save-line me-1"></i>Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
