<?php

namespace App\Http\Livewire;

use App\Models\Favorismatch;
use App\Models\Match;
use Livewire\Component;

class FavoriMatch extends Component
{

    public $club;
    public $user;
    public $star = "";
    public $nbrFavoris;

    public function mount(Match $match)
    {
        if ($this->user) {
            if ($this->user->isFavoriMatch($match)) {
                $this->star = "fas";
            } else {
                $this->star = "far";
            }
        }
    }

    public function myMatch(Match $match)
    {
        if ($this->user->isFavoriMatch($match)) {
            $matchData = Favorismatch::where('user_id', $this->user->id)->where('match_id', $this->match->id)->delete();
            $this->heart = "far";
            $this->nbrFavoris-=1;
            session()->flash('messageMyMatch', 'Vous ne suivez plus ce match.');
        } else {
            $data['user_id'] = $this->user->id;
            $data['club_id'] = $club->id;
            $teamData = Favorismatch::create($data);
            $this->heart = "fas";
            $this->nbrFavoris+=1;
            session()->flash('messageMyTeam', 'Vous suivez ce match.');
        }
    }

    public function clickFavori()
    {
        dd('ca marche');
    }

    public function render()
    {
        return view('livewire.favori-match');
    }
}
