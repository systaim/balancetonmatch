<?php

namespace App\View\Components;

use App\Models\Player;
use Illuminate\View\Component;

class PlayerSelect extends Component
{
    public $players;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->players = Player::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.player-select');
    }
}
