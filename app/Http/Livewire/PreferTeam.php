<?php

namespace App\Http\Livewire;

use App\Models\Club;
use App\Models\Favori;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PreferTeam extends Component
{

    public $heart = "";
    public $club;
    public $user;
    public $favoris;
    public $favoriClass;
    public $login;

    public function mount(Club $club)
    {
        if ($this->user) {
            if ($this->user->isFavori($club)) {
                $this->heart = "fas";
            } else {
                $this->heart = "far";
            }
        }
    }

    public function clickLogin()
    {
        $this->login = "Vous ne pouvez pas suivre cette équipe";
    }

    public function myTeam(Club $club)
    {
        if ($this->user->isFavori($club)) {
            $teamData = Favori::where('user_id', $this->user->id)->where('club_id', $this->club->id)->delete();
            $this->heart = "far";
            session()->flash('messageMyTeam', 'Equipe supprimée de mes favoris');
        } else {
            $data['user_id'] = $this->user->id;
            $data['club_id'] = $club->id;
            $teamData = Favori::create($data);
            $this->heart = "fas";
            session()->flash('messageMyTeam', 'Equipe ajoutée à mes favoris');
        }
    }

    public function render()
    {
        return view('livewire.prefer-team');
    }
}
