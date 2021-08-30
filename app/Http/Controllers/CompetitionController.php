<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\DivisionsRegion;
use App\Models\Group;
use App\Models\Journee;
use App\Models\Match;
use App\Models\Region;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competitions = Competition::all();
        
        

        return view("competitions.index", compact('competitions'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Competition $competition, Group $group, Region $region, DivisionsRegion $division)
    {

        $matchs = Match::where('division_region_id', $division->id)
                    ->where('competition_id', $competition->id)
                    ->where('region_id', $region->id)
                    ->where('group_id', $group->id)
                    ->get()->groupBy('journee_id');
        $journees = Journee::find($matchs->keys());

        return view('competitions.show', compact('competition', 'group', 'region', 'division', 'matchs', 'journees'));
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
