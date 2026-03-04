@extends('layouts.master')

@section('title')
    Détails de l'Association - ClassHub
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Détails de l'Association</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('classe-matiere-groupe.index') }}">Associations</a></li>
                        <li class="breadcrumb-item active">Détails</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-gradient border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="avatar me-3" style="width:50px;height:50px;font-size:18px"><i class="ri-links-line"></i></div>
                        <div><h5 class="card-title mb-0 text-white">Association</h5><span class="text-white-50">Classe-Matière-Groupe</span></div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr><td class="text-muted w-50"><strong>Classe:</strong></td><td class="fw-semibold">{{ $classeMatiereGroupe->classe->nom ?? 'N/A' }}</td></tr>
                        <tr><td class="text-muted"><strong>Matière:</strong></td><td>{{ $classeMatiereGroupe->matiere->nom ?? 'N/A' }}</td></tr>
                        <tr><td class="text-muted"><strong>Groupe:</strong></td><td>{{ $classeMatiereGroupe->groupe->nom ?? 'N/A' }}</td></tr>
                        <tr><td class="text-muted"><strong>Créé le:</strong></td><td>{{ $classeMatiereGroupe->created_at ? $classeMatiereGroupe->created_at->format('d/m/Y H:i') : 'N/A' }}</td></tr>
                    </table>
                    <div class="mt-4 pt-3 border-top d-flex justify-content-between">
                        <a href="{{ route('classe-matiere-groupe.index') }}" class="btn btn-light"><i class="ri-arrow-left-line me-1"></i>Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
