<?php

namespace App\Http\Controllers;

use App\Models\Coursdappuie;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCoursdappuieRequest;
use App\Http\Requests\UpdateCoursdappuieRequest;

class CoursdappuieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coursdappuies = Coursdappuie::latest()->paginate(10);

        return view('back.Coursdappuie.index', compact('coursdappuies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.Coursdappuie.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCoursdappuieRequest $request)
    {
        $data = $request->validated();

        Coursdappuie::create($data);

        return redirect()
            ->route('coursdappuies.index')
            ->with('success', 'Cours d’appuie ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Coursdappuie $coursdappuie)
    {
        return view('back.Coursdappuie.show', compact('coursdappuie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coursdappuie $coursdappuie)
    {
        return view('back.Coursdappuie.edit', compact('coursdappuie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCoursdappuieRequest $request, Coursdappuie $coursdappuie)
    {
        $data = $request->validated();

        $coursdappuie->update($data);

        return redirect()
            ->route('coursdappuies.index')
            ->with('success', 'Cours d’appuie modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coursdappuie $coursdappuie)
    {
        $coursdappuie->delete();

        return redirect()
            ->route('coursdappuies.index')
            ->with('success', 'Cours d’appuie supprimé avec succès.');
    }
}
