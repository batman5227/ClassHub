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
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\RoleUsersController;
use App\Http\Controllers\SitesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UsersCoursappuieSiteClasseController;
use App\Models\Matiere;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {

//     return view('welcome');
// });
Route::get('/',function()
    {
        return view('dashboard.home');
    })->name('dashboard');
    // Routes pour la gestion des rôles des utilisateurs
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/{user}/roles/assigner', [RoleUsersController::class, 'assigner'])->name('roles.assigner');
    Route::get('/{user}/roles/retirer', [RoleUsersController::class, 'retirer'])->name('roles.retirer');
    Route::post('/{user}/roles', [RoleUsersController::class, 'store'])->name('roles.store');
    Route::delete('/{user}/roles', [RoleUsersController::class, 'destroy'])->name('roles.destroy');
});

Route::resource('classes', ClasseController::class)->parameters([
    'classes' => 'classe'  // Force le paramètre à s'appeler "classe" au lieu de "class"
]);
Route::resource('groupes', GroupeController::class);

Route::resource('sites',SitesController::class);
Route::resource('coursdappuies',CoursdappuieController::class);
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
//assigner
// Routes spécifiques pour un utilisateur
Route::prefix('users/{userId}')->name('users.')->group(function () {
    Route::get('/affecter-cours', [UsersCoursappuieSiteClasseController::class, 'assigner'])->name('affecter-cours');
    Route::get('/retirer-cours', [UsersCoursappuieSiteClasseController::class, 'retirer'])->name('retirer-cours');
    Route::delete('/retirer-cours-multiple', [UsersCoursappuieSiteClasseController::class, 'retirerMultiple'])->name('retirer-cours-multiple');
});


Route::resource('roles', RoleController::class);

Route::resource('roleUsers', RoleUsersController::class);
// Routes pour l'activation/désactivation des utilisateurs
Route::put('/users/{user}/activate', [UsersController::class, 'activate'])->name('users.activate');
Route::put('/users/{user}/deactivate', [UsersController::class, 'deactivate'])->name('users.deactivate');
// Pour le retrait (DELETE)
Route::delete('/roles/{roleId}/permissions', [RolespermissionsController::class, 'destroy'])->name('rolespermissions.destroy');
Route::get('roles/{id}/affecter', [RoleController::class, 'affecter'])->name('roles.affecter');
Route::get('roles/{id}/retirer', [RoleController::class, 'retirer'])->name('roles.retirer');
Route::post('/rolespermissions/{roleId}', [RolespermissionsController::class, 'store'])->name('rolespermissions.store');
Route::resource('rolespermissions', RolespermissionsController::class);
Route::resource('permissions', PermissionsController::class);
Route::resource('users',UsersController::class);
// Route::resources('users', 'App\Http\Controllers\UserController');
// Route::resources('classes', 'App\Http\Controllers\ClasseController');
// Route::resources('students', 'App\Http\Controllers\StudentController');
// Route::resources('teachers', 'App\Http\Controllers\TeacherController');
// Route::resources('subjects', 'App\Http\Controllers\SubjectController');
// Route::resources('schedules', 'App\Http\Controllers\ScheduleController');
// Route::resources('enrollments', 'App\Http\Controllers\EnrollmentController');
//Yanick

// Routes pour les Élèves
Route::resource('eleves', ElevesController::class);

// Routes pour filtrer les eleves
Route::get('eleves/classe/{idClasse}', [ElevesController::class, 'byClass'])->name('eleves.byClass');
Route::get('eleves/site/{idSites}', [ElevesController::class, 'bySite'])->name('eleves.bySite');
Route::get('eleves/coursdappuie/{idCoursDappuie}', [ElevesController::class, 'byCoursDappuie'])->name('eleves.byCoursDappuie');
 Route::resource('cours', CoursController::class);
// Routes pour Classe-Matière-Groupe
Route::resource('classe-matiere-groupe', ClasseMatiereGroupeController::class);
// Routes pour les Documents
Route::resource('documents', DocumentsController::class);
// Routes pour les Matieres
Route::resource('matieres', MatiereController::class);
// Routes pour les cours
Route::resource('cours', CoursController::class);
