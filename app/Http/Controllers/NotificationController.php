<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::latest()->paginate(10);

        return view('back.notification.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.notification.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotificationRequest $request)
    {
        Notification::create($request->validated());

        return redirect()
            ->route('notifications.index')
            ->with('success', 'Notification créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        return view('back.notification.show', compact('notification'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification)
    {
        return view('back.notification.edit', compact('notification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotificationRequest $request, Notification $notification)
    {
        $notification->update($request->validated());

        return redirect()
            ->route('notifications.index')
            ->with('success', 'Notification mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        $notification->delete();

        return redirect()
            ->route('notifications.index')
            ->with('success', 'Notification supprimée avec succès.');
    }
}
