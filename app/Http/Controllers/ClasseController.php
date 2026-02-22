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
        $classes = Classe::latest()->paginate(10);

        return view('back.classe.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.classe.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClasseRequest $request)
    {
        $data = $request->validated();

        Classe::create($data);

        return redirect()
            ->route('classe.index')
            ->with('success', 'Classe créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classe $classe)
    {
        return view('back.classe.show', compact('classe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classe $classe)
    {
        return view('back.classe.edit', compact('classe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClasseRequest $request, Classe $classe)
    {
        $data = $request->validated();

        $classe->update($data);

        return redirect()
            ->route('classe.index')
            ->with('success', 'Classe mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $classe)
    {
        $classe->delete();

        return redirect()
            ->route('classe.index')
            ->with('success', 'Classe supprimée avec succès.');
    }
}
