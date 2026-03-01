@extends('layouts.master')

@section('title')
    Détails de la Matière - ClassHub
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Détails de la Matière</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('matieres.index') }}">Matières</a></li>
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
                        <div class="avatar me-3" style="width: 50px; height: 50px; font-size: 18px;">
                            {{ substr($matiere->nom, 0, 2) }}
                        </div>
                        <div>
                            <h5 class="card-title mb-0 text-white">{{ $matiere->nom }}</h5>
                            <span class="text-white-50">Matière</span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td class="text-muted w-50"><strong>Nom:</strong></td>
                            <td class="fw-semibold">{{ $matiere->nom }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><strong>Description:</strong></td>
                            <td>{{ $matiere->description ?? 'Aucune description' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><strong>Date de création:</strong></td>
                            <td>{{ $matiere->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><strong>Dernière modification:</strong></td>
                            <td>{{ $matiere->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                    <div class="mt-4 pt-3 border-top d-flex justify-content-between">
                        <a href="{{ route('matieres.index') }}" class="btn btn-light">
                            <i class="ri-arrow-left-line me-1"></i>Retour
                        </a>
                        <div class="d-flex gap-2">
                            <a href="{{ route('matieres.edit', $matiere->id) }}" class="btn btn-success">
                                <i class="ri-edit-line me-1"></i>Modifier
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-gradient">
                    <h5 class="card-title mb-0 text-white">Statistiques</h5>
                </div>
                <div class="card-body">
                    <div class="stat-card">
                        <div class="d-flex align-items-center">
                            <div class="stat-card-icon">
                                <i class="ri-book-2-line"></i>
                            </div>
                            <div class="ms-3">
                                <div class="stat-card-number">-</div>
                                <div class="stat-card-label">Associations</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
