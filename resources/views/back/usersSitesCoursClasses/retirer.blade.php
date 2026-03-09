@extends('layouts.master')
@section('content')
<div class="container-fluid px-4 py-5">
    <!-- En-tête avec gradient rouge -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient rounded-4 p-5 shadow-lg position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="fas fa-user-minus fa-8x text-blue"></i>
                </div>
                <div class="position-absolute bottom-0 start-0 opacity-10">
                    <i class="fas fa-school-circle-exclamation fa-8x text-blue"></i>
                </div>

                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="text-blue opacity-75">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('users.index') }}" class="text-blue opacity-75">Utilisateurs</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('users.show', $user->id) }}" class="text-blue opacity-75">{{ $user->nom }} {{ $user->prenom }}</a>
                                </li>
                                <li class="breadcrumb-item active text-blue" aria-current="page">Retirer des affectations</li>
                            </ol>
                        </nav>

                        <h1 class="display-4 fw-bold text-blue mb-3">Retirer des affectations</h1>
                        <p class="text-blue opacity-90 lead mb-4">
                            Retirez des affectations à <span class="fw-bold bg-white text-primary px-3 py-1 rounded-pill">{{ $user->nom }} {{ $user->prenom }}</span>
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-light btn-lg rounded-pill px-5 shadow-sm hover-lift">
                            <i class="fas fa-arrow-left me-2 text-primary"></i>Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($affectations->isEmpty())
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="fas fa-empty-set fa-5x text-muted"></i>
            </div>
            <h3 class="fw-bold mb-3">Aucune affectation à retirer</h3>
            <p class="text-muted mb-4">
                L'utilisateur <span class="fw-bold">{{ $user->nom }} {{ $user->prenom }}</span> n'a aucune affectation.
            </p>
            <a href="{{ route('users-coursappuie-site-classes.assigner', $user->id) }}" class="btn btn-primary btn-lg rounded-pill px-5">
                <i class="fas fa-plus-circle me-2"></i>Affecter
            </a>
        </div>
    @else
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-header bg-white border-0 p-4">
                <h4 class="mb-0 fw-bold">
                    <i class="fas fa-list text-danger me-2"></i>
                    Sélectionnez les affectations à retirer
                </h4>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('users-coursappuie-site-classes.retirer-multiple', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="row g-3">
                        @foreach($affectations as $affectation)
                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <input type="checkbox"
                                                       name="affectations[]"
                                                       value="{{ $affectation->id }}"
                                                       class="form-check-input"
                                                       id="affectation_{{ $affectation->id }}">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <label class="fw-semibold" for="affectation_{{ $affectation->id }}">
                                                    <i class="fas fa-location-dot text-success me-2"></i>{{ $affectation->site->nom }}
                                                    <br>
                                                    <i class="fas fa-book-open text-info me-2"></i>{{ $affectation->coursAppuie->nom }}
                                                    <br>
                                                    <i class="fas fa-graduation-cap text-warning me-2"></i>{{ $affectation->classe->nom }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="alert alert-warning mt-4 rounded-3" id="no-selection-alert" style="display: none;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle fa-2x me-3 text-warning"></i>
                            <p class="mb-0">Veuillez sélectionner au moins une affectation à retirer.</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-secondary btn-lg px-5 rounded-pill">
                            Annuler
                        </a>
                        <button type="submit" class="btn btn-danger btn-lg px-5 rounded-pill" id="submit-btn">
                            <i class="fas fa-trash-alt me-2"></i>Retirer les affectations sélectionnées
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>

<style>
    .bg-gradient-danger {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[name="affectations[]"]');
    const submitBtn = document.getElementById('submit-btn');
    const alert = document.getElementById('no-selection-alert');

    function updateSelection() {
        const checked = document.querySelectorAll('input[name="affectations[]"]:checked');
        if (checked.length === 0) {
            alert.style.display = 'block';
            submitBtn.disabled = true;
        } else {
            alert.style.display = 'none';
            submitBtn.disabled = false;
        }
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', updateSelection);
    });

    updateSelection();
});
</script>
@endsection
