<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Department;
use App\Models\DivisionsDepartment;
use App\Models\DivisionsRegion;
use App\Models\Group;
use App\Models\Journee;
use App\Models\Region;
use App\Models\Rencontre;
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
        $regionales = DivisionsRegion::all();
        $districts = DivisionsDepartment::all(); 
        $groupes = Group::all();
        $departements = Department::where('region_id', 3)->get();
        $chiffreEnLettre = ['0','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U'];
        

        return view("competitions.index", compact('competitions', 'regionales', 'districts', 'departements', 'groupes', 'chiffreEnLettre'));
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
    public function show(Region $region, DivisionsRegion $division, Group $groupe)
    {
        // $matchs = Rencontre::where('group_id', $groupe->id)
        //             ->orwhere('division_region_id', $region->id)
        //             ->get()->groupBy('journee_id');
        // $journees = Journee::find($matchs->keys());

        // return view('competitions.show', compact('groupe', 'region', 'matchs', 'journees'));

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
