<?php

namespace App\Http\Controllers;

use App\Models\permissions;
use App\Http\Requests\StorepermissionsRequest;
use App\Http\Requests\UpdatepermissionsRequest;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $permissions = permissions::all();
        return view('back.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('back.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepermissionsRequest $request)
    {
        //
        $data = $request->validated();
        $nom = strtolower($data['nom']);
        $nom = str_replace(' ', '_', $nom);

        permissions::create(['nom' => $nom, 'description' => $data['description']]);
        return redirect()
            ->route('permissions.index')
            ->with('success', 'Permission créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(permissions $permission)
    {
        //
        return view('back.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(permissions $permission)
    {
        //
        return view('back.permissions.updat', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepermissionsRequest $request, permissions $permission)
    {
        //
        $data = $request->validated();
        $nom = strtolower($data['nom']);
        $nom = str_replace(' ', '_', $nom);
        $permission->update(['nom' => $nom, 'description' => $data['description']]);
        return redirect()
            ->route('permissions.index')
            ->with('success', 'Permission mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(permissions $permission)
    {
        //
        $permission->delete();
        return redirect()
            ->route('permissions.index')
            ->with('success', 'Permission supprimée avec succès.');
    }
}
