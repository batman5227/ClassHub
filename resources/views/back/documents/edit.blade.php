@extends('layouts.master')

@section('title')
    Modifier un Document - ClassHub
@endsection

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

<div class="container-fluid px-4 py-5">

    <!-- En-tête avec dégradé -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient rounded-4 p-5 shadow-lg position-relative overflow-hidden"
                 style="background: linear-gradient(135deg, #f46b45 0%, #eea849 100%);">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-file-alt fa-8x text-blue"></i>
                </div>
                <div class="position-absolute bottom-0 start-0 opacity-10">
                    <i class="fas fa-edit fa-8x text-blue"></i>
                </div>
                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-blue opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('documents.index') }}" class="text-blue opacity-75">Documents</a>
                                </li>
                                <li class="breadcrumb-item active text-blue" aria-current="page">Modifier</li>
                            </ol>
                        </nav>
                        <h1 class="display-4 fw-bold text-blue mb-3">Modifier un document</h1>
                        <p class="text-blue opacity-90 lead mb-4">{{ $document->nom }}</p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('documents.index') }}"
                           class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
                            <i class="fas fa-arrow-left me-2 text-primary"></i>Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 p-4">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-edit text-primary me-2"></i>Formulaire de modification
                    </h4>
                    <p class="text-muted mb-0 mt-1">Modifiez les informations du document</p>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('documents.update', $document->id) }}" method="POST" enctype="multipart/form-data" id="editDocumentForm">
                        @csrf
                        @method('PUT')

                        <!-- Nom du document -->
                        <div class="mb-4">
                            <label for="nom" class="form-label fw-semibold">
                                <i class="fas fa-tag text-primary me-2"></i>Nom du document
                            </label>
                            <input type="text"
                                   class="form-control form-control-lg rounded-4 @error('nom') is-invalid @enderror"
                                   id="nom"
                                   name="nom"
                                   value="{{ old('nom', $document->nom) }}"
                                   placeholder="Ex: Cours de mathématiques chapitre 1"
                                   required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Matière (optionnel) -->
                        <div class="mb-4">
                            <label for="idMatiere" class="form-label fw-semibold">
                                <i class="fas fa-book text-primary me-2"></i>Matière associée (optionnel)
                            </label>
                            <select class="form-select form-select-lg rounded-4 @error('idMatiere') is-invalid @enderror"
                                    id="idMatiere"
                                    name="idMatiere">
                                <option value="">Aucune matière</option>
                                @foreach($matieres as $matiere)
                                    <option value="{{ $matiere->id }}"
                                        {{ old('idMatiere', $document->idMatiere) == $matiere->id ? 'selected' : '' }}>
                                        {{ $matiere->nom }} ({{ $matiere->classe->nom ?? 'Sans classe' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('idMatiere')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Fichier actuel -->
                        @if($document->fichier)
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-file text-primary me-2"></i>Fichier actuel
                            </label>
                            <div class="bg-light rounded-4 p-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-pdf text-danger fa-2x me-3"></i>
                                        <div>
                                            <span class="fw-semibold">{{ basename($document->fichier) }}</span>
                                            <small class="text-muted d-block">
                                                @php
                                                    $taille = Storage::exists($document->fichier) ? Storage::size($document->fichier) : 0;
                                                    echo $taille > 0 ? round($taille / 1024, 2) . ' KB' : 'Taille inconnue';
                                                @endphp
                                            </small>
                                        </div>
                                    </div>
                                    <a href="{{ Storage::url($document->fichier) }}"
                                       class="btn btn-sm btn-outline-success rounded-pill px-3"
                                       target="_blank">
                                        <i class="fas fa-download me-1"></i>Télécharger
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Nouveau fichier (optionnel) -->
                        <div class="mb-4">
                            <label for="fichier" class="form-label fw-semibold">
                                <i class="fas fa-file text-primary me-2"></i>Nouveau fichier (optionnel)
                            </label>
                            <div class="upload-area rounded-4 p-5 text-center" id="uploadArea">
                                <i class="fas fa-cloud-upload-alt fa-4x text-primary mb-3"></i>
                                <h6 class="mb-2">Glissez-déposez un nouveau fichier ici</h6>
                                <p class="text-muted small mb-3">ou</p>
                                <input type="file"
                                       class="form-control d-none"
                                       id="fichier"
                                       name="fichier">
                                <button type="button" class="btn btn-outline-primary rounded-pill px-4" id="browseBtn">
                                    <i class="fas fa-folder-open me-2"></i>Parcourir
                                </button>
                                <div id="fileInfo" class="mt-3 text-start d-none">
                                    <div class="bg-light rounded-3 p-3">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        <span id="fileName"></span>
                                        <small class="text-muted d-block" id="fileSize"></small>
                                    </div>
                                </div>
                            </div>
                            @error('fichier')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Laissez vide pour conserver le fichier actuel</small>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="d-flex gap-3 justify-content-end">
                            <a href="{{ route('documents.index') }}"
                               class="btn btn-outline-secondary rounded-pill px-5 py-3">
                                <i class="fas fa-times me-2"></i>Annuler
                            </a>
                            <button type="submit"
                                    class="btn btn-warning rounded-pill px-5 py-3 shadow-sm hover-lift"
                                    id="btnSubmit">
                                <i class="fas fa-save me-2"></i>Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient {
        background: linear-gradient(135deg, #f46b45 0%, #eea849 100%);
    }
    .hover-lift { transition: transform 0.2s ease; }
    .hover-lift:hover { transform: translateY(-2px); }
    .form-control, .form-select {
        border: 2px solid #e9ecef;
        transition: all 0.2s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: #f46b45;
        box-shadow: 0 0 0 0.2rem rgba(244, 107, 69, 0.1);
    }
    .upload-area {
        border: 2px dashed #f46b45;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .upload-area:hover {
        background-color: #fff3e0;
        border-color: #d85a3a;
    }
    .upload-area.highlight {
        background-color: #fff3e0;
        border-color: #d85a3a;
    }
</style>

<script>
(function() {
    // Gestion de l'upload de fichier
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('fichier');
    const browseBtn = document.getElementById('browseBtn');
    const fileInfo = document.getElementById('fileInfo');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');

    browseBtn.addEventListener('click', function() {
        fileInput.click();
    });

    uploadArea.addEventListener('click', function(e) {
        if (e.target !== browseBtn && e.target !== fileInput) {
            fileInput.click();
        }
    });

    fileInput.addEventListener('change', function() {
        if (this.files.length > 0) {
            const file = this.files[0];
            fileName.textContent = file.name;
            fileSize.textContent = (file.size / 1024).toFixed(2) + ' KB';
            fileInfo.classList.remove('d-none');
        } else {
            fileInfo.classList.add('d-none');
        }
    });

    // Drag & drop
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('highlight');
    });

    uploadArea.addEventListener('dragleave', function(e) {
        this.classList.remove('highlight');
    });

    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('highlight');
        fileInput.files = e.dataTransfer.files;
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            fileName.textContent = file.name;
            fileSize.textContent = (file.size / 1024).toFixed(2) + ' KB';
            fileInfo.classList.remove('d-none');
        }
    });

    // Confirmation avant soumission
    document.getElementById('editDocumentForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        var form = this;

        Swal.fire({
            title: 'Modifier ce document ?',
            html: `
                <div class="text-center">
                    <i class="fas fa-edit text-warning fa-4x mb-3"></i>
                    <p class="mb-1">Vous êtes sur le point de modifier ce document.</p>
                    <p class="text-muted small">Les changements seront appliqués immédiatement.</p>
                </div>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#f46b45',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, modifier',
            cancelButtonText: 'Annuler',
            reverseButtons: true,
            focusCancel: true,
            customClass: {
                popup: 'rounded-4 shadow-lg'
            }
        }).then(function(result) {
            if (result.isConfirmed) {
                var btn = document.getElementById('btnSubmit');
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mise à jour...';
                form.submit();
            }
        });
    });
})();
</script>

@endsection
