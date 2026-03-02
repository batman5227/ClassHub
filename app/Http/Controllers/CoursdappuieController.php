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

        return view('back.coursdappuie.index', compact('coursdappuies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.coursdappuie.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCoursdappuieRequest $request)
    {
        $data = $request->validated();

        Coursdappuie::create($data);

        return redirect()
            ->route('coursdappuie.index')
            ->with('success', 'Cours d\'appuie ajoute avec succes.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Coursdappuie $coursdappuie)
    {
        return view('back.coursdappuie.show', compact('coursdappuie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coursdappuie $coursdappuie)
    {
        return view('back.coursdappuie.edit', compact('coursdappuie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCoursdappuieRequest $request, Coursdappuie $coursdappuie)
    {
        $data = $request->validated();

        $coursdappuie->update($data);

        return redirect()
            ->route('coursdappuie.index')
            ->with('success', 'Cours d\'appuie modifie avec succes.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coursdappuie $coursdappuie)
    {
        $coursdappuie->delete();

        return redirect()
            ->route('coursdappuie.index')
            ->with('success', 'Cours d\'appuie supprime avec succes.');
    }
}
