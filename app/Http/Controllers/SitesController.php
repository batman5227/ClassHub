<?php

namespace App\Http\Controllers;

use App\Models\Sites;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSitesRequest;
use App\Http\Requests\UpdateSitesRequest;

class SitesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sites = Sites::all();
        return view('back.sites.index', compact('sites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.sites.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSitesRequest $request)
    {
        $data = $request->validated();
        Sites::create($data);

        return redirect()->route('sites.index')
                         ->with('success', 'Site ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sites $sites)
    {
        return view('back.sites.show', compact('sites'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sites $sites)
    {
        return view('back.sites.edit', compact('sites'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSitesRequest $request, Sites $sites)
    {
        $data = $request->validated();
        $sites->update($data);

        return redirect()->route('sites.index')
                         ->with('success', 'Site mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sites $sites)
    {
        $sites->delete();

        return redirect()->route('sites.index')
                         ->with('success', 'Site supprimé avec succès.');
    }
}
