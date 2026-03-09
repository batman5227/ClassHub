<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Sites;
use App\Models\AnneeScolaire;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Classe::with(['site', 'groupes', 'anneeScolaire']);

        // Filtre par année scolaire depuis la query string
        if ($request->has('idAnneeScolaire') && !empty($request->idAnneeScolaire)) {
            $query->where('idAnneeScolaire', $request->idAnneeScolaire);
        }

        $classes = $query->paginate(12);
        $anneesScolaires = AnneeScolaire::orderBy('date_debut', 'desc')->get();

        return view('back.classe.index', compact('classes', 'anneesScolaires'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sites = Sites::all();
        $anneesScolaires = AnneeScolaire::orderBy('date_debut', 'desc')->get();
        $anneeActive = AnneeScolaire::where('is_active', true)->first();

        return view('back.classe.create', compact('sites', 'anneesScolaires', 'anneeActive'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'idSites' => 'nullable|exists:sites,id',
            'idAnneeScolaire' => 'required|exists:annee_scolaires,id',
        ]);

        Classe::create($validated);

        return redirect()
            ->route('classes.index')
            ->with('success', 'Classe créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classe $classe)
    {
        $classe->load(['site', 'groupes', 'anneeScolaire']);
        return view('back.classe.show', compact('classe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classe $classe)
    {
        $sites = Sites::all();
        $anneesScolaires = AnneeScolaire::orderBy('date_debut', 'desc')->get();

        return view('back.classe.updat', compact('classe', 'sites', 'anneesScolaires'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classe $classe)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'idSites' => 'nullable|exists:sites,id',
            'idAnneeScolaire' => 'required|exists:annee_scolaires,id',
        ]);

        $classe->update($validated);

        return redirect()
            ->route('classes.index')
            ->with('success', 'Classe mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $classe)
    {
        // Vérifier si la classe a des groupes
        if ($classe->groupes()->count() > 0) {
            return redirect()
                ->route('classes.index')
                ->with('error', 'Impossible de supprimer cette classe car elle contient des groupes.');
        }

        $classe->delete();

        return redirect()
            ->route('classes.index')
            ->with('success', 'Classe supprimée avec succès.');
    }

    /**
     * Filter classes by academic year.
     */
    public function filterByAnnee($idAnneeScolaire)
    {
        $classes = Classe::with(['site', 'groupes', 'anneeScolaire'])
            ->where('idAnneeScolaire', $idAnneeScolaire)
            ->paginate(12);

        $anneesScolaires = AnneeScolaire::orderBy('date_debut', 'desc')->get();
        $anneeSelectionnee = AnneeScolaire::find($idAnneeScolaire);

        return view('back.classe.index', compact('classes', 'anneesScolaires', 'anneeSelectionnee'));
    }
}
