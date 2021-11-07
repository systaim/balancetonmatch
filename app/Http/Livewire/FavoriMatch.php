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
    public $login;
    public $match;

    public function myMatch(Match $match)
    {

        if ($this->user->isFavoriMatch($match)) {
            $matchData = Favorismatch::where('user_id', $this->user->id)->where('match_id', $match->id)->delete();
            
            $this->nbrFavoris-=1;
            session()->flash('success', 'Tu ne suis plus ce match.');
        } else {
            $data['user_id'] = $this->user->id;
            $data['match_id'] = $match->id;
            $teamData = Favorismatch::create($data);
            
            $this->nbrFavoris+=1;
            session()->flash('success', 'Tu suis ce match.');
        }
    }

    public function clickLogin()
    {
        $this->login = "Tu souhaites suivre ce match ?";
    }

    public function render()
    {
        return view('livewire.favori-match');
    }
}
