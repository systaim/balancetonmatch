<?php

namespace App\Http\Livewire;

use App\Models\Gallery;
use Livewire\Component;

class GalleryMatch extends Component
{

    public $photos, $match;

    public function mount()
    {
        $this->photos = Gallery::where('match_id', $this->match->id)->get();
    }
    
    public function render()
    {
        return view('livewire.gallery-match');
    }
}
