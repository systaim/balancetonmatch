<?php

namespace App\Http\Livewire\Home;

use App\Models\Commentator;
use Carbon\Carbon;
use Livewire\Component;

class LoadCommentators extends Component
{
    public $readyToLoad = false;

    public function loadCommentators()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        $commentators = Commentator::where('created_at', '>', Carbon::now()->subDays(5))->where('user_id', '!=', 0)->get();

        return view('livewire.home.load-commentators', [
            'commentators' => $this->readyToLoad ? $commentators : [],
        ]);
    }
}
