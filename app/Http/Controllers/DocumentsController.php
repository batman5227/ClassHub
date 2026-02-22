<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDocumentsRequest;
use App\Http\Requests\UpdateDocumentsRequest;
use Illuminate\Support\Facades\Storage;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Documents::latest()->paginate(10);

        return view('back.Documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.Documents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDocumentsRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('fichier')) {
            $data['fichier'] = $request->file('fichier')
                ->store('documents', 'public');
        }

        Documents::create($data);

        return redirect()
            ->route('documents.index')
            ->with('success', 'Document ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Documents $documents)
    {
        return view('back.Documents.show', compact('documents'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Documents $documents)
    {
        return view('back.Documents.edit', compact('documents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentsRequest $request, Documents $documents)
    {
        $data = $request->validated();

        if ($request->hasFile('fichier')) {

            // supprimer ancien fichier
            if ($documents->fichier) {
                Storage::disk('public')->delete($documents->fichier);
            }

            $data['fichier'] = $request->file('fichier')
                ->store('documents', 'public');
        }

        $documents->update($data);

        return redirect()
            ->route('documents.index')
            ->with('success', 'Document modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Documents $documents)
    {
        if ($documents->fichier) {
            Storage::disk('public')->delete($documents->fichier);
        }

        $documents->delete();

        return redirect()
            ->route('documents.index')
            ->with('success', 'Document supprimé avec succès.');
    }
}
