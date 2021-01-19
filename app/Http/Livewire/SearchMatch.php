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
    public $futurMatches = [];
    public $clubs;
    public $matchs = [];

    public function updatedSearch()
    {
        if (strlen($this->search) >= 3) {

            $clubs = Club::where('name', 'like', '%' . $this->search . '%')->get()->pluck('id');
            $this->matchs = Match::where('date_match','>=', Carbon::now())
                            ->where(function($query) use ($clubs)
                            {
                                $query->where('home_team_id', $clubs)
                                ->orwhere('away_team_id', $clubs);
                            })
                            ->get();
        }
    }

    public function render()
    {
        return view('livewire.search-match');
    }
}
