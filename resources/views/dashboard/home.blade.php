@extends('layouts.master')
@section('title', 'Dashboard - ClassHub')
@section('content')
    <!-- Page-content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="h-100">
                    <div class="row mb-3 pb-1">
                        <div class="col-12">
                            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                <div class="flex-grow-1">
                                    <h4 class="fs-16 mb-1">Bonjour !</h4>
                                    <p class="text-muted mb-0">Bienvenue sur votre tableau de bord ClassHub.</p>
                                </div>
                                <div class="mt-3 mt-lg-0">
                                    <a href="{{ route('classes.create') }}" class="btn btn-primary">
                                        <i class="ri-add-circle-line align-middle me-1"></i> Ajouter une classe
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Classes</p>
                                            <h4 class="fs-22 fw-semibold my-1">{{ $stats['totalClasses'] }}</h4>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary-subtle rounded-circle fs-4">
                                                <i class="ri-school-line text-primary"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer border-0 py-0">
                                    <a href="{{ route('classes.index') }}" class="text-muted fs-13">Voir les classes <i class="ri-arrow-right-s-line align-bottom"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Élèves</p>
                                            <h4 class="fs-22 fw-semibold my-1">{{ $stats['totalEleves'] }}</h4>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-success-subtle rounded-circle fs-4">
                                                <i class="ri-user-3-line text-success"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer border-0 py-0">
                                    <a href="{{ route('eleves.index') }}" class="text-muted fs-13">Voir les élèves <i class="ri-arrow-right-s-line align-bottom"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Sites</p>
                                            <h4 class="fs-22 fw-semibold my-1">{{ $stats['totalSites'] }}</h4>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-4">
                                                <i class="ri-map-pin-line text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer border-0 py-0">
                                    <a href="{{ route('sites.index') }}" class="text-muted fs-13">Voir les sites <i class="ri-arrow-right-s-line align-bottom"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Matières</p>
                                            <h4 class="fs-22 fw-semibold my-1">{{ $stats['totalMatieres'] }}</h4>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-warning-subtle rounded-circle fs-4">
                                                <i class="ri-book-2-line text-warning"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer border-0 py-0">
                                    <a href="{{ route('matieres.index') }}" class="text-muted fs-13">Voir les matières <i class="ri-arrow-right-s-line align-bottom"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Second Row: Groupes, Cours, Documents -->
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Groupes</p>
                                            <h4 class="fs-22 fw-semibold my-1">{{ $stats['totalGroupes'] }}</h4>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-danger-subtle rounded-circle fs-4">
                                                <i class="ri-group-line text-danger"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer border-0 py-0">
                                    <a href="{{ route('groupes.index') }}" class="text-muted fs-13">Voir les groupes <i class="ri-arrow-right-s-line align-bottom"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Cours</p>
                                            <h4 class="fs-22 fw-semibold my-1">{{ $stats['totalCours'] }}</h4>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-secondary-subtle rounded-circle fs-4">
                                                <i class="ri-book-open-line text-secondary"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer border-0 py-0">
                                    <a href="{{ route('cours.index') }}" class="text-muted fs-13">Voir les cours <i class="ri-arrow-right-s-line align-bottom"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Documents</p>
                                            <h4 class="fs-22 fw-semibold my-1">{{ $stats['totalDocuments'] }}</h4>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-dark-subtle rounded-circle fs-4">
                                                <i class="ri-file-line text-dark"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer border-0 py-0">
                                    <a href="{{ route('documents.index') }}" class="text-muted fs-13">Voir les documents <i class="ri-arrow-right-s-line align-bottom"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Data -->
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Classes Récentes</h4>
                                    <div class="flex-shrink-0">
                                        <a href="{{ route('classes.index') }}" class="btn btn-sm btn-soft-primary">
                                            Voir tout
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @if($recentClasses->isEmpty())
                                        <div class="text-center py-4">
                                            <div class="avatar-sm mx-auto mb-3">
                                                <span class="avatar-title bg-light rounded-circle fs-1">
                                                    <i class="ri-school-line text-muted"></i>
                                                </span>
                                            </div>
                                            <h5 class="text-muted">Aucune classe trouvée</h5>
                                            <p class="text-muted">Commencez par ajouter votre première classe</p>
                                            <a href="{{ route('classes.create') }}" class="btn btn-primary btn-sm">
                                                <i class="ri-add-line me-1"></i> Ajouter une classe
                                            </a>
                                        </div>
                                    @else
                                        <div class="table-responsive table-card">
                                            <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                                <tbody>
                                                    @foreach($recentClasses as $classe)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm bg-light rounded p-2 me-2">
                                                                    <i class="ri-school-line text-muted fs-5"></i>
                                                                </div>
                                                                <div>
                                                                    <h5 class="fs-14 my-1"><a href="{{ route('classes.show', $classe->id) }}" class="text-reset">{{ $classe->nom }}</a></h5>
                                                                    <span class="text-muted">{{ $classe->sites->nom ?? 'N/A' }}</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="text-muted">{{ $classe->created_at->format('d/m/Y') }}</span>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Élèves Récents</h4>
                                    <div class="flex-shrink-0">
                                        <a href="{{ route('eleves.index') }}" class="btn btn-sm btn-soft-primary">
                                            Voir tout
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @if($recentEleves->isEmpty())
                                        <div class="text-center py-4">
                                            <div class="avatar-sm mx-auto mb-3">
                                                <span class="avatar-title bg-light rounded-circle fs-1">
                                                    <i class="ri-user-3-line text-muted"></i>
                                                </span>
                                            </div>
                                            <h5 class="text-muted">Aucun élève trouvé</h5>
                                            <p class="text-muted">Commencez par ajouter votre premier élève</p>
                                            <a href="{{ route('eleves.create') }}" class="btn btn-primary btn-sm">
                                                <i class="ri-add-line me-1"></i> Ajouter un élève
                                            </a>
                                        </div>
                                    @else
                                        <div class="table-responsive table-card">
                                            <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                                <tbody>
                                                    @foreach($recentEleves as $eleve)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm bg-light rounded-circle p-2 me-2">
                                                                    <i class="ri-user-3-line text-muted fs-5"></i>
                                                                </div>
                                                                <div>
                                                                    <h5 class="fs-14 my-1"><a href="{{ route('eleves.show', $eleve->id) }}" class="text-reset">{{ $eleve->nom }} {{ $eleve->prenom }}</a></h5>
                                                                    <span class="text-muted">{{ $eleve->numParents ?? '' }}</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="text-muted">{{ $eleve->created_at->format('d/m/Y') }}</span>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Actions Rapides</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-2">
                                            <a href="{{ route('classes.create') }}" class="btn btn-outline-primary w-100 h-100 p-3">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="ri-school-line fs-2 mb-2"></i>
                                                    <span>Classe</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="{{ route('eleves.create') }}" class="btn btn-outline-success w-100 h-100 p-3">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="ri-user-add-line fs-2 mb-2"></i>
                                                    <span>Élève</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="{{ route('sites.create') }}" class="btn btn-outline-danger w-100 h-100 p-3">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="ri-map-pin-add-line fs-2 mb-2"></i>
                                                    <span>Site</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="{{ route('matieres.create') }}" class="btn btn-outline-warning w-100 h-100 p-3">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="ri-book-add-line fs-2 mb-2"></i>
                                                    <span>Matière</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="{{ route('cours.create') }}" class="btn btn-outline-secondary w-100 h-100 p-3">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="ri-video-add-line fs-2 mb-2"></i>
                                                    <span>Cours</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="{{ route('documents.create') }}" class="btn btn-outline-dark w-100 h-100 p-3">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="ri-file-add-line fs-2 mb-2"></i>
                                                    <span>Document</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

