<?php

namespace App\Http\Livewire;

use App\Models\Player;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class IsPlayer extends Component
{
    public $user;
    public $players;

    public function mount()
    {
        $this->user = Auth::user();
        $this->players = Player::where('last_name', $this->user->last_name)->where('first_name', $this->user->first_name)->get();
    }

    public function render()
    {
        return view('livewire.is-player');
    }
}
