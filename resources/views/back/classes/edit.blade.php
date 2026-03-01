@extends('layouts.master')

@section('title')
    Modifier une Classe - ClassHub
@endsection

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">
                    <div class="classe-page-title">
                        <div class="classe-page-title-icon">
                            <i class="ri-edit-line"></i>
                        </div>
                        Modifier une Classe
                    </div>
                </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('classes.index') }}">Classes</a></li>
                        <li class="breadcrumb-item active">Modifier</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card classe-card">
                <div class="card-header bg-gradient border-bottom d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="ri-edit-line me-2 fs-4 text-white"></i>
                        <h5 class="card-title mb-0 text-white">
                            <i class="ri-information-line me-2"></i>Modifier les informations de la Classe
                        </h5>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('classes.update', $classe->id) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="nom" class="classe-form-label">
                                    <i class="ri-book-mark-line"></i>Nom de la classe
                                </label>
                                <select class="form-select classe-form-select" id="nom" name="nom" required>
                                    <option value="6ème" {{ $classe->nom == '6ème' ? 'selected' : '' }}>6ème</option>
                                    <option value="5ème" {{ $classe->nom == '5ème' ? 'selected' : '' }}>5ème</option>
                                    <option value="4ème" {{ $classe->nom == '4ème' ? 'selected' : '' }}>4ème</option>
                                    <option value="3ème" {{ $classe->nom == '3ème' ? 'selected' : '' }}>3ème</option>
                                    <option value="2nde" {{ $classe->nom == '2nde' ? 'selected' : '' }}>2nde</option>
                                    <option value="1ère" {{ $classe->nom == '1ère' ? 'selected' : '' }}>1ère</option>
                                    <option value="Terminale" {{ $classe->nom == 'Terminale' ? 'selected' : '' }}>Terminale</option>
                                </select>
                                <div class="invalid-feedback">Veuillez sélectionner un niveau de classe.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="idSites" class="classe-form-label">
                                    <i class="ri-map-pin-line"></i>Site
                                </label>
                                <select class="form-select classe-form-select" id="idSites" name="idSites" required>
                                    <option value="">Sélectionner un site</option>
                                    @foreach($sites as $site)
                                    <option value="{{ $site->id }}" {{ $classe->idSites == $site->id ? 'selected' : '' }}>{{ $site->nom }} - {{ $site->localisation }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Veuillez sélectionner un site.</div>
                            </div>
                        </div>

                        <!-- Info Box -->
                        <div class="alert alert-warning mt-4 d-flex align-items-center" role="alert">
                            <i class="ri-alert-line fs-4 me-2"></i>
                            <div>
                                <strong>Attention:</strong> La modification du site affectera toutes les données associées à cette classe.
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top d-flex justify-content-between align-items-center">
                            <a href="{{ route('classes.index') }}" class="btn btn-light btn-lg">
                                <i class="ri-arrow-left-line me-1"></i>Retour
                            </a>
                            <button type="submit" class="btn classe-btn classe-btn-success btn-lg">
                                <i class="ri-save-line me-1"></i>Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    // Form validation
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endpush
@endsection
