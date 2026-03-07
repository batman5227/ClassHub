<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Matiere;
use App\Http\Requests\StoreCoursRequest;
use App\Http\Requests\UpdateCoursRequest;
use Illuminate\Http\Request;

class CoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cours = Cours::with('matiere')->paginate(10);
        return view('back.cours.index', compact('cours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $matieres = Matiere::with('classe')->get();
        return view('back.cours.create', compact('matieres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCoursRequest $request)
    {
        try {
            Cours::create([
                'nom' => $request->nom,
                'idMatiere' => $request->idMatiere,
            ]);

            return redirect()
                ->route('cours.index')
                ->with('success', 'Cours créé avec succès !');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la création du cours.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cours $cour)
    {
        $cour->load('matiere.classe');
        return view('back.cours.show', compact('cour'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cours $cour)
    {
        $matieres = Matiere::with('classe')->get();
        return view('back.cours.updat', compact('cour', 'matieres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCoursRequest $request, Cours $cour)
    {
        try {
            $cour->update([
                'nom' => $request->nom,
                'idMatiere' => $request->idMatiere,
            ]);

            return redirect()
                ->route('cours.index')
                ->with('success', 'Cours mis à jour avec succès !');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la mise à jour du cours.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cours $cour)
    {
        try {
            $cour->delete();
            return redirect()
                ->route('cours.index')
                ->with('success', 'Cours supprimé avec succès !');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Une erreur est survenue lors de la suppression du cours.');
        }
    }
}
