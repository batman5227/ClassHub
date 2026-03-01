@extends('layouts.master')

@section('title')
    Détails du Site - ClassHub
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Détails du Site</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('sites.index') }}">Sites</a></li>
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
                        <div class="avatar me-3" style="width:50px;height:50px;font-size:18px">{{ substr($site->nom, 0, 2) }}</div>
                        <div><h5 class="card-title mb-0 text-white">{{ $site->nom }}</h5><span class="text-white-50">Site</span></div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr><td class="text-muted w-50"><strong>Nom:</strong></td><td class="fw-semibold">{{ $site->nom }}</td></tr>
                        <tr><td class="text-muted"><strong>Localisation:</strong></td><td>{{ $site->localisation }}</td></tr>
                        <tr><td class="text-muted"><strong>Créé le:</strong></td><td>{{ $site->created_at->format('d/m/Y H:i') }}</td></tr>
                    </table>
                    <div class="mt-4 pt-3 border-top d-flex justify-content-between">
                        <a href="{{ route('sites.index') }}" class="btn btn-light"><i class="ri-arrow-left-line me-1"></i>Retour</a>
                        <a href="{{ route('sites.edit', $site->id) }}" class="btn btn-success"><i class="ri-edit-line me-1"></i>Modifier</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-gradient"><h5 class="card-title mb-0 text-white">Statistiques</h5></div>
                <div class="card-body">
                    <div class="stat-card">
                        <div class="d-flex align-items-center">
                            <div class="stat-card-icon"><i class="ri-home-line"></i></div>
                            <div class="ms-3"><div class="stat-card-number">-</div><div class="stat-card-label">Classes</div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
