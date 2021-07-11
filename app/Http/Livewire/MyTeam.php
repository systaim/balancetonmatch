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

    public function mount(Club $club)
    {
        if (Auth::check()) {
            if ($this->user->club_id) {
                $this->star = "fas";
            } else {
                $this->star = "far";
            }
        } else {
            $this->star = "far";
        }
    }

    public function itsMyTeam(Club $club)
    {
        if($this->user->club_id != $this->club->id){
            dd('pas le meme club');
        } else {
            $this->user->club_id == $this->club->id;
            $this->user->save();
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
