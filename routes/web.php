<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\admin\Auth\LoginController;
use App\Http\Controllers\user\Auth\LoginsController;
use App\Http\Controllers\user\Auth\HomeController;
use App\Http\Controllers\user\Auth\FrontendLogController;
use App\Http\Controllers\admin\BackendController;
use App\Http\Controllers\admin\EventController;
use App\Http\Controllers\admin\OffreController;
use App\Http\Controllers\admin\FormationController;
use App\Http\Controllers\admin\CategorieController;
use App\Http\Controllers\admin\ArticleController;
use App\Http\Controllers\admin\MediathequeController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ParametreController;
use App\Http\Controllers\admin\ValeurController;
use App\Http\Controllers\admin\StructureController;
use App\Http\Controllers\admin\LocaliteController;
use App\Http\Controllers\user\FrontendController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::resource('dossiers', DossierController::class);

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/admin/login', [App\Http\Controllers\admin\Auth\LoginController::class, 'showLoginForm'])->name('admin.login');
// Route::post('/admin', [App\Http\Controllers\admin\Auth\LoginController::class, 'login'])->name('admin.connexion');

// HOME BACKEND
Route::get('admin/home', [BackendController::class, 'home'])->name('backend.home');
Route::get('admin', [BackendController::class, 'home'])->name('admin.home');
Route::get('users/liste', [BackendController::class, 'liste'])->name('users.index');

// ADMIN AUTH
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::get('/admin/logins', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [LoginController::class, 'login']);
Route::get('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// USER AUTH
Route::get('/connexion', [LoginsController::class, 'showLoginForm'])->name('user.login');
Route::get('/connexions', [LoginsController::class, 'showLoginForm'])->name('login');
Route::post('/connexion', [LoginsController::class, 'login']);
Route::get('frontend/logout', [LoginsController::class, 'logout'])->name('user.logout');

// RESOURCES
Route::resource('admin/events', EventController::class);
Route::resource('admin/offres', OffreController::class);
Route::resource('admin/formations', FormationController::class);
Route::resource('admin/categories', CategorieController::class);
Route::resource('admin/articles', ArticleController::class);
Route::resource('admin/mediatheques', MediathequeController::class);
Route::resource('admin/roles', RoleController::class);
Route::resource('admin/permissions', PermissionController::class);
Route::resource('admin/admins', AdminController::class);
Route::resource('admin/parametres', ParametreController::class);
Route::resource('admin/valeurs', ValeurController::class);
Route::resource('admin/structures', StructureController::class);
Route::resource('admin/localites', LocaliteController::class);

// DELETE
Route::get('/roles/{id}/delete', [RoleController::class, 'delete'])->name('roles.delete');

/****** FRONTEND ROUTES ************************/
// WELCOME
Route::get('', [FrontendController::class, 'frontend'])->name('frontend.welcome');
// CREATE INSCRIPTION
Route::get('inscription', [FrontendController::class, 'create'])->name('inscription.create');
// STORE INSCRIPTION
Route::post('inscription', [FrontendController::class, 'store'])->name('inscription.store');
// PROFILE PASSWORD
Route::get('edit/profile', [HomeController::class, 'editProfile'])->name('profile.password');
// PROFILE EDIT
Route::get('/employee/edit', [HomeController::class, 'editEmploye'])->name('profile.edit');
// UPDATE PROFILE
Route::post('update/profile', [HomeController::class, 'updateProfile'])->name('update.profile');
// Liste de mes candidatures
Route::get('profile/mescandidatures', [FrontendLogController::class, 'mescandidatures'])->name('frontend.mescandidatures');
// Liste de mes candidatures
Route::get('profile/messtages', [FrontendLogController::class, 'messtages'])->name('frontend.messtages');
// La redirection vers le provider
Route::get("redirect/{provider}", "user\SocialiteController@redirect")->name('socialite.redirect');
// Le callback du provider
Route::get("callback/{provider}", "user\SocialiteController@callback")->name('socialite.callback');
// VERIFY EMAIL
Route::get('/email/verify', 'user\FrontendLogController@verif')->name('user.verification');

// MENU
Route::get('urgence/{submenu}', [FrontendController::class, 'urgence'])->name('menu.urgence');
Route::get('risque/{submenu}', [FrontendController::class, 'risque'])->name('menu.risque');
Route::get('formation/{submenu}', [FrontendController::class, 'formation'])->name('menu.formation');
Route::get('simulation/{submenu}', [FrontendController::class, 'simulation'])->name('menu.simulation');
Route::get('ressource/{submenu}', [FrontendController::class, 'ressource'])->name('menu.ressource');
Route::get('corus/{submenu}', [FrontendController::class, 'corus'])->name('menu.corus');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
