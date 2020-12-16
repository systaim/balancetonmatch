<?php

namespace App\Http\Livewire;

use App\Mail\MatchMail;
use App\Models\Club;
use App\Models\Competition;
use App\Models\Group;
use App\Models\Match;
use App\Models\Region;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
    public $validate;
    public $messageErreur = "";

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
            'dateMatch' => 'required|date|after:yesterday',
            'timeMatch' => 'required',
            'competition' => 'required',
            'divisionsRegions' => 'nullable',
            'divisionsDepartments' => 'nullable',
            'regions' => 'nullable',
            'group' => 'nullable',
        ]);

        $homeTeam = Club::where('name', $validateData['searchHome'])->first();
        $awayTeam = Club::where('name', $validateData['searchAway'])->first();
        $regionMatch = Region::where('name', $validateData['region'])->first();
        $groupMatch = Group::where('name', $validateData['group'])->first();
        $dateAndTime = $this->dateMatch . "T" . $this->timeMatch;

        $match = new Match;
        $match->home_team_id = $homeTeam->id;
        $match->away_team_id = $awayTeam->id;
        if ($this->region != null) {
            $match->region_id = $regionMatch->id;
        }
        $match->date_match = $dateAndTime;
        $match->competition_id = $this->competition;
        if ($this->group != null) {
            $match->group_id = $groupMatch->id;
        }
        if ($this->competition == "1") {
            $match->division_region_id = $this->divisionsRegions;
        }
        if ($this->competition == "2") {
            $match->division_department_id = $this->divisionsDepartments;
        }
        $match->user_id = $user->id;

        if ($homeTeam != $awayTeam) {
            $match->save();

            $matchCreate = [
                'homeTeam' => $match->homeClub->name,
                'awayTeam' => $match->awayClub->name,
                'date_match' => $match->date_match,
                'user_first_name' => $match->user->first_name,
                'user_last_name' => $match->user->last_name,
                'user_id' => $match->user_id,
            ];

            Mail::to('systaim@gmail.com')
            ->send(new MatchMail($matchCreate));

            return redirect()->to('matches/'.$match->id);
        } else {
            $this->messageErreur = 'Les 2 équipes doivent être différentes';
        }
    }

    public function render()
    {
        return view('livewire.create-match');
    }
}
