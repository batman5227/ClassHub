@extends('layouts.master')

@section('title')
    Notifications - ClassHub
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Notifications</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Notifications</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-gradient border-bottom">
                    <div class="d-flex align-items-center">
                        <i class="ri-notification-3-line me-2 fs-4 text-white"></i>
                        <h5 class="card-title mb-0 text-white">Liste des Notifications</h5>
                    </div>
                </div>
                <div class="card-body">
                    @if($notifications->isEmpty())
                    <div class="empty-state">
                        <i class="ri-notification-3-line"></i>
                        <h5>Aucune notification</h5>
                    </div>
                    @else
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-uppercase fw-bold">Titre</th>
                                    <th class="text-uppercase fw-bold">Message</th>
                                    <th class="text-uppercase fw-bold">Date</th>
                                    <th class="text-uppercase fw-bold text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($notifications as $notif)
                                <tr>
                                    <td><span class="fw-semibold">{{ $notif->titre }}</span></td>
                                    <td>{{ Str::limit($notif->message, 50) }}</td>
                                    <td><span class="text-muted">{{ $notif->created_at->format('d/m/Y') }}</span></td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{ route('notifications.show', $notif->id) }}" class="action-btn action-btn-view"><i class="ri-eye-line"></i></a>
                                            <button type="button" class="action-btn action-btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $notif->id }}"><i class="ri-delete-bin-line"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="deleteModal{{ $notif->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header"><h5 class="modal-title">Confirmation</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                            <div class="modal-body text-center py-4">
                                                <i class="ri-error-warning-line text-danger" style="font-size: 4rem;"></i>
                                                <p class="mt-3">Supprimer cette notification?</p>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                                                <form action="{{ route('notifications.destroy', $notif->id) }}" method="POST">@csrf @method('DELETE')<button type="submit" class="btn btn-danger">Supprimer</button></form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $notifications->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
