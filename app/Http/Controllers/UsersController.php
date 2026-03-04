<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsersRequest;
use App\Http\Requests\UpdateUsersRequest;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        try {
            $data = $request->validated();

            // ✅ HASHER LE MOT DE PASSE
            $data['password'] = Hash::make($data['password']);

            // ✅ GESTION DE LA PHOTO DE PROFIL
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Stockage dans storage/app/public/photos/users
                $path = $file->storeAs('photos/users', $fileName, 'public');
                $data['photo'] = $path;

                Log::info('Photo uploadée avec succès', ['path' => $path]);
            }

            Users::create($data);

            return redirect()
                ->route('users.index')
                ->with('success', 'Utilisateur ajouté avec succès.');

        } catch (\Exception $e) {
            Log::error('Erreur lors de la création de l\'utilisateur', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }

    /**
     * Activer un utilisateur
     */
    public function activate(Users $user)
    {
        $user->update(['status' => 'actif']);
        return redirect()
            ->route('users.index')
            ->with('success', "L'utilisateur {$user->nom} {$user->prenom} a été activé avec succès.");
    }

    /**
     * Désactiver un utilisateur
     */
    public function deactivate(Users $user)
    {
        $user->update(['status' => 'inactif']);
        return redirect()
            ->route('users.index')
            ->with('success', "L'utilisateur {$user->nom} {$user->prenom} a été désactivé avec succès.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Users $user)
    {
        return view('back.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Users $user)
    {

        return view('back.users.updat', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsersRequest $request, Users $user)
    {
        // dd($request->all());
        try {
            $data = $request->validated();


            // ✅ GESTION DU MOT DE PASSE (optionnel en modification)
            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            // ✅ GESTION DE LA PHOTO DE PROFIL
            if ($request->hasFile('photo')) {
                // Supprimer l'ancienne photo si elle existe
                if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                    Storage::disk('public')->delete($user->photo);
                    Log::info('Ancienne photo supprimée', ['path' => $user->photo]);
                }

                // Uploader la nouvelle photo
                $file = $request->file('photo');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('photos/users', $fileName, 'public');
                $data['photo'] = $path;

                Log::info('Nouvelle photo uploadée', ['path' => $path]);
            }

            $user->update($data);

            return redirect()
                ->route('users.index')
                ->with('success', 'Utilisateur mis à jour avec succès.');

        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour de l\'utilisateur', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Users $user)
    {
        try {
            // ✅ SUPPRIMER LA PHOTO ASSOCIÉE
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
                Log::info('Photo supprimée lors de la suppression de l\'utilisateur', ['path' => $user->photo]);
            }

            $user->delete();

            return redirect()
                ->route('users.index')
                ->with('success', 'Utilisateur supprimé avec succès.');

        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression de l\'utilisateur', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->back()
                ->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }
}
