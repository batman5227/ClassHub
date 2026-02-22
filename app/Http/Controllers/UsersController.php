<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsersRequest;
use App\Http\Requests\UpdateUsersRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Users::all();
        return view('back.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsersRequest $request)
    {
        $data = $request->validated();
        Users::create($data);

        return redirect()->route('users.index')
                         ->with('success', 'Utilisateur ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Users $users)
    {
        return view('back.users.show', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Users $users)
    {
        return view('back.users.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsersRequest $request, Users $users)
    {
        $data = $request->validated();
        $users->update($data);

        return redirect()->route('users.index')
                         ->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Users $users)
    {
        $users->delete();

        return redirect()->route('users.index')
                         ->with('success', 'Utilisateur supprimé avec succès.');
    }
}
