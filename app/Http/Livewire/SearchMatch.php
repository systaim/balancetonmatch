<?php

namespace App\Http\Livewire;

use App\Models\Club;
use App\Models\Match;
use App\Models\Region;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SearchMatch extends Component
{

    public $search;
    public $clubs;
    public $matches;
    public $regions;
    public $user;

    public function mount()
    {
        $this->matches = Match::where('date_match', '>=', Carbon::now()->subHours(12))
        ->orderBy('date_match', 'asc')->get();
        $this->regions = Region::find($this->matches->keys());
        $this->matches = [];
    }

    public function updatedSearch()
    {
        // $this->matches = [];

                $club = Club::where('name', 'like', '%' . $this->search . '%')
                            ->orwhere('zip_code', 'like', '%' . $this->search . '%')
                            ->orwhere('city', 'like', '%' . $this->search . '%')
                            ->get()
                            ->pluck('id'); 
                $this->matches = Match::where('date_match','>=', Carbon::now())
                                ->wherein('home_team_id', $club)
                                ->orwherein('away_team_id', $club)
                                ->get();
    }

    public function render()
    {
        return view('livewire.search-match');
    }
}