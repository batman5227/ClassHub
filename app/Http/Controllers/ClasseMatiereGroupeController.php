<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Matiere;
use App\Models\Groupe;
use App\Models\ClasseMatiereGroupe;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClasseMatiereGroupeRequest;
use App\Http\Requests\UpdateClasseMatiereGroupeRequest;

class ClasseMatiereGroupeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classeMatiereGroupes = ClasseMatiereGroupe::with(['classe', 'matiere', 'groupe'])
                    ->latest()
                    ->paginate(10);

        return view('back.classe-Matiere-Groupe.index', compact('classeMatiereGroupes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classe::all();
        $matieres = Matiere::all();
        $groupes = Groupe::all();

        return view('back.classe-Matiere-Groupe.create', compact('classes', 'matieres', 'groupes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClasseMatiereGroupeRequest $request)
{
    // Si vous avez utilisé la préparation dans la Request
    $data = $request->validated(); // Contiendra idClasse, idMatiere, idGroupe

    // OU si vous voulez garder les noms du formulaire
    $data = [
        'idClasse' => $request->classe_id,
        'idMatiere' => $request->matiere_id,
        'idGroupe' => $request->groupe_id,
    ];

    ClasseMatiereGroupe::create($data);

    return redirect()
        ->route('classe-matiere-groupe.index')
        ->with('success', 'Association créée avec succès.');
}

    /**
     * Display the specified resource.
     */
    public function show(ClasseMatiereGroupe $classeMatiereGroupe)
    {
        return view('back.classe-Matiere-Groupe.show', compact('classeMatiereGroupe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClasseMatiereGroupe $classeMatiereGroupe)
    {
        $classes = Classe::all();
        $matieres = Matiere::all();
        $groupes = Groupe::all();

        return view(
            'back.classe-Matiere-Groupe.edit',
            compact('classeMatiereGroupe', 'classes', 'matieres', 'groupes')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateClasseMatiereGroupeRequest $request,
        ClasseMatiereGroupe $classeMatiereGroupe
    ) {
        $data = $request->validated();

        $classeMatiereGroupe->update($data);

        return redirect()
            ->route('classe-matiere-groupe.index')
            ->with('success', 'Association mise à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClasseMatiereGroupe $classeMatiereGroupe)
    {
        $classeMatiereGroupe->delete();

        return redirect()
            ->route('classe-matiere-groupe.index')
            ->with('success', 'Association supprimée.');
    }
}
