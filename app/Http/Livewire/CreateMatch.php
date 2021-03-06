<?php

namespace App\Http\Livewire;

use App\Mail\MatchMail;
use App\Models\Club;
use App\Models\Competition;
use App\Models\Department;
use App\Models\DivisionsDepartment;
use App\Models\DivisionsRegion;
use App\Models\Group;
use App\Models\Match;
use App\Models\Region;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CreateMatch extends Component
{
    public $clubsHome = [];
    public $clubsAway = [];
    public $searchHome = "";
    public $searchAway = "";

    public $homeTeam;
    public $homeTeamLogo;
    public $awayTeam;
    public $awayTeamLogo;

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
    public $timeMatch =null;
    public $district;


    protected $rules = [
        'homeTeam' => 'required|exists:clubs,name',
        'awayTeam' => 'required|exists:clubs,name',
        'dateMatch' => 'required|date|after:yesterday',
        'timeMatch' => 'required|date_format:H:i',
        'competition' => 'required',
        'divisionsRegions' => 'nullable',
        'divisionsDepartments' => 'nullable',
        'region' => 'nullable',
        'district' => 'nullable',
        'group' => 'nullable',
    ];

    // public function mount()
    // {
    //     $this->regions = collect(Region::all());
    //     // dd($this->regions);
    //     $this->competitions = collect(Competition::all());
    //     $this->departments = collect(Department::all());
    //     $this->groups = collect(Group::all());
    //     $this->divisionsDepartments = collect(DivisionsDepartment::all());
    //     $this->divisionsRegions = collect(DivisionsRegion::all());
    // }

    public function updatedSearchHome()
    {
        if (strlen($this->searchHome) >= 3) {
            $this->clubsHome = Club::where('name', 'like', '%' . $this->searchHome . '%')
                ->orwhere('zip_code', 'like', '%' . $this->searchHome . '%')
                ->orwhere('city', 'like', '%' . $this->searchHome . '%')
                ->orwhere('abbreviation', 'like', '%' . $this->searchHome . '%')
                ->get();
        } else {
            $this->clubsHome = [];
        }
    }

    public function updatedSearchAway()
    {
        if (strlen($this->searchAway) >= 3) {
            $this->clubsAway = Club::where('name', 'like', '%' . $this->searchAway . '%')
                ->orwhere('zip_code', 'like', '%' . $this->searchAway . '%')
                ->orwhere('city', 'like', '%' . $this->searchAway . '%')
                ->orwhere('abbreviation', 'like', '%' . $this->searchAway . '%')
                ->get();
        } else {
            $this->clubsAway = [];
        }
    }

    public function addHomeTeam(Club $club)
    {
        // dd($club);
        $this->homeTeam = $club->name;
        $this->homeTeamLogo = $club->numAffiliation;
        $this->searchHome = "";
        $this->clubsHome = [];
    }

    public function addAwayTeam(Club $club)
    {
        // dd($club);
        $this->awayTeam = $club->name;
        $this->awayTeamLogo = $club->numAffiliation;
        $this->searchAway = "";
        $this->clubsAway = [];
    }

    public function resetHomeTeam()
    {
        $this->homeTeam = "";
    }

    public function resetAwayTeam()
    {
        $this->awayTeam = "";
    }

    public function saveMatch(Match $match)
    {
        
        $user = Auth::user();

        $validateData = $this->validate();

        $homeTeam = Club::where('name', $validateData['homeTeam'])->first();
        $awayTeam = Club::where('name', $validateData['awayTeam'])->first();
        $regionMatch = Region::where('name', $validateData['region'])->first();
        $groupMatch = Group::where('name', $validateData['group'])->first();
        $dateAndTime = $this->dateMatch . "T" . $this->timeMatch;

        $match = new Match;
        $match->home_team_id = $homeTeam->id;
        $match->away_team_id = $awayTeam->id;
        if ($this->region != null) {
            $match->region_id = $regionMatch->id;
        }
        if ($this->group != null) {
            $match->group_id = $groupMatch->id;
        }
        if ($this->competition == "1") {
            $match->division_region_id = $this->divisionsRegions;
        }
        if ($this->competition == "2") {
            $match->division_department_id = $this->divisionsDepartments;
            $match->department_id = $this->district;
        }

        $match->date_match = $dateAndTime;
        $match->competition_id = $this->competition;
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

            $superAdmin = User::where('role', 'super-admin')->get()->pluck('email');
        // $admins = User::where('role', 'admin')->get()->pluck('email');

            Mail::to($superAdmin)
                    ->send(new MatchMail($matchCreate));

        // foreach ($admins as $admin) {
        //     Mail::to($admin)
        //     ->send(new ContactMail($contactCreate));
        // }

            return redirect()->to('matches/'.$match->id);
        } else {
            session()->flash('danger', 'Les 2 équipes doivent être différentes');
        }
    }

    public function render()
    {
        return view('livewire.create-match');
    }
}
