@extends('layouts.master')

@section('title')
    Documents - ClassHub
@endsection

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Liste des Documents</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Documents</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Liste des Documents</h5>
                    <a href="{{ route('documents.create') }}" class="btn btn-primary">
                        <i class="ri-add-line align-bottom"></i> Ajouter un document
                    </a>
                </div>
                <div class="card-body">
                    @if($documents->isEmpty())
                    <div class="empty-state">
                        <i class="ri-file-text-line"></i>
                        <h5>Aucun document trouvé</h5>
                        <p>Commencez par ajouter votre premier document</p>
                        <a href="{{ route('documents.create') }}" class="btn btn-primary mt-3">
                            <i class="ri-add-line me-1"></i>Ajouter un document
                        </a>
                    </div>
                    @else
                    <table id="documents-table" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Matière</th>
                                <th>Date de création</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($documents as $document)
                            <tr>
                                <td>{{ $document->nom }}</td>
                                <td>{{ $document->matiere ? $document->matiere->nom : 'N/A' }}</td>
                                <td>{{ $document->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="{{ route('documents.show', $document) }}" class="action-btn action-btn-view">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                        <a href="{{ route('documents.edit', $document) }}" class="action-btn action-btn-edit">
                                            <i class="ri-edit-line"></i>
                                        </a>
                                        <button type="button" class="action-btn action-btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $document->id }}">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade" id="deleteModal{{ $document->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirmation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center py-4">
                                            <i class="ri-error-warning-line text-danger" style="font-size: 4rem;"></i>
                                            <p class="mt-3">Supprimer le document <strong>{{ $document->nom }}</strong>?</p>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                                            <form action="{{ route('documents.destroy', $document) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $documents->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
