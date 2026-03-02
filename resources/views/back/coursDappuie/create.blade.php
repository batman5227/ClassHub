@extends('layouts.master')
@section('content')
<div class="container-fluid px-4 py-5">
    <!-- En-tête avec gradient -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient-primary rounded-4 p-5 shadow-lg position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-plus-circle fa-8x text-blue"></i>
                </div>
                <div class="position-absolute bottom-0 start-0 opacity-10">
                    <i class="fas fa-book-open fa-8x text-blue"></i>
                </div>

                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-blue opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('coursdappuies.index') }}" class="text-blue opacity-75">Cours d'appui</a>
                                </li>
                                <li class="breadcrumb-item active text-blue" aria-current="page">Création</li>
                            </ol>
                        </nav>

                        <h1 class="display-4 fw-bold text-blue mb-3">Création d'un cours d'appui</h1>
                        <p class="text-blue opacity-90 lead mb-4">
                            Ajoutez un nouveau cours d'appui à l'application
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

    <!-- Messages flash -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm border-0 bg-danger bg-opacity-10 mb-4" role="alert">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle fa-2x text-danger"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h5 class="alert-heading mb-1 text-danger">Erreur</h5>
                    <p class="mb-0">{{ session('error') }}</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- Formulaire de création -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 p-4">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-plus-circle text-primary me-2"></i>
                        Nouveau cours d'appui
                    </h4>
                    <p class="text-muted mb-0 mt-1">
                        Remplissez les informations ci-dessous pour créer un nouveau cours
                    </p>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('coursdappuies.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- SECTION 1: INFORMATIONS GÉNÉRALES -->
                        <div class="mb-4">
                            <h5 class="text-primary mb-3 pb-2 border-bottom">
                                <i class="fas fa-info-circle me-2"></i>Informations générales
                            </h5>

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
                                       value="{{ old('nom') }}"
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
                                <textarea name="slogan"
                                          id="slogan"
                                          rows="3"
                                          class="form-control form-control-lg @error('slogan') is-invalid @enderror"
                                          placeholder="Ex: La mathématique est la poésie de la logique"
                                          required>{{ old('slogan') }}</textarea>
                                @error('slogan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Une phrase accrocheuse pour décrire le cours</small>
                            </div>
                        </div>

                        <!-- SECTION 2: LOGO (style identique à la photo de profil) -->
                        <div class="mb-4">
                            <h5 class="text-primary mb-3 pb-2 border-bottom">
                                <i class="fas fa-image me-2"></i>Logo du cours
                            </h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="logo" class="form-label fw-semibold">
                                        <i class="fas fa-cloud-upload-alt text-primary me-2"></i>Logo
                                    </label>
                                    <input type="file"
                                           name="logo"
                                           id="logo"
                                           class="form-control form-control-lg @error('logo') is-invalid @enderror"
                                           accept="image/*">
                                    @error('logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Formats acceptés : JPG, PNG, GIF, WEBP, SVG. Taille max : 5 Mo</small>
                                </div>
                            </div>

                            <!-- Aperçu du logo (style carte) -->
                            <div class="mt-4" id="preview-container" style="display: none;">
                                <label class="form-label fw-semibold">Aperçu du logo</label>
                                <div class="bg-light rounded-4 p-4 text-center">
                                    <img id="logo-preview"
                                         src="#"
                                         alt="Aperçu"
                                         class="img-fluid rounded-3 shadow-sm"
                                         style="max-height: 200px; object-fit: contain; border: 3px solid #667eea;">
                                </div>
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="d-flex justify-content-between align-items-center mt-4 pt-4 border-top">
                            <a href="{{ route('coursdappuies.index') }}" class="btn btn-outline-secondary btn-lg px-5 rounded-pill">
                                <i class="fas fa-times me-2"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill shadow-primary hover-lift">
                                <i class="fas fa-save me-2"></i>Créer le cours
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Aperçu du logo - Même approche que pour la photo de profil
    document.getElementById('logo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const previewContainer = document.getElementById('preview-container');
        const logoPreview = document.getElementById('logo-preview');

        if (file) {
            // Vérification basique de la taille (5 Mo)
            if (file.size > 5 * 1024 * 1024) {
                alert('L\'image est trop volumineuse. Taille maximum : 5 Mo');
                this.value = '';
                previewContainer.style.display = 'none';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                logoPreview.src = e.target.result;
                previewContainer.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
        }
    });
</script>

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

    .bg-opacity-20 {
        --bs-bg-opacity: 0.2;
    }

    /* Animation pour l'aperçu */
    #preview-container {
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush
@endsection
