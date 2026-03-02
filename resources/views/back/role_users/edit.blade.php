@extends('layouts.master')

@section('title')
    Modifier l'Affectation - ClassHub
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Modifier l'Affectation du Rôle</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Formulaire de modification</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('role-users.update', $roleUsers->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="idUsers" class="form-label">Utilisateur</label>
                            <select class="form-select" id="idUsers" name="idUsers" required>
                                <option value="">Sélectionner un utilisateur</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $roleUsers->idUsers == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="idRole" class="form-label">Rôle</label>
                            <select class="form-select" id="idRole" name="idRole" required>
                                <option value="">Sélectionner un rôle</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $roleUsers->idRole == $role->id ? 'selected' : '' }}>
                                        {{ $role->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="ri-save-line me-1"></i> Mettre à jour
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
