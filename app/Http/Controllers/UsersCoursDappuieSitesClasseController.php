<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsersCoursDappuieSitesClasseRequest;
use App\Http\Requests\UpdateUsersCoursDappuieSitesClasseRequest;
use App\Models\Classe;
use App\Models\Coursdappuie;
use App\Models\Sites;
use App\Models\Users;
use App\Models\UsersCoursDappuieSitesClasse;

class UsersCoursDappuieSitesClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $usersCoursDappuieSitesClasse = UsersCoursDappuieSitesClasse::all();
        return view('back.usersCoursdappuieSitesClasses.index', compact('usersCoursDappuieSitesClasse'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $sites=Sites::all();
        $classes=Classe::all();
        $coursDappuies=Coursdappuie::all();
        $users=Users::all();
        return view('back.usersCoursdappuieSitesClasses.create', compact('sites', 'classes', 'coursDappuies', 'users'));
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsersCoursDappuieSitesClasseRequest $request)
    {
        //
        $data = $request->validated();
        UsersCoursDappuieSitesClasse::create($data);
        return redirect()
            ->route('usercoursdappuiesiteclasses.index')
            ->with('success', 'Association créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(UsersCoursDappuieSitesClasse $usersCoursDappuieSitesClasse)
    {
        //
        $usersCoursDappuieSitesClasse->load(['users', 'coursDappuie', 'sites', 'classe']);
        return view('back.usersCoursdappuieSitesClasses.show', compact('usersCoursDappuieSitesClasse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UsersCoursDappuieSitesClasse $usersCoursDappuieSitesClasse)
    {
        //
        $usersCoursDappuieSitesClasse->load(['users', 'coursDappuie', 'sites', 'classe']);
        return view('back.usersCoursdappuieSitesClasses.edit', compact('usersCoursDappuieSitesClasse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsersCoursDappuieSitesClasseRequest $request, UsersCoursDappuieSitesClasse $usersCoursDappuieSitesClasse)
    {
        //
        $data = $request->validated();
        $usersCoursDappuieSitesClasse->update($data);
        return redirect()
            ->route('usercoursdappuiesiteclasses.index')
            ->with('success', 'Association mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UsersCoursDappuieSitesClasse $usersCoursDappuieSitesClasse)
    {
        //
        $usersCoursDappuieSitesClasse->delete();
        return redirect()
            ->route('usercoursdappuiesiteclasses.index')
            ->with('success', 'Association supprimée avec succès.');
    }
}
