@extends('layouts.master')

@section('title')
    Détails de l'Élève - ClassHub
@endsection

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Détails de l'Élève</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('eleves.index') }}">Élèves</a></li>
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
                    <h5 class="card-title mb-0">{{ $elefe->nom }} {{ $elefe->prenom }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Informations</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Nom:</strong></td>
                                    <td>{{ $elefe->nom }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Prénom:</strong></td>
                                    <td>{{ $elefe->prenom }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Numéro Parents:</strong></td>
                                    <td>{{ $elefe->numParents }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Date de création:</strong></td>
                                    <td>{{ $elefe->created_at ? $elefe->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('eleves.edit', $elefe) }}" class="btn btn-warning">
                            <i class="ri-edit-line"></i> Modifier
                        </a>
                        <a href="{{ route('eleves.index') }}" class="btn btn-secondary">
                            <i class="ri-arrow-left-line"></i> Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

