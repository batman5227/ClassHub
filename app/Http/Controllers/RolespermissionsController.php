<?php

namespace App\Http\Controllers;

use App\Http\Requests\AffecterPermissionsRequest;
use App\Http\Requests\StorerolespermissionsRequest;
use App\Http\Requests\UpdaterolespermissionsRequest;
use App\Models\Role;
use App\Models\rolespermissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RolespermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

public function store(AffecterPermissionsRequest $request, $roleId)
{
    // ✅ DEBUG : Voir ce qui est reçu
    Log::info('Store permissions - Role ID reçu:', ['roleId' => $roleId]);
    Log::info('Permissions reçues:', $request->input('permissions', []));

    try {
        // ✅ Vérifier que le rôle existe
        $role = Role::findOrFail($roleId);

        // Récupérer les IDs des permissions sélectionnées
        $permissionIds = $request->input('permissions', []);

        // ✅ Filtrer pour garder seulement les UUIDs valides
        $validPermissionIds = array_filter($permissionIds, function($id) {
            return preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i', $id);
        });

        // ✅ Synchroniser les permissions
        $role->permissions()->sync($validPermissionIds);

        return redirect()
            ->route('roles.index')
            ->with('success', count($validPermissionIds) . ' permission(s) affectée(s) avec succès.');

    } catch (\Exception $e) {
        Log::error('Erreur store permissions:', ['error' => $e->getMessage()]);
        return redirect()
            ->back()
            ->with('error', 'Erreur: ' . $e->getMessage());
    }
}

    /**
     * Display the specified resource.
     */
    public function show(rolespermissions $rolespermissions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rolespermissions $rolespermissions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdaterolespermissionsRequest $request, rolespermissions $rolespermissions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */


  public function destroy(Request $request, $roleId)
{
    try {
        $role = Role::findOrFail($roleId);
        $permissionIds = $request->input('permissions', []);

        if (empty($permissionIds)) {
            return redirect()->back()->with('error', 'Veuillez sélectionner au moins une permission à retirer.');
        }

        $role->permissions()->detach($permissionIds);

        return redirect()
            ->route('roles.index')
            ->with('success', count($permissionIds) . ' permission(s) retirée(s) avec succès.');

    } catch (\Exception $e) {
        Log::error('Erreur retrait permissions:', ['error' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Erreur: ' . $e->getMessage());
    }
}
}
