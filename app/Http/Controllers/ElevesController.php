<?php

namespace App\Http\Controllers;

use App\Models\eleves;
use App\Models\Classe;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreelevesRequest;
use App\Http\Requests\UpdateelevesRequest;

class ElevesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eleves = eleves::with('classe')->latest()->paginate(10);
        return view('back.eleves.index', compact('eleves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classe::all();
        return view('back.eleves.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreelevesRequest $request)
    {
        $data = $request->validated();
        eleves::create($data);

        return redirect()
            ->route('eleves.index')
            ->with('success', 'Élève ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(eleves $eleves)
    {
        $eleves->load('classe');
        return view('back.eleves.show', compact('eleves'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(eleves $eleves)
    {
        $classes = Classe::all();
        return view('back.eleves.edit', compact('eleves', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateelevesRequest $request, eleves $eleves)
    {
        $data = $request->validated();
        $eleves->update($data);

        return redirect()
            ->route('eleves.index')
            ->with('success', 'Élève mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(eleves $eleves)
    {
        $eleves->delete();

        return redirect()
            ->route('eleves.index')
            ->with('success', 'Élève supprimé avec succès.');
    }

    /**
     * Display eleves filtered by class.
     */
    public function byClass($idClasse)
    {
        $eleves = eleves::with('classe')->where('idClasse', $idClasse)->get();
        return view('back.eleves.index', compact('eleves'));
    }
}
