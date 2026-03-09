<?php

namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
use App\Http\Requests\StoreAnneeScolaireRequest;
use App\Http\Requests\UpdateAnneeScolaireRequest;
use Illuminate\Http\Request;

class AnneeScolaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anneesScolaires = AnneeScolaire::orderBy('date_debut', 'desc')->paginate(10);
        return view('back.AnneeScolaire.index', compact('anneesScolaires'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.AnneeScolaire.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnneeScolaireRequest $request)
    {
        $data = $request->validated();

        // Si cette année est marquée comme active, désactiver les autres
        if (isset($data['is_active']) && $data['is_active']) {
            AnneeScolaire::where('is_active', true)->update(['is_active' => false]);
        }

        AnneeScolaire::create($data);

        return redirect()
            ->route('annees-scolaires.index')
            ->with('success', 'Année scolaire créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
   public function show(AnneeScolaire $annees_scolaire)
{
    // Charger les relations qui existent réellement
    $annees_scolaire->load(['classes']);
    
    // Optionnel : compter les élèves via les classes
    $totalEleves = $annees_scolaire->classes->sum(function($classe) {
        return $classe->eleves()->count();
    });
    $anneeScolaire = $annees_scolaire; // Renommer pour la vue
    
    return view('back.AnneeScolaire.show', compact('anneeScolaire', 'totalEleves'));
}
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnneeScolaire $annees_scolaire)
    {
        $anneeScolaire = $annees_scolaire; // Renommer pour la vue
        return view('back.AnneeScolaire.edit', compact('anneeScolaire'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnneeScolaireRequest $request, AnneeScolaire $anneeScolaire)
    {
        $data = $request->validated();

        // Si cette année est marquée comme active, désactiver les autres
        if (isset($data['is_active']) && $data['is_active']) {
            AnneeScolaire::where('is_active', true)
                ->where('id', '!=', $anneeScolaire->id)
                ->update(['is_active' => false]);
        }

        $anneeScolaire->update($data);

        return redirect()
            ->route('annees-scolaires.index')
            ->with('success', 'Année scolaire mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnneeScolaire $anneeScolaire)
    {
        // Vérifier si l'année a des classes associées
        if ($anneeScolaire->classes()->count() > 0) {
            return redirect()
                ->route('annees-scolaires.index')
                ->with('error', 'Impossible de supprimer cette année car elle contient des classes.');
        }

        $anneeScolaire->delete();

        return redirect()
            ->route('annees-scolaires.index')
            ->with('success', 'Année scolaire supprimée avec succès.');
    }

    /**
     * Set the specified year as active.
     */
    public function setActive(AnneeScolaire $anneeScolaire)
    {
        // Désactiver toutes les années
        AnneeScolaire::where('is_active', true)->update(['is_active' => false]);

        // Activer l'année sélectionnée
        $anneeScolaire->update(['is_active' => true]);

        return redirect()
            ->route('annees-scolaires.index')
            ->with('success', "L'année {$anneeScolaire->annee} est maintenant l'année active.");
    }
}
