<?php

namespace App\View\Components;

use App\Models\Club;

use Illuminate\View\Component;

class ClubSelect extends Component
{

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
