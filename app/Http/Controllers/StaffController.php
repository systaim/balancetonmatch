<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Club;
use App\Models\Player;
use App\Models\Match;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Club $club)
    {
        return view('staffs.index', ['club' => $club]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Club $club)
    {
        return View('staffs.create', ['club' => $club]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Club $club)
    {
        // dd($request->all());
        $user = Auth::user();
        $players = Player::all();
        $matchs = Match::where('home_team_id', $club->id)->orwhere('away_team_id', $club->id)->orderBy('date_match','desc')->get();

        $dataStaff = $request->validate([
            'name' => ['required', 'max:50', 'min:2'],
            'first_name' => ['required', 'max:50', 'min:2'],
            'quality' => ['required', 'min:3'],
        ]);
            
        $dataStaff['club_id'] = $club->id;

        $player = Staff::create($dataStaff);
        $player->user()->associate($user);
        // dd($request->all());
        $player->save();
        return view('clubs.pageClub', compact('club', 'players', 'matchs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        $staffs = Staff::all();
        return view('clubs.pageClub', compact('club', 'staffs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        //
    }
}
