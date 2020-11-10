<?php

namespace App\Http\Livewire;

use App\Models\Club;
use App\Models\Competition;
use App\Models\Group;
use App\Models\Match;
use App\Models\Region;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CreateMatch extends Component
{
    public $clubs = [];
    public $searchHome = "";
    public $searchAway = "";
    public $regions;
    public $region;
    public $competitions;
    public $competition;
    public $groups;
    public $group;
    public $departments;
    public $divisionsDepartments;
    public $divisionsRegions;
    public $dateMatch;
    public $timeMatch;

    public function updateSearchHome()
    {
            $this->clubs = Club::where('name', 'like', '%' . $this->searchHome . '%')->get();
    }

    public function updateSearchAway()
    {
            $this->clubs = Club::where('name', 'like', '%' . $this->searchAway . '%')->get();
    }

    public function saveMatch(Match $match)
    {

        $user = Auth::user();

        $validateData = $this->validate([
            'dateMatch' => 'required',
            'timeMatch' => 'required',
            'competition' => 'required',
            'divisionsRegions' => 'nullable',
            'divisionsDepartments' => 'nullable',
            'regions' => 'required',
            'group' => 'nullable',
        ]);

        $homeTeam = Club::where('name', $validateData['searchHome'])->first();
        $awayTeam = Club::where('name', $validateData['searchAway'])->first();
        $regionMatch = Region::where('name', $validateData['region'])->first();
        $groupMatch = Group::where('name', $validateData['group'])->first();

        $match = new Match;
        $match->home_team_id = $homeTeam->id;
        $match->away_team_id = $awayTeam->id;
        $match->region_id = $regionMatch->id;
        $match->time = $this->timeMatch;
        $match->date_match = $this->dateMatch;
        $match->competition_id = $this->competition;
        $match->group_id = $groupMatch->id;
        if($this->competition == "1"){
            $match->division_region_id = $this->divisionsRegions;
        }
        if($this->competition == "2"){
            $match->division_department_id = $this->divisionsDepartments;
        }

        // dd($match->region_id);
        $match->user_id = $user->id;
        $match->save();
        return redirect()->to('matches');
    }

    public function render()
    {
        return view('livewire.create-match');
    }
}
