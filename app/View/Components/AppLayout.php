<?php

namespace App\View\Components;

use App\Models\Region;
use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */

    public function render()
    {
        return view('layout');
    }
}
