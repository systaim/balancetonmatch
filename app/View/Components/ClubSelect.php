<?php

namespace App\View\Components;

use App\Models\Club;

use Illuminate\View\Component;

class ClubSelect extends Component
{

    public $clubs;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->clubs = Club::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.club-select');
    }
}
