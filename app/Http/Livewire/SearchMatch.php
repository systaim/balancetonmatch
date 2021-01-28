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
    public $clubs;
    public $matches;
    public $regions;
    public $user;

    public function mount()
    {
        $this->matches = Match::where('date_match', '>=', Carbon::now()->subHours(12))
        ->orderBy('date_match', 'asc')->get();
        $this->regions = Region::find($this->matches->keys());

    }

    public function updatedSearch()
    {
        $this->matches = [];
        if (strlen($this->search) >= 3) {

            $clubs = Club::where('name', 'like', '%' . $this->search . '%')->get()->pluck('id');  

            $this->matches = Match::where('date_match','>=', Carbon::now())
                            ->where(function($query) use ($clubs)
                            {
                                $query->where('home_team_id', $clubs)
                                ->orwhere('away_team_id', $clubs);
                            })
                            ->get();
                            // dd($this->matches);
        }
    }

    public function render()
    {
        return view('livewire.search-match');
    }
}