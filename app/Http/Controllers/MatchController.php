<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Club;
use App\Models\Commentaire;
use App\Models\Department;
use App\Models\DivisionsDepartment;
use App\Models\DivisionsRegion;
use App\Models\Group;
use App\Models\Player;
use App\Models\Match;
use App\Models\Region;
use App\Models\Statistic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $match = Match::with(['homeClub', 'homeAway'])->get();
        $clubs = Club::all();
        $players = Player::all();
        $competitions = Competition::all();
        $matches = Match::where('date_match', '>', Carbon::now()->yesterday())->orderBy('date_match','asc')->orderBy('time','asc')->get();
        return view('matches.listMatchs', compact('clubs', 'players', 'competitions', 'matches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clubs = Club::all();
        $regions = Region::all();
        // $competitions = Competition::all();
        $departments = Department::all();
        $groups = Group::all();
        $divisionsDepartments = DivisionsDepartment::all();
        $divisionsRegions = DivisionsRegion::all();
        return View('matches.create', compact('clubs', 'regions','groups','departments','divisionsRegions', 'divisionsDepartments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $competition = Competition::all();
        

        $data = $request->validate([
            'home_team' => ['required', 'exists:clubs,name'],
            'away_team' => ['required', 'exists:clubs,name'],
            'date_match' => ['required', 'date', 'after:yesterday'],
            'location' => ['min:3'],
            'time' => ['required','date_format:H:i'],
        ]);
        $clubHome = Club::where('name', $data['home_team'])->first();
        $clubAway = Club::where('name', $data['away_team'])->first();
        $match = new Match;
        $match->home_team_id = $clubHome->id;
        $match->away_team_id = $clubAway->id;
        $match->date_match = $request->date_match;
        $match->location = $request->location;
        $match->time = $request->time;
        // $match->user()->associate($user);
        $match->save();
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Match $match)
    {
        
        $commentsMatch = $match->commentaires()->with(['statistic'])->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
        $clubHome = $match->homeClub()->get();
        $clubAway = $match->awayClub()->get();
        $stats = Statistic::all();

        $competitions = $match->competition()->get();
        return view('matches.show',compact('match', 'commentsMatch', 'clubHome','clubAway','competitions','stats'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
