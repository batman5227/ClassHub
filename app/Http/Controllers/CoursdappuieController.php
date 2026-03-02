<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCoursdappuieRequest;
use App\Http\Requests\UpdateCoursdappuieRequest;
use App\Models\Coursdappuie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CoursdappuieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coursdappuies = Coursdappuie::latest()->paginate(10);

        return view('back.CoursDappuie.index', compact('coursdappuies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.CoursDappuie.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(StoreCoursdappuieRequest $request)
    {
        try {
            $data = $request->validated();

            // Gestion de l'upload du logo
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Stockage dans le dossier public/storage/logos/coursdappuie
                $path = $file->storeAs('logos/coursdappuie', $fileName, 'public');
                $data['logo'] = $path;

                Log::info('Logo uploadé avec succès', ['path' => $path]);
            }

            Coursdappuie::create($data);

            return redirect()
                ->route('coursdappuies.index')
                ->with('success', 'Cours d’appui ajouté avec succès.');

        } catch (\Exception $e) {
            Log::error('Erreur lors de la création du cours d\'appui', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la création : ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Coursdappuie $coursdappuie)
    {
        return view('back.CoursDappuie.show', compact('coursdappuie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coursdappuie $coursdappuie)
    {
        return view('back.CoursDappuie.updat', compact('coursdappuie'));
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(UpdateCoursdappuieRequest $request, Coursdappuie $coursdappuie)
    {
        try {
            $data = $request->validated();

            // Gestion de l'upload du nouveau logo
            if ($request->hasFile('logo')) {
                // Supprimer l'ancien logo s'il existe
                if ($coursdappuie->logo && Storage::disk('public')->exists($coursdappuie->logo)) {
                    Storage::disk('public')->delete($coursdappuie->logo);
                    Log::info('Ancien logo supprimé', ['path' => $coursdappuie->logo]);
                }

                // Uploader le nouveau logo
                $file = $request->file('logo');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('logos/coursdappuie', $fileName, 'public');
                $data['logo'] = $path;

                Log::info('Nouveau logo uploadé', ['path' => $path]);
            }

            $coursdappuie->update($data);

            return redirect()
                ->route('coursdappuies.index')
                ->with('success', 'Cours d’appui modifié avec succès.');

        } catch (\Exception $e) {
            Log::error('Erreur lors de la modification du cours d\'appui', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la modification : ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Coursdappuie $coursdappuie)
    {
        try {
            // Supprimer le logo associé s'il existe
            if ($coursdappuie->logo && Storage::disk('public')->exists($coursdappuie->logo)) {
                Storage::disk('public')->delete($coursdappuie->logo);
                Log::info('Logo supprimé lors de la suppression du cours', ['path' => $coursdappuie->logo]);
            }

            $coursdappuie->delete();

            return redirect()
                ->route('coursdappuies.index')
                ->with('success', 'Cours d’appui supprimé avec succès.');

        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression du cours d\'appui', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->back()
                ->with('error', 'Une erreur est survenue lors de la suppression : ' . $e->getMessage());
        }
    }
}
