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
use App\Models\Group;
use App\Models\Player;
use App\Models\Match;
use App\Models\Region;
use App\Models\Statistic;
use App\Models\Tab;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MatchController extends Controller
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
        $matchesByCompet = Match::where('date_match','>=', Carbon::now()->subHours(12))
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
        // $match = new Match;
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
    public function show(Match $match)
    {
        $commentator = Commentator::where('match_id', $match->id)->get();
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

        

        return view('matches.show', compact('match', 'commentsMatch', 'clubHome', 'clubAway', 'competitions', 'stats', 'nbrFavoris', 'commentator', 'user', 'tabHome', 'tabAway'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Match $match)
    {

        $date = explode(" ",$match->date_match);
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
    public function update(Request $request, $id)
    {


        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $match = Match::find($id);
        $match->delete();
        return back();
    }
}
