<?php

namespace App\Http\Controllers;

use App\Models\eleves;
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
        $eleves = eleves::latest()->paginate(10);
        return view('back.eleves.index', compact('eleves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.eleves.create');
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
    public function show(eleves $elefe)
    {
        return view('back.eleves.show', compact('elefe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(eleves $elefe)
    {
        return view('back.eleves.edit', compact('elefe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateelevesRequest $request, eleves $elefe)
    {
        $data = $request->validated();
        $elefe->update($data);

        return redirect()
            ->route('eleves.index')
            ->with('success', 'Élève mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(eleves $elefe)
    {
        $elefe->delete();

        return redirect()
            ->route('eleves.index')
            ->with('success', 'Élève supprimé avec succès.');
    }
}

