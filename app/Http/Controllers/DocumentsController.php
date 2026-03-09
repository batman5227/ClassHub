<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use App\Models\Matiere;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use Illuminate\Support\Facades\Storage;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Documents::with('matieres')->latest()->paginate(10);

        return view('back.documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $matieres = Matiere::all();
        return view('back.documents.create', compact('matieres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDocumentRequest $request)
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
    public function show(Documents $document)
    {
        $document->load('matieres');
        return view('back.documents.show', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Documents $document)
    {
        $matieres = Matiere::all();
        return view('back.documents.edit', compact('document', 'matieres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentRequest $request, Documents $document)
    {
        $data = $request->validated();

        if ($request->hasFile('fichier')) {
            // supprimer ancien fichier
            if ($document->fichier) {
                Storage::disk('public')->delete($document->fichier);
            }

            $data['fichier'] = $request->file('fichier')
                ->store('documents', 'public');
        }

        $document->update($data);

        return redirect()
            ->route('documents.index')
            ->with('success', 'Document modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Documents $document)
    {
        if ($document->fichier) {
            Storage::disk('public')->delete($document->fichier);
        }

        $document->delete();

        return redirect()
            ->route('documents.index')
            ->with('success', 'Document supprimé avec succès.');
    }
}
