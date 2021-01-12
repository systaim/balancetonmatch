<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class TeamCover extends Component
{
    use WithFileUploads;

    public $cover;
    public $club;
    public $messageBouton;
    public $bouton;

    public function mount()
    {
        if($this->club->bg_path != null || $this->club->bg_path != ""){
            $this->bouton = 0;
        } else {
            $this->bouton = 1;
        }
    }

    public function clickButton()
    {
        if($this->bouton == 0){
            $this->bouton = 1;
        } elseif($this->bouton == 1) {
            $this->bouton = 0;
        }
    }

    public function coverTeam()
    {
        $this->validate([
            'cover' => 'image | max:5120',
        ]);


        $path = $this->cover->store('covers');
        // dd($path);
        $this->club->bg_path = $path;
        $this->club->save();
        // dd($this->club);
        $this->bouton = "0";


    }

    public function render()
    {
        return view('livewire.team-cover');
    }
}
