<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Club;
use App\Models\Commentaire;
use App\Models\Commentator;
use App\Models\Counter;
use App\Models\Department;
use App\Models\DivisionsDepartment;
use App\Models\DivisionsRegion;
use App\Models\Favorismatch;
use App\Models\Favoristeam;
use App\Models\Gallery;
use App\Models\Group;
use App\Models\Player;
use App\Models\Rencontre;
use App\Models\Reaction as ModelsReaction;
use App\Models\Region;
use App\Models\Statistic;
use App\Models\Tab;
use App\Models\User;
use App\Models\Reaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RencontreController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('create', 'edit');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clubs = Club::all();
        $user = Auth::user();
        $players = Player::all();
        $matchesByCompet = Rencontre::where('date_match', '>=', Carbon::now()->subHours(12))
            ->orderBy('date_match', 'asc')->get()->groupBy('competition_id');

        $competitions = Competition::find($matchesByCompet->keys());



        return view('matches.listMatchs', compact('clubs', 'players', 'matchesByCompet', 'competitions', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $regions = collect(Region::all());
        $competitions = collect(Competition::all());
        $districts = collect(Department::all());
        $groups = collect(Group::all());
        $divisionsDepartments = collect(DivisionsDepartment::all());
        $divisionsRegions = collect(DivisionsRegion::all());
        return View('matches.create', compact('regions', 'groups', 'districts', 'divisionsRegions', 'divisionsDepartments', 'competitions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $user = Auth::user();
        // $competition = Competition::all();


        // $data = $request->validate([
        //     'home_team' => ['required', 'exists:clubs,name'],
        //     'away_team' => ['required', 'exists:clubs,name'],
        //     'date_match' => ['required', 'date', 'after:yesterday'],
        //     'location' => ['min:3'],
        //     'time' => ['required', 'date_format:H:i'],
        // ]);
        // $clubHome = Club::where('name', $data['home_team'])->first();
        // $clubAway = Club::where('name', $data['away_team'])->first();
        // $match = new Rencontre;
        // $match->home_team_id = $clubHome->id;
        // $match->away_team_id = $clubAway->id;
        // $match->date_match = $request->date_match;
        // $match->location = $request->location;
        // $match->time = $request->time;
        // // $match->user()->associate($user);
        // $match->save();
        // return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Rencontre $match)
    {
        $commentator = Commentator::where('rencontre_id', $match->id)->get();
        $commentsMatch = $match->commentaires()->with(['statistic'])
            ->orderBy('minute', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get();
        $clubHome = $match->homeClub()->get();
        $clubAway = $match->awayClub()->get();
        $stats = Statistic::all();
        $nbrFavoris = Favorismatch::where('match_id', $match->id)->count();
        $competitions = $match->competition()->get();
        $tabHome = Tab::where('match_id', $match->id)->where('club_id', $match->homeClub->id)->get();
        $tabAway = Tab::where('match_id', $match->id)->where('club_id', $match->awayClub->id)->get();
        $user = Auth::user();
        $favorimatch = Favorismatch::where('match_id', $match->id)->get();
        $favoriteam = Favoristeam::where('club_id', $match->homeClub->id)->orwhere('club_id', $match->awayClub->id)->get();

        return view('matches.show', compact('favorimatch', 'favoriteam', 'match', 'commentsMatch', 'clubHome', 'clubAway', 'competitions', 'stats', 'nbrFavoris', 'commentator', 'user', 'tabHome', 'tabAway'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Rencontre $match)
    {

        $date = explode(" ", $match->date_match);
        $dateDuMatch = $date[0];
        $heureDuMatch = $date[1];
        return view('matches.edit', compact('match', 'dateDuMatch', 'heureDuMatch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rencontre $match)
    {
        $dataMatch = $request->validate([
            'dateMatch' => 'required | date',
            'time' => 'required',
            'location' => 'nullable | string'
        ]);

        $match->date_match = $request->dateMatch . "T" . $request->time;
        $match->location = $request->location;
        $match->save();

        return redirect('matches/' . $match->id . '?' . $match->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $match = Rencontre::find($id);
        $match->delete();
        return back();
    }

    /**
     * /**
     * @OA\Get(
     *     path="/matchs",
     *     tags={"matchs"},
     *     summary="Find match by ID",
     *     description="Returns all matchs",
     *     operationId="getMatchs",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="https://balancetonmatch.com/api/matchs"),
     *         @OA\XmlContent(ref="https://balancetonmatch.com/api/matchs"),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplier"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Matchs not found"
     *     ),
     *     security={
     *         {"api_key": {}}
     *     }
     * )
     *
     * @param int $id
     */
    public function getMatchs()
    {
    }
    /**
     * Add a new match to the store
     * 
     * @OA\Post(
     *     path="/matchs",
     *     tags={"matchs"},
     *     operationId="addMatch",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     @OA\Parameter(
     *         name="match_id",
     *         in="path",
     *         description="ID of match to return",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *         name="abbreviation",
     *         in="path",
     *         description="Abbreviation du match",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     security={
     *         {"matchstore_auth": {"write:matchs", "read:matchs"}}
     *     },
     *     requestBody={"$ref": "https://balancetonmatch.com/components/requestBodies/Match"}
     * )
     */
    public function addMatch()
    {
    }

    /**
     * Update an existing match
     *
     * @OA\Put(
     *     path="/matchs",
     *     tags={"matchs"},
     *     operationId="updateMatch",
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Match not found"
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Validation exception"
     *     ),
     *     security={
     *         {"matchstore_auth": {"write:matchs", "read:matchs"}}
     *     },
     *     requestBody={"$ref": "https://balancetonmatch.com/components/requestBodies/Match"}
     * )
     */
    public function updateMatch()
    {
    }

    /**
     * @OA\Get(
     *     path="/matchs/{matchId}",
     *     tags={"matchs"},
     *     summary="Find match by ID",
     *     description="Returns a single match",
     *     operationId="getMatchById",
     *     @OA\Parameter(
     *         name="matchId",
     *         in="path",
     *         description="ID of match to return",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="https://balancetonmatch.com/api/matchs"),
     *         @OA\XmlContent(ref="https://balancetonmatch.com/api/matchs"),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplier"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Match not found"
     *     ),
     *     security={
     *         {"api_key": {}}
     *     }
     * )
     *
     * @param int $id
     */
    public function getMatchById($id)
    {
    }

    /**
     * @OA\Post(
     *     path="/matchs/{matchId}",
     *     tags={"matchs"},
     *     summary="Updates a match in the store with form data",
     *     operationId="updateMatchWithForm",
     *     @OA\Parameter(
     *         name="matchId",
     *         in="path",
     *         description="ID of match that needs to be updated",
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
     *         {"matchstore_auth": {"write:matchs", "read:matchs"}}
     *     },
     *     @OA\RequestBody(
     *         description="Input data format",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="name",
     *                     description="Updated name of the match",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="status",
     *                     description="Updated status of the match",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function updateMatchWithForm()
    {
    }

    /**
     * @OA\Delete(
     *     path="/matchs/{matchId}",
     *     tags={"matchs"},
     *     summary="Deletes a match",
     *     operationId="deleteMatch",
     *     @OA\Parameter(
     *         name="api_key",
     *         in="header",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="matchId",
     *         in="path",
     *         description="Match id to delete",
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
     *         description="Match not found",
     *     ),
     *     security={
     *         {"matchstore_auth": {"write:matchs", "read:matchs"}}
     *     },
     * )
     */
    public function deleteMatch()
    {
    }

    /**
     * @OA\Post(
     *     path="/matchs/{matchId}/uploadImage",
     *     tags={"matchs"},
     *     summary="uploads an image",
     *     operationId="uploadFile",
     *     @OA\Parameter(
     *         name="matchId",
     *         in="path",
     *         description="ID of match to update",
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
     *         {"matchstore_auth": {"write:pets", "read:pets"}}
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
