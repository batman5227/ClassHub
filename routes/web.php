<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\ElevesController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\ClasseMatiereGroupeController;
use App\Http\Controllers\SitesController;

// Dashboard route
Route::get('/', function () {
    return view('dashboard.home');
})->name('dashboard');

// Routes pour les Classes
Route::resource('classes', ClasseController::class);

// Routes pour les Élèves
Route::resource('eleves', ElevesController::class);

// Routes pour les Documents
Route::resource('documents', DocumentsController::class);

// Routes pour les Matières
Route::resource('matieres', MatiereController::class);

// Routes pour les Groupes
Route::resource('groupes', GroupeController::class);

// Routes pour Classe-Matière-Groupe
Route::resource('classe-matiere-groupe', ClasseMatiereGroupeController::class);

// Routes pour les Sites
Route::resource('sites', SitesController::class);
