<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleUsersRequest;
use App\Http\Requests\UpdateRoleUsersRequest;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\RoleUsers;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleUsersController extends Controller
{
    /**
     * Afficher le formulaire d'affectation des rôles à un utilisateur
     */
    public function assigner($userId)
    {
        $user = Users::with('roles')->findOrFail($userId);
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();

        return view('back.roleUsers.assigner', compact('user', 'roles', 'userRoles'));
    }

    public function index()
    {
        $rolesUsers = RoleUsers::with(['user', 'role'])->paginate(10);
        return view('back.role_users.index', compact('rolesUsers'));
    }

    public function show($id)
    {
        $user = Users::with('roles')->findOrFail($id);
        return view('back.roleUsers.show', compact('user'));
    }

    /**
     * Afficher le formulaire de retrait des rôles d'un utilisateur
     */
    public function retirer($userId)
    {
        $user = Users::with('roles')->findOrFail($userId);
        return view('back.roleUsers.retirer', compact('user'));
    }

    /**
     * Affecter des rôles à un utilisateur
     */
    public function store(StoreRoleUsersRequest $request, $userId)
    {
        try {
            $user = Users::findOrFail($userId);

            // Récupérer les IDs des rôles sélectionnés
            $roleIds = $request->input('roles', []);

            // Récupérer les rôles déjà assignés
            $existingRoles = $user->roles->pluck('id')->toArray();

            // Nouveaux rôles à ajouter (ceux qui ne sont pas déjà assignés)
            $newRoles = array_diff($roleIds, $existingRoles);

            if (empty($newRoles)) {
                return redirect()
                    ->back()
                    ->with('info', 'Tous les rôles sélectionnés sont déjà assignés à cet utilisateur.');
            }

            // Ajouter les nouveaux rôles
            foreach ($newRoles as $roleId) {
                RoleUsers::create([
                    'idRole' => $roleId,
                    'idUsers' => $user->id,
                ]);
            }

            return redirect()
                ->route('users.show', $user->id)
                ->with('success', count($newRoles) . ' rôle(s) assigné(s) avec succès à ' . $user->nom . ' ' . $user->prenom);

        } catch (\Exception $e) {
            Log::error('Erreur assignation rôles:', ['error' => $e->getMessage()]);
            return redirect()
                ->back()
                ->with('error', 'Erreur lors de l\'assignation des rôles: ' . $e->getMessage());
        }
    }

    /**
     * Retirer des rôles d'un utilisateur
     */
    public function destroy(UpdateRoleUsersRequest $request, $userId)
    {
        try {
            $user = Users::findOrFail($userId);

            // Récupérer les IDs des rôles à retirer
            $roleIds = $request->input('roles', []);

            if (empty($roleIds)) {
                return redirect()
                    ->back()
                    ->with('error', 'Veuillez sélectionner au moins un rôle à retirer.');
            }

            // Supprimer les relations
            RoleUsers::where('idUsers', $user->id)
                    ->whereIn('idRole', $roleIds)
                    ->delete();

            return redirect()
                ->route('users.show', $user->id)
                ->with('success', count($roleIds) . ' rôle(s) retiré(s) avec succès à ' . $user->nom . ' ' . $user->prenom);

        } catch (\Exception $e) {
            Log::error('Erreur retrait rôles:', ['error' => $e->getMessage()]);
            return redirect()
                ->back()
                ->with('error', 'Erreur lors du retrait des rôles: ' . $e->getMessage());
        }
    }
}

