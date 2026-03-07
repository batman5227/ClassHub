<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\permissions;
use App\Models\Role;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();

        return view('back.role.index', compact('roles'));
    }
  public function affecter($id)
{
    $role = Role::with('permissions')->findOrFail($id);

    // ✅ Récupérer toutes les permissions
    $permissions = permissions::all();

    // ✅ DEBUG : Afficher les IDs dans les logs
    Log::info('IDs des permissions:', $permissions->pluck('id')->toArray());

    // ✅ Vérifier le type des IDs
    foreach ($permissions as $p) {
        Log::info("Permission {$p->nom}: ID = {$p->id}, Type = " . gettype($p->id));
    }

    $rolePermissions = $role->permissions->pluck('id')->toArray();

    return view('back.role.affecter', compact('role', 'permissions', 'rolePermissions'));
}
    public function retirer($id)
    {
        $role = Role::where('id', $id)->with('permissions')->first();
        $permissions = $role->permissions;

        return view('back.role.retirer', compact('role', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('back.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $data = $request->validated();
        $nom = strtolower($data['nom']);
        $nom = str_replace(' ', '_', $nom);

        Role::create(['nom' => $nom,'description' => $data['description']]);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Rôle créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('back.role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('back.role.updat', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $data = $request->validated();

        $role->update($data);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Rôle mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()
            ->route('roles.index')
            ->with('success', 'Rôle supprimé avec succès.');
    }
}
