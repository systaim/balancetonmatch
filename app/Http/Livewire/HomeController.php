<?php

namespace App\Http\Livewire;

use App\Models\Activity;
use App\Models\Commentator;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class HomeController extends Component
{
    use WithPagination;
    // protected $commentators;
    public $readyToLoadCommentators = false, $readyToLoadActivities = false, $readyToLoadVideo = false;

    public function loadCommentators()
    {
        $this->readyToLoadCommentators = true;
    }

    public function loadActivities()
    {
        $this->readyToLoadActivities = true;
    }

    public function loadVideo()
    {
        $this->readyToLoadVideo = true;
    }

    public function render()
    {
        $commentators = Commentator::where('created_at', '>', Carbon::now()->subDays(5))->where('user_id', '=!', 0)->get();
        $activities = Activity::where('created_at', '>', now()->subDays(15))->orderByDesc('created_at')->get();
        

        return view('livewire.home-controller', [
            'commentators' => $this->readyToLoadCommentators ? $commentators : [],
            'activities' => $this->readyToLoadActivities ? $activities : [],
        ]);
    }
}
