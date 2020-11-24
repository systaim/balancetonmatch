<?php

use App\Http\Controllers\MatchController;
use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubController;
use App\Models\Club;
use App\Models\Match;
use App\Models\Player;
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
    $matchesToday = Match::whereBetween('date_match', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])->get();
    $matchesTomorrow = Match::where('date_match', [Carbon::tomorrow()])->get();
    $matches = Match::where('date_match', '>=', Carbon::now()->subHours(6))->orderBy('date_match', 'asc')->get();
    $clubs = Club::all();
    $players = Player::all();
    $dateJour = Carbon::now();
    $user = Auth::user();
    $today = now();

    return view('welcome', compact('matchesToday','matchesTomorrow','clubs','players','dateJour','user', 'today'));
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('clubs', 'App\Http\Controllers\ClubController');
Route::resource('players', 'App\Http\Controllers\PlayerController');
Route::resource('matches', 'App\Http\Controllers\MatchController');

Route::resource('matches.commentaires', 'App\Http\Controllers\CommentaireController');
Route::resource('clubs.players', 'App\Http\Controllers\PlayerController');
Route::resource('clubs.staffs', 'App\Http\Controllers\StaffController');