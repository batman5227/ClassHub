@extends('layouts.master')

@section('title')
    Affecter un Rôle - ClassHub
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Affecter un Rôle à un Utilisateur</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Formulaire d'affectation</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('role-users.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="idUsers" class="form-label">Utilisateur</label>
                            <select class="form-select" id="idUsers" name="idUsers" required>
                                <option value="">Sélectionner un utilisateur</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="idRole" class="form-label">Rôle</label>
                            <select class="form-select" id="idRole" name="idRole" required>
                                <option value="">Sélectionner un rôle</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="ri-save-line me-1"></i> Enregistrer
                            </button>
                            <a href="{{ route('role-users.index') }}" class="btn btn-light">
                                <i class="ri-arrow-left-line me-1"></i> Retour
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
