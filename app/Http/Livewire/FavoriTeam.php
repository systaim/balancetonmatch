<?php

namespace App\Http\Livewire;

use App\Models\Club;
use App\Models\Favoristeam;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class FavoriTeam extends Component
{

    public $heart = "";
    public $club;
    public $user;
    public $nbrFavoris;
    public $login;

    public function mount(Club $club)
    {
        if ($this->user) {
            if ($this->user->isFavoriTeam($club)) {
                $this->heart = "fas";
            } else {
                $this->heart = "far";
            }
        }
    }

    public function clickLogin()
    {
        $this->login = "Tu souhaites suivre cette équipe ?";
    }

    public function myTeam(Club $club)
    {
        if ($this->user->isFavoriTeam($club)) {
            $teamData = Favoristeam::where('user_id', $this->user->id)->where('club_id', $this->club->id)->delete();
            $this->heart = "far";
            $this->nbrFavoris-=1;
            session()->flash('messageMyTeam', 'Equipe supprimée de tes favoris');
        } else {
            $data['user_id'] = $this->user->id;
            $data['club_id'] = $club->id;
            $teamData = Favoristeam::create($data);
            $this->heart = "fas";
            $this->nbrFavoris+=1;
            session()->flash('messageMyTeam', 'Equipe ajoutée à tes favoris');
        }
    }

    public function render()
    {
        return view('livewire.favori-team');
    }
}
