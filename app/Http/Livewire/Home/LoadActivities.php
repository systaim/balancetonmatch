<?php

namespace App\Http\Livewire\Home;

use App\Models\Activity;
use Livewire\Component;

class LoadActivities extends Component
{

    public $readyToLoad = false;

    public function loadActivities()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {

        $activities = Activity::where('created_at', '>', now()->subDays(15))->orderByDesc('created_at')->get();

        return view('livewire.home.load-activities', [
            'activities' => $this->readyToLoad ? $activities : [],
        ]);
    }
}
