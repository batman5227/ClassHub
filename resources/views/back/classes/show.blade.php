@extends('layouts.master')

@section('title')
    Détails de la Classe - ClassHub
@endsection

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Détails de la Classe</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('classes.index') }}">Classes</a></li>
                        <li class="breadcrumb-item active">Détails</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ $classe->nom }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Informations</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Nom:</strong></td>
                                    <td>{{ $classe->nom }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Site:</strong></td>
                                    <td>{{ $classe->sites->nom ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Date de création:</strong></td>
                                    <td>{{ $classe->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6>Groupe de Matières</h6>
                            @if($classe->classeMatiereGroupes->count() > 0)
                                <ul class="list-group">
                                    @foreach($classe->classeMatiereGroupes as $cmg)
                                    <li class="list-group-item">
                                        {{ $cmg->matiere->nom ?? 'N/A' }} - {{ $cmg->groupe->nom ?? 'N/A' }}
                                    </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted">Aucun groupe de matières associé</p>
                            @endif
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('classes.edit', $classe->id) }}" class="btn btn-warning">
                            <i class="ri-edit-line"></i> Modifier
                        </a>
                        <a href="{{ route('classes.index') }}" class="btn btn-secondary">
                            <i class="ri-arrow-left-line"></i> Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
