<?php

use App\Http\Controllers\MatchController;
use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubController;
use App\Models\Club;
use App\Models\Commentator;
use App\Models\Match;
use App\Models\Player;
use App\Models\Staff;
use App\Models\Statistic;
use Carbon\Carbon;
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

Route::get('/', function () {
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
    $today = now();
    $goals= Statistic::where('action', 'goal')->get();
    $commentators = Commentator::all();

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
        'commentators',
    ));
})->middleware('auth');

Route::get('/contact', function(){

    return view('contact');
})->middleware('auth');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::resource('clubs', 'App\Http\Controllers\ClubController')->middleware('auth');
Route::resource('players', 'App\Http\Controllers\PlayerController')->middleware('auth');
Route::resource('matches', 'App\Http\Controllers\MatchController')->middleware('auth');
// Route::resource('contacts', 'App\Http\Controllers\ContactController');
Route::resource('commentaires', 'App\Http\Controllers\CommentaireController')->middleware('auth');
Route::resource('clubs.players', 'App\Http\Controllers\PlayerController')->middleware('auth');
Route::resource('clubs.staffs', 'App\Http\Controllers\StaffController')->middleware('auth');

Route::post('contacts', 'App\Http\Controllers\ContactController')->name('contacts.store')->middleware('auth');

Route::get('commentaire/delete/{id}', 'App\Http\Controllers\CommentaireController@destroy')->name('supprimer')->middleware('auth');
