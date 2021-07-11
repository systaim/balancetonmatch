<?php

use App\Http\Controllers\MatchController;
use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubController;
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


Route::get('/', function (Match $match) {
    $matchesToday = Match::whereBetween('date_match', [Carbon::now()
        ->startOfDay(), Carbon::now()->endOfDay()])->get();
    $matchesTomorrow = Match::where('date_match', [Carbon::tomorrow()])->get();
    $futurMatches = Match::where('date_match', '>=', Carbon::now()->subHours(6))
        ->orderBy('date_match', 'asc')->get();
    $matches = Match::all();
    $clubs = Club::all();
    $staffs = Staff::all();
    $players = Player::all();
    $dateJour = Carbon::now();
    $user = Auth::user();
    $today = now()->subHours(3);
    $goals= Statistic::where('action', 'goal')->get();
    $yellowCards= Statistic::where('action', 'yellow_card')->get();
    $redCards= Statistic::where('action','red_card')->get();
    $commentators = Commentator::all();
    $liveMatches = Match::where('date_match','>=', Carbon::now()->subMinutes(150))
                            ->where(function($query) {
                                $query->where('live', 'debut')
                                ->orwhere('live', 'mitemps')
                                ->orwhere('live', 'repriseMT');
                            })
                            ->get();
    $match = Match::where('slug', $match->slug)->first();

    return view('welcome', compact(
        'matchesToday', 
        'matchesTomorrow', 
        'futurMatches', 
        'staffs', 
        'matches', 
        'clubs', 
        'players', 
        'dateJour', 
        'user', 
        'today',
        'goals',
        'yellowCards',
        'redCards',
        'commentators',
        'liveMatches',
        'match',
    ));
});

Route::get('/contact', function(){

    return view('contact');
});

Route::get('/mentions-legales', function(){

    return view('mentionslegales');
});

Route::get('/admin/addClub', function(){
    $regions = Region::all();
    $users = User::all();
    $role = Auth::user()->role;


    if($role == "super-admin" || $role == "admin"){
    return view('admin.addClub', compact('regions', 'users'));
    } else{
        return redirect('/')->with('danger', "Vous n'êtes pas autorisé à entrer ici");

    }
})->middleware('auth');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('clubs', 'App\Http\Controllers\ClubController');
Route::resource('players', 'App\Http\Controllers\PlayerController');
Route::resource('matches', 'App\Http\Controllers\MatchController');
// Route::get('match/{id}/{slug?}', 'App\Http\Controllers\MatchController@show')->name('match.show');
Route::resource('commentaires', 'App\Http\Controllers\CommentaireController');
Route::resource('clubs.players', 'App\Http\Controllers\PlayerController');
Route::resource('clubs.staffs', 'App\Http\Controllers\StaffController');
Route::resource('regions', 'App\Http\Controllers\RegionController');
Route::resource('admin/users', 'App\Http\Controllers\UserController')->middleware('auth');
Route::resource('admin', '\App\Http\Controllers\AdminController')->middleware('auth');

Route::post('contacts', 'App\Http\Controllers\ContactController@store')->name('contacts.store');
Route::post('contactsNewTeam', 'App\Http\Controllers\ContactController@askNewTeam')->name('contacts.askNewTeam');
Route::post('contactsForPlayers', 'App\Http\Controllers\ContactController@askPlayer')->name('contacts.askPlayer');
Route::post('contactsForBecomeManager', 'App\Http\Controllers\ContactController@becomeManager')->name('contacts.becomeManager');

Route::get('live', function(){

    $user = Auth::user();
    $liveMatches = Match::where('date_match','>=', Carbon::now()->subMinutes(150))
                            ->where(function($query) {
                                $query->where('live', 'debut')
                                ->orwhere('live', 'mitemps')
                                ->orwhere('live', 'repriseMT');
                            })
                            ->get();

    return view('matches.live', compact('liveMatches', 'user'));
});

Route::get('matchsduweekend', function(){

    $user = Auth::user();
    $matches = Match::all()->groupBy('competition_id');
    $competitions = Competition::find($matches->keys());

    return view('matches.weekend', compact('matches','user', 'competitions'));
});

Route::get('commentaire/delete/{id}', 'App\Http\Controllers\CommentaireController@destroy')->name('supprimer');

Route::get('demo', 'App\Http\Controllers\MatchController@demo')->name('demo');


