<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Matiere;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCoursRequest;
use App\Http\Requests\UpdateCoursRequest;

class CoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cours = Cours::with('matiere')->latest()->paginate(10);

        return view('back.cours.index', compact('cours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $matieres = Matiere::all();

        return view('back.cours.create', compact('matieres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCoursRequest $request)
    {
        $data = $request->validated();

        Cours::create($data);

        return redirect()
            ->route('cours.index')
            ->with('success', 'Cours ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cours $cours)
    {
        return view('back.cours.show', compact('cours'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cours $cours)
    {
        $matieres = Matiere::all();

        return view('back.cours.edit', compact('cours', 'matieres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCoursRequest $request, Cours $cours)
    {
        $data = $request->validated();

        $cours->update($data);

        return redirect()
            ->route('cours.index')
            ->with('success', 'Cours modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cours $cours)
    {
        $cours->delete();

        return redirect()
            ->route('cours.index')
            ->with('success', 'Cours supprimé avec succès.');
    }
}
