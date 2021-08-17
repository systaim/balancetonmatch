<?php

use App\Http\Controllers\Api\APIClubController as ApiClubController;
use App\Http\Controllers\Api\APIMatchController as ApiMatchController;
use App\Http\Controllers\Api\APICommentaireController as ApiCommentaireController;
use App\Http\Controllers\Api\APICommentatorController as ApiCommentatorController;
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

// Route::apiResource('clubs', ApiClubController::class);
// Route::apiResource('matchs', ApiMatchController::class);
// Route::apiResource('commentaires', ApiCommentaireController::class);
// Route::apiResource('commentators', ApiCommentatorController::class);

// API Clubs GET ET POST
Route::get('/clubs', function () {

    $clubs = Club::all();
    return [
        'clubs' => $clubs->count(),
        'results' => ClubResource::collection($clubs)

    ];
});
Route::post('/clubs', function (Request $request) {
   
    Club::create($request->all());

    $clubs= Club::all();
    return [
        'results' => ClubResource::collection($clubs)

    ];
});





