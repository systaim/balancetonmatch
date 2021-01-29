<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateLogoTeam extends Component
{

    use WithFileUploads;

    public $club;
    public $inputLogo;

    public function logoSave()
    {

        dd('ok');

        // Validator::make([
        //     'inputLogo' => 'nullable|image'
        // ])->validate();

        $path = $this->inputLogo->store('logos');
        $this->club->logo_path = $path;

        dd($path);

        $this->club->save();

        return redirect()->to('clubs/' . $this->club->id);
    }

    public function render()
    {
        return view('livewire.update-logo-team');
    }
}
