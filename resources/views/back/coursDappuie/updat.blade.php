@extends('layouts.master')
@section('content')
<div class="container-fluid px-4 py-5">
    <!-- En-tête avec gradient -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient-primary rounded-4 p-5 shadow-lg position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-edit fa-8x text-white"></i>
                </div>
                <div class="position-absolute bottom-0 start-0 opacity-10">
                    <i class="fas fa-book-open fa-8x text-white"></i>
                </div>

                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-white opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('coursdappuies.index') }}" class="text-white opacity-75">Cours d'appui</a>
                                </li>
                                <li class="breadcrumb-item active text-white" aria-current="page">Modification</li>
                            </ol>
                        </nav>

                        <h1 class="display-4 fw-bold text-white mb-3">Modification d'un cours</h1>
                        <p class="text-white opacity-90 lead mb-4">
                            Modifiez les informations de <span class="fw-bold bg-white text-primary px-3 py-1 rounded-pill">{{ $coursdappuie->nom }}</span>
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('coursdappuies.index') }}" class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
                            <i class="fas fa-arrow-left me-2 text-primary"></i>Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire de modification -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 p-4">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-edit text-primary me-2"></i>
                        Modifier le cours d'appui
                    </h4>
                    <p class="text-muted mb-0 mt-1">
                        Modifiez les informations ci-dessous pour mettre à jour le cours
                    </p>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('coursdappuies.update', $coursdappuie->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nom -->
                        <div class="mb-4">
                            <label for="nom" class="form-label fw-semibold">
                                <i class="fas fa-tag text-primary me-2"></i>Nom du cours
                            </label>
                            <input type="text"
                                   name="nom"
                                   id="nom"
                                   class="form-control form-control-lg @error('nom') is-invalid @enderror"
                                   placeholder="Ex: Mathématiques, Français, etc."
                                   value="{{ old('nom', $coursdappuie->nom) }}"
                                   required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Slogan -->
                        <div class="mb-4">
                            <label for="slogan" class="form-label fw-semibold">
                                <i class="fas fa-quote-right text-primary me-2"></i>Slogan
                            </label>
                            <input type="text"
                                   name="slogan"
                                   id="slogan"
                                   class="form-control form-control-lg @error('slogan') is-invalid @enderror"
                                   placeholder="Ex: La mathématique est la poésie de la logique"
                                   value="{{ old('slogan', $coursdappuie->slogan) }}"
                                   required>
                            @error('slogan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Logo actuel -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-image text-primary me-2"></i>Logo actuel
                            </label>
                            @if($coursdappuie->logo)
                                <div class="bg-light rounded-3 p-3 text-center mb-3">
                                    <img src="{{ asset('storage/' . $coursdappuie->logo) }}"
                                         alt="{{ $coursdappuie->nom }}"
                                         style="max-height: 150px; max-width: 100%;"
                                         class="rounded-3">
                                </div>
                            @else
                                <div class="bg-light rounded-3 p-3 text-center mb-3">
                                    <i class="fas fa-image fa-4x text-muted"></i>
                                    <p class="text-muted mb-0">Aucun logo</p>
                                </div>
                            @endif
                        </div>

                        <!-- Nouveau logo -->
                        <div class="mb-4">
                            <label for="logo" class="form-label fw-semibold">
                                <i class="fas fa-cloud-upload-alt text-primary me-2"></i>Changer le logo
                            </label>
                            <input type="file"
                                   name="logo"
                                   id="logo"
                                   class="form-control form-control-lg @error('logo') is-invalid @enderror"
                                   accept="image/*">
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Laissez vide pour conserver le logo actuel</small>
                        </div>

                        <!-- Aperçu du nouveau logo -->
                        <div class="mb-4" id="preview-container" style="display: none;">
                            <label class="form-label fw-semibold">Aperçu du nouveau logo</label>
                            <div class="bg-light rounded-3 p-3 text-center">
                                <img id="logo-preview" src="#" alt="Aperçu" style="max-height: 150px; max-width: 100%;">
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="d-flex justify-content-between align-items-center mt-4 pt-4 border-top">
                            <a href="{{ route('coursdappuies.index') }}" class="btn btn-outline-secondary btn-lg px-5 rounded-pill">
                                <i class="fas fa-times me-2"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill shadow-primary hover-lift">
                                <i class="fas fa-save me-2"></i>Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .hover-lift {
        transition: transform 0.2s;
    }

    .hover-lift:hover {
        transform: translateY(-2px);
    }

    .shadow-primary {
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
</style>
@endpush

@push('scripts')
<script>
    // Aperçu du nouveau logo
    document.getElementById('logo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('logo-preview').src = e.target.result;
                document.getElementById('preview-container').style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            document.getElementById('preview-container').style.display = 'none';
        }
    });
</script>
@endpush
