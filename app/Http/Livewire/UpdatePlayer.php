<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class UpdatePlayer extends Component
{

    use WithFileUploads;

    public $player;
    public $photo;
    public $user;
    public $file;

    public function clickPhoto()
    {
        $this->photo = 'cliqué';
    }

    public function playerSave()
    {
        $path = $this->file->store('avatars');
        $this->player->avatar_path = $path;

        $this->player->save();

        $this->photo = "";

    }

    public function render()
    {
        return view('livewire.update-player');
    }
}
