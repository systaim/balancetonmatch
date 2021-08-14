<?php

namespace App\Http\Livewire;

use App\Models\Club;
use App\Models\Favoristeam;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyTeam extends Component
{

    public $star = "";
    public $club;
    public $user;
    public $login;
    public $message;
    public $animation;

    public function mount(Club $club)
    {
        if (Auth::check()) {
            if ($this->user->club_id == $this->club->id) {
                $this->star = "fas";
                $this->message = 'C\'est ma team ! 💪';
            } else {
                $this->star = "far";
                $this->message = 'Je suis licencié dans un autre club';
            }
        } else {
            $this->star = "far";
        }
    }

    public function itsMyTeam()
    {
        if (Auth::check()) {
            // if ($this->user->club == null) {
                if ($this->user->club_id != $this->club->id) {
                    $this->star = 'far';
                    $this->user->club_id = $this->club->id;
                    $this->user->save();

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
                $this->star = 'fas';
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
