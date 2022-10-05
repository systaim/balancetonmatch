<?php

namespace App\Http\Livewire;

use App\Models\Activity;
use App\Models\Commentator;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class HomeController extends Component
{
    public function render()
    {
        return view('livewire.home-controller');
    }
}
