<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClasseRequest;
use App\Http\Requests\UpdateClasseRequest;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classe::with('sites')->get();
        return view('back.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.classes.create');
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
        return view('back.classes.edit', compact('classe'));
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
        $classes = Classe::with('sites')->where('idSites', $idSites)->get();
        return view('back.classes.index', compact('classes'));
    }
}
