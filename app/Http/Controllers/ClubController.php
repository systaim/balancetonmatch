<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\ClubActivity;
use App\Models\Department;
use App\Models\Favorismatch;
use App\Models\Favoristeam;
use App\Models\Rencontre;
use App\Models\Player;
use App\Models\Region;
use App\Models\Staff;
use App\Models\Statistic;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function App\Models\region;

class ClubController extends Controller
{
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
                $clubs = Club::all();
                $regions = Region::all();
                $departements = Department::all();
                return view('clubs.index', compact('clubs', 'regions', 'departements'));
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
                //
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
                // dd($request);
                $data = $request->validate([
                        'name' => ['required', 'string'],
                        'numAffiliation' => ['required', 'integer'],
                        'primary_color' => ['nullable'],
                        'secondary_color' => ['nullable'],
                        'zip_code' => ['required', 'integer'],
                        'city' => ['required', 'string'],
                        'region_id' => ['required'],
                ]);
                $region = Region::where('name', $data['region_id'])->first();

                $club = new Club;
                $club->name = $request->name;
                $club->numAffiliation = $request->numAffiliation;
                $club->primary_color = $request->primary_color;
                $club->secondary_color = $request->secondary_color;
                $club->zip_code = $request->zip_code;
                $club->city = $request->city;
                $club->region_id = $region->id;
                $club->save();

                return back();
        }

        /**
         * Display the specified resource.
         *
         * @param  \App\Models\Club  $club
         * @return \Illuminate\Http\Response
         */
        public function show(Club $club)
        {
                $user = Auth::user();
                $nbrPlayers = Player::where('club_id', $club->id)->count();
                $nbrStaffs = Staff::where('club_id', $club->id)->count();
                $nbrFavoris = Favoristeam::where('club_id', $club->id)->count();
                $matchs = Rencontre::where('home_team_id', $club->id)->orwhere('away_team_id', $club->id)->orderBy('date_match', 'desc')->get();
                $activities = ClubActivity::where('club_id', $club->id)
                        ->where('created_at', '>', now()->subDays(15))
                        ->get()->sortByDesc('created_at');

                $teams = Team::where('club_id', $club->id)->get();

                $matchsR1 = Rencontre::where('division_region_id', 1)->where('date_match', '>=', Carbon::now()->subHours(12))
                        ->where(function ($query) use ($club) {
                                $query->where('home_team_id', $club->id)
                                        ->orwhere('away_team_id', $club->id);
                        })->limit(1)->orderBy('date_match')->get();

                $matchsR2 = Rencontre::where('division_region_id', 2)->where('date_match', '>=', Carbon::now()->subHours(12))
                        ->where(function ($query) use ($club) {
                                $query->where('home_team_id', $club->id)
                                        ->orwhere('away_team_id', $club->id);
                        })->limit(1)->orderBy('date_match')->get();

                $matchsR3 = Rencontre::where('division_region_id', 3)->where('date_match', '>=', Carbon::now()->subHours(12))
                        ->where(function ($query) use ($club) {
                                $query->where('home_team_id', $club->id)
                                        ->orwhere('away_team_id', $club->id);
                        })->limit(1)->orderBy('date_match')->get();

                $matchsCF = Rencontre::where('competition_id', 3)->where('date_match', '>=', Carbon::now()->subHours(12))
                        ->where(function ($query) use ($club) {
                                $query->where('home_team_id', $club->id)
                                        ->orwhere('away_team_id', $club->id);
                        })->orderBy('date_match')->get();

                $matchsBZH = Rencontre::where('competition_id', 4)->where('date_match', '>=', Carbon::now()->subHours(12))
                        ->where(function ($query) use ($club) {
                                $query->where('home_team_id', $club->id)
                                        ->orwhere('away_team_id', $club->id);
                        })->orderBy('date_match')->get();

                $matchsCoupeDep = Rencontre::where('competition_id', 5)->where('date_match', '>=', Carbon::now()->subHours(12))
                        ->where(function ($query) use ($club) {
                                $query->where('home_team_id', $club->id)
                                        ->orwhere('away_team_id', $club->id);
                        })->orderBy('date_match')->get();

                $matchsD1 = Rencontre::where('division_department_id', 1)->where('date_match', '>=', Carbon::now()->subHours(12))
                        ->where(function ($query) use ($club) {
                                $query->where('home_team_id', $club->id)
                                        ->orwhere('away_team_id', $club->id);
                        })->limit(1)->orderBy('date_match')->get();
                $matchsD2 = Rencontre::where('division_department_id', 2)->where('date_match', '>=', Carbon::now()->subHours(12))
                        ->where(function ($query) use ($club) {
                                $query->where('home_team_id', $club->id)
                                        ->orwhere('away_team_id', $club->id);
                        })->limit(1)->orderBy('date_match')->get();

                $matchsD3 = Rencontre::where('division_department_id', 3)->where('date_match', '>=', Carbon::now()->subHours(12))
                        ->where(function ($query) use ($club) {
                                $query->where('home_team_id', $club->id)
                                        ->orwhere('away_team_id', $club->id);
                        })->limit(1)->orderBy('date_match')->get();
                $matchsD4 = Rencontre::where('division_department_id', 4)->where('date_match', '>=', Carbon::now()->subHours(12))
                        ->where(function ($query) use ($club) {
                                $query->where('home_team_id', $club->id)
                                        ->orwhere('away_team_id', $club->id);
                        })->limit(1)->orderBy('date_match')->get();
                $matchsAmicaux = Rencontre::where('competition_id', 6)->where('date_match', '>=', Carbon::now()->subHours(12))
                ->where(function ($query) use ($club) {
                        $query->where('home_team_id', $club->id)
                        ->orwhere('away_team_id', $club->id);
                })->limit(1)->orderBy('date_match')->get();
                return view('clubs.pageClub', compact('teams', 'activities', 'club', 'matchs', 'user', 'nbrFavoris', 'nbrPlayers', 'nbrStaffs', 'matchsR1', 'matchsR2', 'matchsR3', 'matchsCF', 'matchsBZH', 'matchsCoupeDep', 'matchsD1', 'matchsD2', 'matchsD3', 'matchsD4', 'matchsAmicaux'));
        }

        /**
         * /**
         * @OA\Get(
         *     path="/clubs",
         *     tags={"clubs"},
         *     summary="Find club by ID",
         *     description="Returns all clubs",
         *     operationId="getClubs",
         *     @OA\Response(
         *         response=200,
         *         description="successful operation",
         *         @OA\JsonContent(ref="https://balancetonmatch.com/api/clubs"),
         *         @OA\XmlContent(ref="https://balancetonmatch.com/api/clubs"),
         *     ),
         *     @OA\Response(
         *         response=400,
         *         description="Invalid ID supplier"
         *     ),
         *     @OA\Response(
         *         response=404,
         *         description="Clubs not found"
         *     ),
         *     security={
         *         {"api_key": {}}
         *     }
         * )
         *
         * @param int $id
         */
        public function getClubs()
        {
        }
        /**
         * Add a new club to the store
         * 
         * @OA\Post(
         *     path="/clubs",
         *     tags={"clubs"},
         *     operationId="addClub",
         *     @OA\Response(
         *         response=405,
         *         description="Invalid input"
         *     ),
         *     @OA\Parameter(
         *         name="club_id",
         *         in="path",
         *         description="ID of club to return",
         *         required=true,
         *         @OA\Schema(
         *             type="integer",
         *             format="int64"
         *         ),
         *         name="abbreviation",
         *         in="path",
         *         description="Abbreviation du club",
         *         required=false,
         *         @OA\Schema(
         *             type="string",
         *         )
         *     ),
         *     security={
         *         {"clubstore_auth": {"write:clubs", "read:clubs"}}
         *     },
         *     requestBody={"$ref": "https://balancetonmatch.com/components/requestBodies/Club"}
         * )
         */
        public function addClub()
        {
        }

        /**
         * Update an existing club
         *
         * @OA\Put(
         *     path="/clubs",
         *     tags={"clubs"},
         *     operationId="updateClub",
         *     @OA\Response(
         *         response=400,
         *         description="Invalid ID supplied"
         *     ),
         *     @OA\Response(
         *         response=404,
         *         description="Club not found"
         *     ),
         *     @OA\Response(
         *         response=405,
         *         description="Validation exception"
         *     ),
         *     security={
         *         {"clubstore_auth": {"write:clubs", "read:clubs"}}
         *     },
         *     requestBody={"$ref": "https://balancetonmatch.com/components/requestBodies/Club"}
         * )
         */
        public function updateClub()
        {
        }

        /**
         * @OA\Get(
         *     path="/clubs/{clubId}",
         *     tags={"clubs"},
         *     summary="Find club by ID",
         *     description="Returns a single club",
         *     operationId="getClubById",
         *     @OA\Parameter(
         *         name="clubId",
         *         in="path",
         *         description="ID of club to return",
         *         required=true,
         *         @OA\Schema(
         *             type="integer",
         *             format="int64"
         *         )
         *     ),
         *     @OA\Response(
         *         response=200,
         *         description="successful operation",
         *         @OA\JsonContent(ref="https://balancetonmatch.com/api/clubs"),
         *         @OA\XmlContent(ref="https://balancetonmatch.com/api/clubs"),
         *     ),
         *     @OA\Response(
         *         response=400,
         *         description="Invalid ID supplier"
         *     ),
         *     @OA\Response(
         *         response=404,
         *         description="Club not found"
         *     ),
         *     security={
         *         {"api_key": {}}
         *     }
         * )
         *
         * @param int $id
         */
        public function getClubById($id)
        {
        }

        /**
         * @OA\Post(
         *     path="/clubs/{clubId}",
         *     tags={"clubs"},
         *     summary="Updates a club in the store with form data",
         *     operationId="updateClubWithForm",
         *     @OA\Parameter(
         *         name="clubId",
         *         in="path",
         *         description="ID of club that needs to be updated",
         *         required=true,
         *         @OA\Schema(
         *             type="integer",
         *             format="int64"
         *         )
         *     ),
         *     @OA\Response(
         *         response=405,
         *         description="Invalid input"
         *     ),
         *     security={
         *         {"clubstore_auth": {"write:clubs", "read:clubs"}}
         *     },
         *     @OA\RequestBody(
         *         description="Input data format",
         *         @OA\MediaType(
         *             mediaType="application/x-www-form-urlencoded",
         *             @OA\Schema(
         *                 type="object",
         *                 @OA\Property(
         *                     property="name",
         *                     description="Updated name of the club",
         *                     type="string",
         *                 ),
         *                 @OA\Property(
         *                     property="status",
         *                     description="Updated status of the club",
         *                     type="string"
         *                 )
         *             )
         *         )
         *     )
         * )
         */
        public function updateClubWithForm()
        {
        }

        /**
         * @OA\Delete(
         *     path="/clubs/{clubId}",
         *     tags={"clubs"},
         *     summary="Deletes a club",
         *     operationId="deleteClub",
         *     @OA\Parameter(
         *         name="api_key",
         *         in="header",
         *         required=false,
         *         @OA\Schema(
         *             type="string"
         *         )
         *     ),
         *     @OA\Parameter(
         *         name="clubId",
         *         in="path",
         *         description="Club id to delete",
         *         required=true,
         *         @OA\Schema(
         *             type="integer",
         *             format="int64"
         *         ),
         *     ),
         *     @OA\Response(
         *         response=400,
         *         description="Invalid ID supplied",
         *     ),
         *     @OA\Response(
         *         response=404,
         *         description="Club not found",
         *     ),
         *     security={
         *         {"clubstore_auth": {"write:clubs", "read:clubs"}}
         *     },
         * )
         */
        public function deleteClub()
        {
        }

        /**
         * @OA\Post(
         *     path="/clubs/{clubId}/uploadImage",
         *     tags={"clubs"},
         *     summary="uploads an image",
         *     operationId="uploadFile",
         *     @OA\Parameter(
         *         name="clubId",
         *         in="path",
         *         description="ID of club to update",
         *         required=true,
         *         @OA\Schema(
         *             type="integer",
         *             format="int64",
         *             example=1
         *         )
         *     ),
         *     @OA\Response(
         *         response=200,
         *         description="successful operation",
         *         @OA\JsonContent(ref="https://balancetonmatch.com/components/schemas/ApiResponse")
         *     ),
         *     security={
         *         {"clubstore_auth": {"write:clubs", "read:clubs"}}
         *     },
         *     @OA\RequestBody(
         *         description="Upload images request body",
         *         @OA\MediaType(
         *             mediaType="application/octet-stream",
         *             @OA\Schema(
         *                 type="string",
         *                 format="binary"
         *             )
         *         )
         *     )
         * )
         */
        public function uploadFile()
        {
        }
}
