<?php

namespace App\Http\Controllers;

use App\Models\Groupe;
use App\Models\Classe;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupeRequest;
use App\Http\Requests\UpdateGroupeRequest;

class GroupeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groupes = Groupe::with('classe')->latest()->paginate(10);

        return view('back.groupes.index', compact('groupes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classe::all();

        return view('back.groupes.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGroupeRequest $request)
    {
        Groupe::create($request->validated());

        return redirect()
            ->route('groupes.index')
            ->with('success', 'Groupe créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Groupe $groupe)
    {
        return view('back.groupes.show', compact('groupe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Groupe $groupe)
    {
        $classes = Classe::all();

        return view('back.groupes.edit', compact('groupe', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGroupeRequest $request, Groupe $groupe)
    {
        $groupe->update($request->validated());

        return redirect()
            ->route('groupes.index')
            ->with('success', 'Groupe mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Groupe $groupe)
    {
        $groupe->delete();

        return redirect()
            ->route('groupes.index')
            ->with('success', 'Groupe supprimé avec succès.');
    }
}
