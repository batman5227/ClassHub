<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMatiereRequest;
use App\Http\Requests\UpdateMatiereRequest;

class MatiereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matieres = Matiere::latest()->paginate(10);

        return view('back.matiere.index', compact('matieres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.matiere.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMatiereRequest $request)
    {
        Matiere::create($request->validated());

        return redirect()
            ->route('matieres.index')
            ->with('success', 'Matière créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Matiere $matiere)
    {
        return view('back.matiere.show', compact('matiere'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matiere $matiere)
    {
        return view('back.matiere.edit', compact('matiere'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMatiereRequest $request, Matiere $matiere)
    {
        $matiere->update($request->validated());

        return redirect()
            ->route('matieres.index')
            ->with('success', 'Matière mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matiere $matiere)
    {
        $matiere->delete();

        return redirect()
            ->route('matieres.index')
            ->with('success', 'Matière supprimée avec succès.');
    }
}
