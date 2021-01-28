<?php

namespace App\View\Components;

use App\Models\Region;
use Illuminate\View\Component;

class RegionSelect extends Component
{

    public $regions;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->regions = Region::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.region-select');
    }
}
