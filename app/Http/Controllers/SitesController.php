<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSitesRequest;
use App\Http\Requests\UpdateSitesRequest;
use App\Models\Coursdappuie;
use App\Models\Sites;

class SitesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $site = Sites::all();
        return view('back.sites.index', compact('site'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $coursDappuie = Coursdappuie::orderBy('nom')->get();

    return view('back.sites.create', compact('coursDappuie'));
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
    public function show(Sites $site)
    {
        return view('back.sites.show', compact('site'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sites $site)
    {
        return view('back.sites.updat', compact('site'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSitesRequest $request, Sites $site)
    {
        $data = $request->validated();
        $site->update($data);

        return redirect()->route('sites.index')
                         ->with('success', 'Site mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sites $site)
    {
        $site->delete();

        return redirect()->route('sites.index')
                         ->with('success', 'Site supprimé avec succès.');
    }
}
