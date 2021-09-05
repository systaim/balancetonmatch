<?php

use App\Http\Controllers\MatchController;
use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\HomeController;
use App\Models\Competition;
use App\Models\Department;
use App\Models\Club;
use App\Models\Commentator;
use App\Models\Match;
use App\Models\Player;
use App\Models\Region;
use App\Models\Staff;
use App\Models\Statistic;
use App\Models\User;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Auth;

$club = ClubController::class;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/matches/coupe-de-france-2021-2022', function () {

    $matchs = Match::where('competition_id', 3)->where('date_match','>=', Carbon::now()->subHours(12))->orderBy('date_match', 'asc')->get();
    $user = Auth::user();
    $title = "coupeDeFrance";

    return view('matches.coupeDeFrance', compact('matchs','user','title'));
});

Route::get('/matches/coupe-de-bretagne-2021-2022', function () {

    $matchs = Match::where('competition_id', 4)->where('date_match','>=', Carbon::now()->subHours(12))->where('region_id', 3)->orderBy('date_match', 'asc')->get();
    $user = Auth::user();
    $title = "coupeDeFrance";

    return view('matches.coupeDeBretagne', compact('matchs','user','title'));
});


Route::get('/matches/amicaux-2021-2022', function () {

    $matchs = Match::where('competition_id', 6)->where('date_match','>=', Carbon::now()->subHours(12))->orderBy('date_match', 'asc')->get();
    $user = Auth::user();

    return view('matches.amicaux', compact('matchs','user'));
});

Route::get('/contact', function(){

    return view('contact');
});

Route::get('/mentions-legales', function(){

    return view('mentionslegales');
});

Route::get('/mon-espace/mes-favoris', function () {
    return view('mon-espace.mes-favoris');
})->middleware('auth');

Route::get('/admin/addClub', function(){
    $regions = Region::all();
    $role = Auth::user()->role;

    if($role == "super-admin" || $role == "admin"){
    return view('admin.addClub', compact('regions'));
    } else{
        return redirect('/')->with('danger', "Vous n'êtes pas autorisé à entrer ici");

    }
})->middleware('auth');

Route::get('admin/recupMatchsCoupe', function () {
    
})->middleware('auth');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/', HomeController::class);
Route::resource('clubs', 'App\Http\Controllers\ClubController');
Route::resource('players', 'App\Http\Controllers\PlayerController');
Route::resource('matches', 'App\Http\Controllers\MatchController');
Route::resource('commentaires', 'App\Http\Controllers\CommentaireController');
Route::resource('clubs.players', 'App\Http\Controllers\PlayerController');
Route::resource('clubs.staffs', 'App\Http\Controllers\StaffController');
Route::resource('regions', 'App\Http\Controllers\RegionController');
Route::resource('competitions', CompetitionController::class);

Route::resource('admin/users', 'App\Http\Controllers\UserController')->middleware('auth');
Route::resource('admin', '\App\Http\Controllers\AdminController')->middleware('auth');

Route::post('contacts', 'App\Http\Controllers\ContactController@store')->name('contacts.store');
Route::post('contactsNewTeam', 'App\Http\Controllers\ContactController@askNewTeam')->name('contacts.askNewTeam');
Route::post('contactsForPlayers', 'App\Http\Controllers\ContactController@askPlayer')->name('contacts.askPlayer');
Route::post('contactsForBecomeManager', 'App\Http\Controllers\ContactController@becomeManager')->name('contacts.becomeManager');

Route::get('live', function(){

    $user = Auth::user();
    $liveMatches = Match::where('date_match','>=', Carbon::now()->subMinutes(240))
                            ->where(function($query) {
                                $query->where('live', '!=', 'attente')->where('live', '!=', 'finDeMatch');
                            })->get();

    return view('matches.live', compact('liveMatches', 'user'));
});

Route::get('commentaire/delete/{id}', 'App\Http\Controllers\CommentaireController@destroy')->name('supprimer');

Route::get('demo', 'App\Http\Controllers\MatchController@demo')->name('demo');


