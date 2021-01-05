<?php

namespace App\Http\Livewire;

use App\Models\Club;
use App\Models\Match;
use App\Models\Region;
use App\Models\Team;
use Carbon\Carbon;
use Livewire\Component;
use PhpParser\Node\Expr\Cast\Array_;

class SearchMatch extends Component
{

    public $search = "";
    public $user;
    public $matchs;
    public $clubs;

    public function mount()
    {
        // $this->clubs = [];
        $this->matchs = collect([]);
    }

    public function updatedSearch()
    {
        // $this->matchs = collect([]);
        if (strlen($this->search) > 2) {
            $clubs = Club::where('name', 'like', '%' . $this->search . '%')->get()->pluck('id');
            $this->matchs = $this->matchs->concat(Match::wherein('home_team_id', $clubs)->orWhereIn('away_team_id', $clubs)->get());
            $this->matchs = $this->matchs->groupBy('region_id');
            // dd(Match::wherein('home_team_id', $clubs)->orWhereIn('away_team_id', $clubs)->get());

        }
    }

    public function render()
    {
        return view('livewire.search-match');
    }
}
