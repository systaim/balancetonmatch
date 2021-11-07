<?php

namespace App\Http\Livewire;

use App\Models\Club;
use App\Models\ClubActivity;
use App\Models\Favoristeam;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyTeam extends Component
{

    public $my_team = false;
    public $club, $user, $login, $message, $animation;

    public function mount(Club $club)
    {
        if (Auth::check()) {
            if ($this->user->club_id == $this->club->id) {
                $this->my_team = true;
                $this->message = 'C\'est ma team ! 💪';
            } else {
                $this->message = "C'est ta team ? Clique ici";
            }
        }
    }

    public function itsMyTeam()
    {
        if (Auth::check()) {
            // if ($this->user->club == null) {
            if ($this->user->club_id != $this->club->id) {
                $this->my_team = true;
                $this->user->club_id = $this->club->id;
                $this->user->role = "guest";
                $this->user->save();

                $activite = new ClubActivity();
                $activite['user_id'] = Auth::user()->id;
                $activite['club_id'] = $this->club->id;
                $activite['type'] = 'store_my_team';
                $activite['description'] = 'indique qu\'il fait parti du club';
                $activite->save();

                if (!$this->user->isFavoriTeam($this->club)) {
                    $data['user_id'] = $this->user->id;
                    $data['club_id'] = $this->club->id;
                    $teamData = Favoristeam::create($data);
                }

                session()->flash('success', 'Bienvenue au club !');
                return redirect()->to('/clubs/' . $this->club->id);
            }
            // }
            if ($this->user->club_id == $this->club->id) {
                $this->my_team = true;
                $this->animation = 'animate-pulse';
                $this->message = 'C\'est ma team ! 💪';
            } else {
                $this->message = "Tu es déjà licencié dans un autre club";
            }
        }
    }

    public function clickLogin()
    {
        $this->login = "Tu souhaites suivre cette équipe ?";
    }


    public function render()
    {
        return view('livewire.my-team');
    }
}
