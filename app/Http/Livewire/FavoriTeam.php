<?php

namespace App\Http\Livewire;

use App\Models\Club;
use App\Models\ClubActivity;
use App\Models\Favoristeam;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class FavoriTeam extends Component
{


    public $club, $user, $nbrFavoris, $login;

    public function clickLogin()
    {
        $this->login = "Tu souhaites suivre cette équipe ?";
    }

    public function myTeam(Club $club)
    {
        if (Auth::check()) {
            if ($this->user->isFavoriTeam($club)) {
                $teamData = Favoristeam::where('user_id', $this->user->id)->where('club_id', $this->club->id)->delete();
                $this->nbrFavoris -= 1;
                session()->flash('success', 'Equipe supprimée de tes favoris');
                return redirect()->to('/clubs/' . $this->club->id);
            } else {
                $data['user_id'] = $this->user->id;
                $data['club_id'] = $club->id;
                $teamData = Favoristeam::create($data);
                $this->nbrFavoris += 1;
                session()->flash('success', 'Equipe ajoutée à tes favoris');

                $activite = new ClubActivity();
                $activite['user_id'] = Auth::user()->id;
                $activite['club_id'] = $this->club->id;
                $activite['type'] = 'store_fan';
                $activite['description'] = 'est devenu fan';
                $activite->save();
                
                return redirect()->to('/clubs/' . $this->club->id);
            }
        }
    }

    public function render()
    {
        return view('livewire.favori-team');
    }
}
