<?php

namespace App\Http\Controllers;

use App\Models\RoleUsers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleUsersRequest;
use App\Http\Requests\UpdateRoleUsersRequest;

class RoleUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rolesUsers = RoleUsers::with(['user', 'role'])->paginate(10);
        return view('back.role_users.index', compact('rolesUsers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = \App\Models\Users::all();
        $roles = \App\Models\Role::all();

        return view('back.role_users.create', compact('users', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleUsersRequest $request)
    {
        $data = $request->validated();
        RoleUsers::create($data);

        return redirect()->route('role-users.index')
                         ->with('success', 'Role utilisateur ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RoleUsers $roleUsers)
    {
        $roleUsers->load(['user', 'role']);
        return view('back.role_users.show', compact('roleUsers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoleUsers $roleUsers)
    {
        $users = \App\Models\Users::all();
        $roles = \App\Models\Role::all();

        return view('back.role_users.edit', compact('roleUsers', 'users', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleUsersRequest $request, RoleUsers $roleUsers)
    {
        $data = $request->validated();
        $roleUsers->update($data);

        return redirect()->route('role-users.index')
                         ->with('success', 'Role utilisateur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoleUsers $roleUsers)
    {
        $roleUsers->delete();

        return redirect()->route('role-users.index')
                         ->with('success', 'Role utilisateur supprimé avec succès.');
    }
}
