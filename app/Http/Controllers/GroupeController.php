<?php

namespace App\Http\Controllers;

use App\Models\Groupe;
use App\Models\Classe;
use App\Http\Requests\StoreGroupeRequest;
use App\Http\Requests\UpdateGroupeRequest;
use Illuminate\Support\Facades\Log;

class GroupeController extends Controller
{
    public function index()
    {
        $groupes = Groupe::with('classe')->latest()->paginate(10);
        return view('back.groupes.index', compact('groupes'));
    }

    public function create()
    {
        $classes = Classe::all();
        return view('back.groupes.create', compact('classes'));
    }

    public function store(StoreGroupeRequest $request)
    {
        try {
            $data = $request->validated();
            Groupe::create($data);

            return redirect()
                ->route('groupes.index')
                ->with('success', 'Groupe créé avec succès.');

        } catch (\Exception $e) {
            Log::error('Erreur création groupe:', ['error' => $e->getMessage()]);
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erreur lors de la création : ' . $e->getMessage());
        }
    }

    public function show(Groupe $groupe)
    {
        return view('back.groupes.show', compact('groupe'));
    }

    public function edit(Groupe $groupe)
    {
        $classes = Classe::all();
        return view('back.groupes.edit', compact('groupe', 'classes'));
    }

    public function update(UpdateGroupeRequest $request, Groupe $groupe)
    {
        try {
            $data = $request->validated();
            $groupe->update($data);

            return redirect()
                ->route('groupes.index')
                ->with('success', 'Groupe mis à jour avec succès.');

        } catch (\Exception $e) {
            Log::error('Erreur mise à jour groupe:', ['error' => $e->getMessage()]);
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }

    public function destroy(Groupe $groupe)
    {
        try {
            $groupe->delete();

            return redirect()
                ->route('groupes.index')
                ->with('success', 'Groupe supprimé avec succès.');

        } catch (\Exception $e) {
            Log::error('Erreur suppression groupe:', ['error' => $e->getMessage()]);
            return redirect()
                ->back()
                ->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }
}

