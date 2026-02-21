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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSitesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sites $sites)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sites $sites)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSitesRequest $request, Sites $sites)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sites $sites)
    {
        //
    }
}
