<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Favorismatch;
use App\Models\Favoristeam;
use App\Models\Match;
use App\Models\Player;
use App\Models\Staff;
use App\Models\Statistic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('clubs.index', ['clubs' => $clubs]);
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
        //
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
        $nbrFavoris = Favoristeam::where('club_id', $club->id)->count();
        $matchs = Match::where('home_team_id', $club->id)->orwhere('away_team_id', $club->id)->orderBy('date_match','desc')->get();
        return view('clubs.pageClub', compact('club', 'matchs','user','nbrFavoris'));
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
