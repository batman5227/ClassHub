<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Sites;
use App\Models\Matiere;
use App\Models\Groupe;
use App\Models\ClasseMatiereGroupe;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClasseRequest;
use App\Http\Requests\UpdateClasseRequest;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classe::with('sites', 'classeMatiereGroupes.matiere', 'classeMatiereGroupes.groupe')
                        ->paginate(10);
        return view('back.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sites = Sites::all();
        return view('back.classes.create', compact('sites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClasseRequest $request)
    {
        $data = $request->validated();
        Classe::create($data);

        return redirect()->route('classes.index')
                         ->with('success', 'Classe ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classe $classe)
    {
        $classe->load('sites', 'classeMatiereGroupes.matiere', 'classeMatiereGroupes.groupe');
        return view('back.classes.show', compact('classe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classe $classe)
    {
        $sites = Sites::all();
        return view('back.classes.edit', compact('classe', 'sites'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClasseRequest $request, Classe $classe)
    {
        $data = $request->validated();
        $classe->update($data);

        return redirect()->route('classes.index')
                         ->with('success', 'Classe mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $classe)
    {
        $classe->delete();

        return redirect()->route('classes.index')
                         ->with('success', 'Classe supprimée avec succès.');
    }

    /**
     * Display classes filtered by site.
     */
    public function bySite($idSites)
    {
        $classes = Classe::with('sites', 'classeMatiereGroupes.matiere', 'classeMatiereGroupes.groupe')
                        ->where('idSites', $idSites)
                        ->paginate(10);
        return view('back.classes.index', compact('classes'));
    }

    /**
     * Show the form for managing matiere and groupe for a classe.
     */
    public function manageMatieresGroupes(Classe $classe)
    {
        $classe->load('classeMatiereGroupes.matiere', 'classeMatiereGroupes.groupe');
        $matieres = Matiere::all();
        $groupes = Groupe::all();

        return view('back.classes.manage-matieres-groupes', compact('classe', 'matieres', 'groupes'));
    }

    /**
     * Store a matiere-groupe association for a classe.
     */
    public function storeMatieresGroupes(Request $request, Classe $classe)
    {
        $request->validate([
            'idMatiere' => 'required|uuid|exists:matieres,id',
            'idGroupe' => 'required|uuid|exists:groupes,id',
        ]);

        // Check if association already exists
        $exists = ClasseMatiereGroupe::where('idClasse', $classe->id)
            ->where('idMatiere', $request->idMatiere)
            ->where('idGroupe', $request->idGroupe)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Cette association existe déjà.');
        }

        ClasseMatiereGroupe::create([
            'idClasse' => $classe->id,
            'idMatiere' => $request->idMatiere,
            'idGroupe' => $request->idGroupe,
        ]);

        return redirect()->route('classes.show', $classe->id)
                         ->with('success', 'Matière et groupe ajoutés avec succès.');
    }

    /**
     * Remove a matiere-groupe association from a classe.
     */
    public function destroyMatieresGroupes(Classe $classe, ClasseMatiereGroupe $classeMatiereGroupe)
    {
        if ($classeMatiereGroupe->idClasse !== $classe->id) {
            return redirect()->back()->with('error', 'Association non trouvée.');
        }

        $classeMatiereGroupe->delete();

        return redirect()->route('classes.show', $classe->id)
                         ->with('success', 'Association supprimée avec succès.');
    }

    /**
     * Get matieres for a specific classe.
     */
    public function matieres(Classe $classe)
    {
        $matieres = $classe->classeMatiereGroupes()
            ->with('matiere')
            ->get()
            ->pluck('matiere')
            ->unique('id')
            ->values();

        return response()->json($matieres);
    }

    /**
     * Get groupes for a specific classe.
     */
    public function groupes(Classe $classe)
    {
        $groupes = $classe->classeMatiereGroupes()
            ->with('groupe')
            ->get()
            ->pluck('groupe')
            ->unique('id')
            ->values();

        return response()->json($groupes);
    }
}
