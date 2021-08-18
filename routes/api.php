<?php

use App\Http\Controllers\Api\APIClubController as ApiClubController;
use App\Http\Controllers\Api\APIMatchController as ApiMatchController;
use App\Http\Controllers\Api\APICommentaireController as ApiCommentaireController;
use App\Http\Controllers\Api\APICommentatorController as ApiCommentatorController;
use App\Http\Resources\ClubResource;
use App\Models\Club;
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

// Route::apiResource('teams', ApiClubController::class);
Route::apiResource('matchs', ApiMatchController::class);
Route::apiResource('commentaires', ApiCommentaireController::class);
Route::apiResource('commentators', ApiCommentatorController::class);

Route::get('/teams/{team}', function (Club $club) {

    $club =Club::find($club);
    return [
        'results' => ClubResource::collection($club)

    ];
});







