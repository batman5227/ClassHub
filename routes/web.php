<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\ClasseMatiereGroupeController;
use App\Http\Controllers\CoursdappuieController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\ElevesController;
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolespermissionsController;
use App\Http\Controllers\RoleUserController;
use App\Http\Controllers\RoleUsersController;
use App\Http\Controllers\SitesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UsersCoursappuieSiteClasseController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
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
Route::resource('classes', ClasseController::class)->parameters([
    'classes' => 'classe'
]);

// Route pour filtrer les classes par site
Route::get('classes/site/{idSites}', [ClasseController::class, 'bySite'])->name('classes.bySite');

// Routes pour gérer les matières et groupes d'une classe
Route::get('classes/{classe}/matieres-groupes', [ClasseController::class, 'manageMatieresGroupes'])->name('classes.manageMatieresGroupes');
Route::post('classes/{classe}/matieres-groupes', [ClasseController::class, 'storeMatieresGroupes'])->name('classes.storeMatieresGroupes');
Route::delete('classes/{classe}/matieres-groupes/{classeMatiereGroupe}', [ClasseController::class, 'destroyMatieresGroupes'])->name('classes.destroyMatieresGroupes');

// Routes API pour récupérer les matières et groupes d'une classe
Route::get('classes/{classe}/matieres', [ClasseController::class, 'matieres'])->name('classes.matieres');
Route::get('classes/{classe}/groupes', [ClasseController::class, 'groupes'])->name('classes.groupes');

// Routes pour la gestion des rôles des utilisateurs
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/{user}/roles/assigner', [RoleUsersController::class, 'assigner'])->name('roles.assigner');
    Route::get('/{user}/roles/retirer', [RoleUsersController::class, 'retirer'])->name('roles.retirer');
    Route::post('/{user}/roles', [RoleUsersController::class, 'store'])->name('roles.store');
    Route::delete('/{user}/roles', [RoleUsersController::class, 'destroy'])->name('roles.destroy');
});

// Routes pour les Groups
Route::resource('groupes', GroupeController::class);

// Routes pour les Sites
Route::resource('sites', SitesController::class);

// Routes pour les Cours d'Appui
Route::resource('coursdappuies', CoursdappuieController::class);

// Routes pour les affectations
Route::prefix('users-coursappuie-site-classes')->name('users-coursappuie-site-classes.')->group(function () {
    Route::get('/', [UsersCoursappuieSiteClasseController::class, 'index'])->name('index');
    Route::get('/create', [UsersCoursappuieSiteClasseController::class, 'create'])->name('create');
    Route::post('/', [UsersCoursappuieSiteClasseController::class, 'store'])->name('store');
    Route::get('/{usersCoursappuieSiteClasse}', [UsersCoursappuieSiteClasseController::class, 'show'])->name('show');
    Route::get('/{usersCoursappuieSiteClasse}/assigner', [UsersCoursappuieSiteClasseController::class, 'assigner'])->name('assigner');
    Route::get('/{usersCoursappuieSiteClasse}/retirer', [UsersCoursappuieSiteClasseController::class, 'retirer'])->name('retirer');
    Route::get('/{usersCoursappuieSiteClasse}/edit', [UsersCoursappuieSiteClasseController::class, 'edit'])->name('edit');
    Route::put('/{usersCoursappuieSiteClasse}', [UsersCoursappuieSiteClasseController::class, 'update'])->name('update');
    Route::delete('/{usersCoursappuieSiteClasse}', [UsersCoursappuieSiteClasseController::class, 'destroy'])->name('destroy');
});

// Routes spécifiques pour un utilisateur
Route::prefix('users/{userId}')->name('users.')->group(function () {
    Route::get('/affecter-cours', [UsersCoursappuieSiteClasseController::class, 'assigner'])->name('affecter-cours');
    Route::get('/retirer-cours', [UsersCoursappuieSiteClasseController::class, 'retirer'])->name('retirer-cours');
    Route::delete('/retirer-cours-multiple', [UsersCoursappuieSiteClasseController::class, 'retirerMultiple'])->name('retirer-cours-multiple');
});

// Routes pour les Rôles
Route::resource('roles', RoleController::class);

// Routes pour RoleUsers
Route::resource('roleUsers', RoleUsersController::class);

// Routes pour l'activation/désactivation des utilisateurs
Route::put('/users/{user}/activate', [UsersController::class, 'activate'])->name('users.activate');
Route::put('/users/{user}/deactivate', [UsersController::class, 'deactivate'])->name('users.deactivate');

// Pour le retrait des permissions
Route::delete('/roles/{roleId}/permissions', [RolespermissionsController::class, 'destroy'])->name('rolespermissions.destroy');
Route::get('roles/{id}/affecter', [RoleController::class, 'affecter'])->name('roles.affecter');
Route::get('roles/{id}/retirer', [RoleController::class, 'retirer'])->name('roles.retirer');
Route::post('/rolespermissions/{roleId}', [RolespermissionsController::class, 'store'])->name('rolespermissions.store');
Route::resource('rolespermissions', RolespermissionsController::class);
Route::resource('permissions', PermissionsController::class);

// Routes pour les Utilisateurs
Route::resource('users', UsersController::class);

// Routes pour les Élèves
Route::resource('eleves', ElevesController::class);

// Routes pour les Documents
Route::resource('documents', DocumentsController::class);

// Routes pour les Matières
Route::resource('matieres', MatiereController::class);

// Routes pour Classe-Matière-Groupe
Route::resource('classe-matiere-groupe', ClasseMatiereGroupeController::class);

// Routes pour les Cours
Route::resource('cours', CoursController::class);

// Routes pour les Cours d'Appui
Route::resource('coursdappuie', CoursdappuieController::class);

// Routes pour les Notifications
Route::resource('notifications', NotificationController::class);

// Routes pour Role-Users
Route::resource('role-users', RoleUsersController::class);

