<?php

namespace App\Http\Livewire;

use App\Models\Club;
use App\Models\Rencontre;
use App\Models\Region;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SearchMatchCoupeDeFrance extends Component
{

    public $search = '';
    public $clubs;
    public $matchs;
    public $regions;
    public $user;
    public $title;

    public function mount()
    {
        // $this->matchs = Rencontre::where('date_match', '>=', Carbon::now()->subHours(12))->where('competition_id', 3)
        //     ->orderBy('date_match', 'asc')->get();
        // $this->regions = Region::find($this->matchs->keys());
        $this->matchs = [];
    }

    public function updatedSearch()
    {
        if (strlen($this->search) >= 3) {
            $club = Club::where('name', 'like', '%' . $this->search . '%')
                ->orwhere('zip_code', 'like', '%' . $this->search . '%')
                ->orwhere('city', 'like', '%' . $this->search . '%')
                ->orwhere('abbreviation', 'like', '%' . $this->search . '%')
                ->get()
                ->pluck('id');
            $this->matchs = Rencontre::where('date_match', '>=', Carbon::now()->subHours(12))
                ->where('competition_id', 3)
                ->where(function ($query) use ($club) {
                    $query->whereIn('home_team_id', $club)
                        ->orwhereIn('away_team_id', $club);
                })
                ->get();
        } else {
            // $this->matchs = Rencontre::where('date_match', '>=', Carbon::now()->subHours(12))->where('competition_id', 3)
            // ->orderBy('date_match', 'asc')->get();
            $this->matchs = [];
        }
    }

    public function render()
    {
        return view('livewire.search-match-coupe-de-france');
    }
}
