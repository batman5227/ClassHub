<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\ElevesController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\ClasseMatiereGroupeController;
use App\Http\Controllers\SitesController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\CoursdappuieController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoleUsersController;
use App\Http\Controllers\UsersController;
use App\Models\Classe;
use App\Models\Eleves;
use App\Models\Sites;
use App\Models\Matiere;
use App\Models\Groupe;
use App\Models\Cours;
use App\Models\Documents;

// Dashboard route with data
Route::get('/', function () {
    $stats = [
        'totalClasses' => Classe::count(),
        'totalEleves' => Eleves::count(),
        'totalSites' => Sites::count(),
        'totalMatieres' => Matiere::count(),
        'totalGroupes' => Groupe::count(),
        'totalCours' => Cours::count(),
        'totalDocuments' => Documents::count(),
    ];

    $recentClasses = Classe::with('sites')->latest()->take(5)->get();
    $recentEleves = Eleves::latest()->take(5)->get();

    return view('dashboard.home', compact('stats', 'recentClasses', 'recentEleves'));
})->name('dashboard');

// Routes pour les Classes
Route::resource('classes', ClasseController::class);

// Route pour filtrer les classes par site
Route::get('classes/site/{idSites}', [ClasseController::class, 'bySite'])->name('classes.bySite');

// Routes pour gérer les matières et groupes d'une classe
Route::get('classes/{classe}/matieres-groupes', [ClasseController::class, 'manageMatieresGroupes'])->name('classes.manageMatieresGroupes');
Route::post('classes/{classe}/matieres-groupes', [ClasseController::class, 'storeMatieresGroupes'])->name('classes.storeMatieresGroupes');
Route::delete('classes/{classe}/matieres-groupes/{classeMatiereGroupe}', [ClasseController::class, 'destroyMatieresGroupes'])->name('classes.destroyMatieresGroupes');

// Routes API pour récupérer les matières et groupes d'une classe
Route::get('classes/{classe}/matieres', [ClasseController::class, 'matieres'])->name('classes.matieres');
Route::get('classes/{classe}/groupes', [ClasseController::class, 'groupes'])->name('classes.groupes');

// Routes pour les Élèves
Route::resource('eleves', ElevesController::class);

// Routes pour filtrer les eleves
Route::get('eleves/classe/{idClasse}', [ElevesController::class, 'byClass'])->name('eleves.byClass');
Route::get('eleves/site/{idSites}', [ElevesController::class, 'bySite'])->name('eleves.bySite');
Route::get('eleves/coursdappuie/{idCoursDappuie}', [ElevesController::class, 'byCoursDappuie'])->name('eleves.byCoursDappuie');

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

// Routes pour les Cours
Route::resource('cours', CoursController::class);

// Routes pour les Cours d'Appui
Route::resource('coursdappuie', CoursdappuieController::class);

// Routes pour les Notifications
Route::resource('notifications', NotificationController::class);

// Routes pour les Rôles
Route::resource('roles', RoleController::class);

// Routes pour Role-Users
Route::resource('role-users', RoleUsersController::class);

// Routes pour les Utilisateurs
Route::resource('users', UsersController::class);
