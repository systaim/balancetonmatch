<?php

namespace App\Http\Livewire;

use App\Models\Club;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyTeam extends Component
{

    public $star = "";
    public $club;
    public $user;
    public $login;
    public $message;

    public function mount(Club $club)
    {
        if (Auth::check()) {
            if ($this->user->club_id == $this->club->id) {
                $this->star = "fas";
                $this->message = 'Je suis licencié dans ce club ! 💪';
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
            if ($this->user->club == null) {
                if ($this->user->club_id != $this->club->id) {
                    $this->star = 'far';
                    $this->user->club_id = $this->club->id;
                    $this->user->save();
                }
                if ($this->user->club_id == $this->club->id) {
                    $this->star = 'fas';
                    $this->message = 'Je suis licencié dans ce club ! 💪';
                }
            } else {
                $this->message = "Vous êtes déjà licencié ailleurs";
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
