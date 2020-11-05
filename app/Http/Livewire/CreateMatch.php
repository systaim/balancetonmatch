<?php

namespace App\Http\Livewire;

use App\Models\Club;
use App\Models\Competition;
use App\Models\Match;
use App\Models\Region;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\New_;

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
    public $departments;
    public $divisionsDepartments;
    public $divisionsRegions;
    public $dateMatch;
    public $timeMatch;

    public function mount()
    {
        $this->clubs = [];
    }

    public function updatedSearchHome()
    {

        if (strlen($this->searchHome) >= 2) {
            $this->clubs = Club::where('name', 'like', '%' . $this->searchHome . '%')->get();
        } else {
            $this->clubs = [];
        }
    }

    public function updatedSearchAway()
    {

        if (strlen($this->searchAway) >= 2) {
            $this->clubs = Club::where('name', 'like', '%' . $this->searchAway . '%')->get();
        } else {
            $this->clubs = [];
        }
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
            // 'group_id' => 'nullable',
        ]);

        $homeTeam = Club::where('name', $validateData['searchHome'])->first();
        $awayTeam = Club::where('name', $validateData['searchAway'])->first();
        $regionMatch = Region::where('name', $validateData['region'])->first();

        $match = new Match;
        $match->home_team_id = $homeTeam->id;
        $match->away_team_id = $awayTeam->id;
        $match->region_id = $regionMatch->id;
        $match->time = $this->timeMatch;
        $match->date_match = $this->dateMatch;
        $match->competition_id = $this->competition;
        if($this->competition == "1"){
            $match->division_region_id = $this->divisionsRegions;
        }
        if($this->competition == "2"){
            $match->division_department_id = $this->divisionsDepartments;
        }

        // dd($match->region_id);
        $match->user_id = $user->id;
        $match->save();
    }

    public function render()
    {
        return view('livewire.create-match');
    }
}
