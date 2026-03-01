@extends('layouts.master')

@section('title')
    Ajouter une Classe - ClassHub
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
                            <i class="ri-add-circle-line"></i>
                        </div>
                        Ajouter une Classe
                    </div>
                </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('classes.index') }}">Classes</a></li>
                        <li class="breadcrumb-item active">Ajouter</li>
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
                        <i class="ri-school-line me-2 fs-4 text-white"></i>
                        <h5 class="card-title mb-0 text-white">
                            <i class="ri-information-line me-2"></i>Informations de la Classe
                        </h5>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('classes.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="nom" class="classe-form-label">
                                    <i class="ri-book-mark-line"></i>Nom de la classe
                                </label>
                                <select class="form-select classe-form-select" id="nom" name="nom" required>
                                    <option value="">Sélectionner une classe</option>
                                    <option value="6ème">6ème</option>
                                    <option value="5ème">5ème</option>
                                    <option value="4ème">4ème</option>
                                    <option value="3ème">3ème</option>
                                    <option value="2nde">2nde</option>
                                    <option value="1ère">1ère</option>
                                    <option value="Terminale">Terminale</option>
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
                                    <option value="{{ $site->id }}">{{ $site->nom }} - {{ $site->localisation }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Veuillez sélectionner un site.</div>
                            </div>
                        </div>

                        <!-- Info Box -->
                        <div class="alert alert-info mt-4 d-flex align-items-center" role="alert">
                            <i class="ri-information-line fs-4 me-2"></i>
                            <div>
                                <strong>Information:</strong> Vous pourrez ajouter et des des matières groupes à cette classe après sa création.
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top d-flex justify-content-between align-items-center">
                            <a href="{{ route('classes.index') }}" class="btn btn-light btn-lg">
                                <i class="ri-arrow-left-line me-1"></i>Retour
                            </a>
                            <button type="submit" class="btn classe-btn classe-btn-primary btn-lg">
                                <i class="ri-save-line me-1"></i>Enregistrer
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
