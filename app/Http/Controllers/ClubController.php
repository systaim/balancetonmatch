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
            'numAffiliation' => ['required','integer'],
            'primary_color' => ['nullable'],
            'secondary_color' => ['nullable'],
            'zip_code' => ['required','integer'],
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
        $matchs = Rencontre::where('home_team_id', $club->id)->orwhere('away_team_id', $club->id)->orderBy('date_match','asc')->paginate(10);
        $activities = ClubActivity::where('club_id', $club->id)
                                ->where('created_at', '>', now()->subDays(15))
                                ->get()->sortByDesc('created_at');

        $teams = Team::where('club_id', $club->id)->get();
        
        $matchsR1 = Rencontre::where('division_region_id', 1)->where('date_match','>=', Carbon::now()->subHours(12))
                            ->where(function ($query) use ($club){
                                    $query->where('home_team_id', $club->id)
                                    ->orwhere('away_team_id', $club->id);
                            })->limit(1)->get();

        $matchsR2 = Rencontre::where('division_region_id', 2)->where('date_match','>=', Carbon::now()->subHours(12))
                            ->where(function ($query) use ($club){
                                    $query->where('home_team_id', $club->id)
                                    ->orwhere('away_team_id', $club->id);
                            })->limit(1)->get();
                            
        $matchsR3 = Rencontre::where('division_region_id', 3)->where('date_match','>=', Carbon::now()->subHours(12))
                            ->where(function ($query) use ($club){
                                    $query->where('home_team_id', $club->id)
                                    ->orwhere('away_team_id', $club->id);
                            })->limit(1)->get();

        $matchsCF = Rencontre::where('competition_id', 3)->where('date_match','>=', Carbon::now()->subHours(12))
                            ->where(function ($query) use ($club){
                                    $query->where('home_team_id', $club->id)
                                    ->orwhere('away_team_id', $club->id);
                            })->get();

        $matchsBZH = Rencontre::where('competition_id', 4)->where('date_match','>=', Carbon::now()->subHours(12))
                            ->where(function ($query) use ($club){
                                    $query->where('home_team_id', $club->id)
                                    ->orwhere('away_team_id', $club->id);
                            })->get();

        $matchsCoupeDep = Rencontre::where('competition_id', 5)->where('date_match','>=', Carbon::now()->subHours(12))
                            ->where(function ($query) use ($club){
                                    $query->where('home_team_id', $club->id)
                                    ->orwhere('away_team_id', $club->id);
                            })->get();

        $matchsD1 = Rencontre::where('division_department_id', 1)->where('date_match','>=', Carbon::now()->subHours(12))
                            ->where(function ($query) use ($club){
                                    $query->where('home_team_id', $club->id)
                                    ->orwhere('away_team_id', $club->id);
                            })->limit(1)->get();
        $matchsD2 = Rencontre::where('division_department_id', 2)->where('date_match','>=', Carbon::now()->subHours(12))
                            ->where(function ($query) use ($club){
                                    $query->where('home_team_id', $club->id)
                                    ->orwhere('away_team_id', $club->id);
                            })->limit(1)->get();

        $matchsD3 = Rencontre::where('division_department_id', 3)->where('date_match','>=', Carbon::now()->subHours(12))
                            ->where(function ($query) use ($club){
                                    $query->where('home_team_id', $club->id)
                                    ->orwhere('away_team_id', $club->id);
                            })->limit(1)->get();
        $matchsD4 = Rencontre::where('division_department_id', 4)->where('date_match','>=', Carbon::now()->subHours(12))
                            ->where(function ($query) use ($club){
                                    $query->where('home_team_id', $club->id)
                                    ->orwhere('away_team_id', $club->id);
                            })->limit(1)->get();
        return view('clubs.pageClub', compact('teams','activities','club', 'matchs','user','nbrFavoris', 'nbrPlayers', 'nbrStaffs', 'matchsR1','matchsR2', 'matchsR3', 'matchsCF', 'matchsBZH', 'matchsCoupeDep', 'matchsD1', 'matchsD2', 'matchsD3', 'matchsD4'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function edit(Club $club)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Club $club)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function destroy(Club $club)
    {
        //
    }
}
