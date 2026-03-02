@extends('layouts.master')

@section('title')
    Détails de l'Utilisateur - ClassHub
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Détails de l'Utilisateur</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Utilisateurs</a></li>
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
                        <div class="avatar me-3" style="width:50px;height:50px;font-size:18px">{{ substr($user->name, 0, 2) }}</div>
                        <div><h5 class="card-title mb-0 text-white">{{ $user->name }}</h5><span class="text-white-50">Utilisateur</span></div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr><td class="text-muted w-50"><strong>Nom:</strong></td><td class="fw-semibold">{{ $user->name }}</td></tr>
                        <tr><td class="text-muted"><strong>Email:</strong></td><td>{{ $user->email }}</td></tr>
                        <tr><td class="text-muted"><strong>Statut:</strong></td>
                            <td>
                                @if($user->status === 'actif')
                                    <span class="badge bg-success">Actif</span>
                                @else
                                    <span class="badge bg-danger">Inactif</span>
                                @endif
                            </td>
                        </tr>
                        <tr><td class="text-muted"><strong>Créé le:</strong></td><td>{{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : 'N/A' }}</td></tr>
                    </table>
                    <div class="mt-4 pt-3 border-top d-flex justify-content-between">
                        <a href="{{ route('users.index') }}" class="btn btn-light"><i class="ri-arrow-left-line me-1"></i>Retour</a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success"><i class="ri-edit-line me-1"></i>Modifier</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
