<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsersCoursappuieSiteClasseRequest;
use App\Http\Requests\UpdateUsersCoursappuieSiteClasseRequest;
use App\Models\Classe;
use App\Models\Coursdappuie;
use App\Models\Sites;
use App\Models\Users;
use App\Models\UsersCoursappuieSiteClasse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class UsersCoursappuieSiteClasseController extends Controller
{
    /**
     * Afficher la liste des affectations
     */
    public function index()
    {
        $affectations = UsersCoursappuieSiteClasse::with(['user', 'site', 'coursAppuie', 'classe'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('back.usersSitesCoursClasses.index', compact('affectations'));
    }

    /**
     * Afficher le formulaire d'affectation
     */
    public function create()
    {
        $users = Users::all();
        $sites = Sites::all();
        $coursAppuies = Coursdappuie::all();
        $classes = Classe::all();

        return view('back.usersSitesCoursClasses.create', compact('users', 'sites', 'coursAppuies', 'classes'));
    }

    /**
     * Afficher le formulaire d'affectation pour un utilisateur spécifique
     */
    public function assigner($userId)
    {
        $user = Users::with('coursAppuieAffectations')->findOrFail($userId);
        $sites = Sites::all();
        $coursAppuies = Coursdappuie::all();
        $classes = Classe::all();

        // Récupérer les affectations existantes
        $affectations = UsersCoursappuieSiteClasse::where('userId', $userId)
            ->with(['site', 'coursAppuie', 'classe'])
            ->get();

        return view('back.usersSitesCoursClasses.assigner', compact('user', 'sites', 'coursAppuies', 'classes', 'affectations'));
    }

    /**
     * Afficher le formulaire de retrait pour un utilisateur spécifique
     */
    public function retirer($userId)
    {
        $user = Users::findOrFail($userId);
        $affectations = UsersCoursappuieSiteClasse::where('userId', $userId)
            ->with(['site', 'coursAppuie', 'classe'])
            ->get();

        return view('back.usersSitesCoursClasses.retirer', compact('user', 'affectations'));
    }

    /**
     * Stocker une nouvelle affectation
     */
    public function store(StoreUsersCoursappuieSiteClasseRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();

            // Vérifier si l'affectation existe déjà
            $existing = UsersCoursappuieSiteClasse::where([
                'userId' => $data['userId'],
                'siteId' => $data['siteId'],
                'coursAppuieId' => $data['coursAppuieId'],
                'classeId' => $data['classeId'],
            ])->first();

            if ($existing) {
                return redirect()
                    ->back()
                    ->with('error', 'Cette affectation existe déjà.')
                    ->withInput();
            }

            $affectation = UsersCoursappuieSiteClasse::create($data);

            DB::commit();

            return redirect()
                ->route('users-coursappuie-site-classes.index')
                ->with('success', 'Affectation créée avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur création affectation:', ['error' => $e->getMessage()]);

            return redirect()
                ->back()
                ->with('error', 'Erreur lors de la création: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Afficher les détails d'une affectation
     */
    public function show(UsersCoursappuieSiteClasse $usersCoursappuieSiteClasse)
    {
        $affectation = $usersCoursappuieSiteClasse->load(['user', 'site', 'coursAppuie', 'classe']);

        return view('back.usersSitesCoursClasses.show', compact('affectation'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(UsersCoursappuieSiteClasse $usersCoursappuieSiteClasse)
    {
        $users = Users::all();
        $sites = Sites::all();
        $coursAppuies = Coursdappuie::all();
        $classes = Classe::all();

        return view('back.usersSitesCoursClasses.updat', compact('usersCoursappuieSiteClasse', 'users', 'sites', 'coursAppuies', 'classes'));
    }

    /**
     * Mettre à jour une affectation
     */
    public function update(UpdateUsersCoursappuieSiteClasseRequest $request, UsersCoursappuieSiteClasse $usersCoursappuieSiteClasse)
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();
            $usersCoursappuieSiteClasse->update($data);

            DB::commit();

            return redirect()
                ->route('users-coursappuie-site-classes.index')
                ->with('success', 'Affectation mise à jour avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur mise à jour affectation:', ['error' => $e->getMessage()]);

            return redirect()
                ->back()
                ->with('error', 'Erreur lors de la mise à jour: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Supprimer une affectation
     */
    public function destroy(UsersCoursappuieSiteClasse $usersCoursappuieSiteClasse)
    {
        try {
            DB::beginTransaction();

            $usersCoursappuieSiteClasse->delete();

            DB::commit();

            return redirect()
                ->route('users-coursappuie-site-classes.index')
                ->with('success', 'Affectation supprimée avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur suppression affectation:', ['error' => $e->getMessage()]);

            return redirect()
                ->back()
                ->with('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }

    /**
     * Retirer plusieurs affectations
     */
    public function retirerMultiple(Request $request, $userId)
    {
        try {
            DB::beginTransaction();

            $affectationIds = $request->input('affectations', []);

            if (empty($affectationIds)) {
                return redirect()
                    ->back()
                    ->with('error', 'Veuillez sélectionner au moins une affectation à retirer.');
            }

            UsersCoursappuieSiteClasse::whereIn('id', $affectationIds)->delete();

            DB::commit();

            return redirect()
                ->route('users.show', $userId)
                ->with('success', count($affectationIds) . ' affectation(s) retirée(s) avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur retrait multiple:', ['error' => $e->getMessage()]);

            return redirect()
                ->back()
                ->with('error', 'Erreur lors du retrait: ' . $e->getMessage());
        }
    }
}
