<?php

namespace App\Http\Livewire;

use App\Models\Club;
use App\Models\Match;
use App\Models\Region;
use App\Models\Team;
use Carbon\Carbon;
use Livewire\Component;

class SearchMatch extends Component
{

    public $search = "";
    public $user;
    public $matchs;
    public $clubs;

    public function mount()
    {
        $this->clubs = [];
        // $this->matchs = [];
    }

    public function updatedSearch()
    {
        if (strlen($this->search) > 2) {
            $this->clubs = Club::where('name', 'like', '%' . $this->search . '%')->get();
            foreach($this->clubs as $club){
                $this->matchs = Match::where('home_team_id', $club->id)->orwhere('away_team_id', $club->id)->get();
            }
        } else{
            $this->matchs = [];
        }
    }

    public function render()
    {
        return view('livewire.search-match');
    }
}
