<?php

use App\Http\Controllers\Api\ClubController as ClubController;
use App\Http\Controllers\Api\RencontreController as RencontreController;
use App\Http\Controllers\Api\CommentaireController as CommentaireController;
use App\Http\Controllers\Api\CommentatorController as CommentatorController;
use App\Http\Controllers\Api\StatisticController;
use App\Http\Controllers\Api\UserController as UserController;
use App\Http\Resources\ClubResource;
use App\Http\Resources\UserResource;
use App\Models\Club;
use App\Models\Player;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::apiResource('clubs', ClubController::class, [
//     'as' => 'api'
// ]);
Route::apiResource('clubs', ClubController::class, [
    'as' => 'api'
]);
Route::apiResource('matches', RencontreController::class, [
    'as' => 'api'
]);
Route::apiResource('comments', CommentaireController::class, [
    'as' => 'api'
]);
Route::apiResource('commentators', CommentatorController::class, [
    'as' => 'api'
]);
// Route::apiResource('players', PlayerController::class, [
//     'as' => 'api'
// ]);
Route::apiResource('statistics', StatisticController::class, [
    'as' => 'api'
]);
Route::apiResource('users', UserController::class, [
    'as' => 'api'
]);



// Route::get('/users', function () {
//     return UserResource::collection(User::all());
// });

// Route::get('/clubs/{club}', function (Club $club) {

//     $club =Club::find($club);
//     return [
//         'results' => ClubResource::collection($club)

//     ];
// });