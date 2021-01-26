<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class UpdateTeam extends Component
{

    public $club;
    public $city;
    public $inputCity;
    public $inputZip;
    public $inputAddress;
    public $buttonCity;
    public $inputPrimaryColor;
    public $inputSecondaryColor;
    public $nbrTeams;
    public $inputNbrTeams;
    public $buttonNbrTeams;
    public $inputAbbreviation;
    public $inputLogo;

    public function mount()
    {

        // dd($this->club->primary_color);
        $this->inputCity = $this->club->city;
        $this->inputZip = $this->club->zip_code;
        $this->inputAddress = $this->club->address;
        $this->inputPrimaryColor = $this->club->primary_color;
        $this->inputSecondaryColor = $this->club->secondary_color;
        $this->inputNbrTeams = $this->club->number_teams;
        $this->inputAbbreviation = $this->club->abbreviation;
        $this->inputLogo = $this->club->logo_path;
    }

    public function clickButtonCity()
    {
        if ($this->buttonCity == 0) {
            $this->buttonCity = 1;
        } elseif ($this->buttonCity == 1) {
            $this->buttonCity = 0;
        }
    }

    public function citySave()
    {

        $path = $this->inputLogo->store('logos');
        $this->club->logo_path = $path;

        $this->club->city = $this->inputCity;
        $this->club->zip_code = $this->inputZip;
        $this->club->address = $this->inputAddress;

        $this->club->primary_color = $this->inputPrimaryColor;
        $this->club->secondary_color = $this->inputSecondaryColor;

        $this->club->number_teams = $this->inputNbrTeams;
        $this->club->abbreviation = $this->inputAbbreviation;

        Validator::make([
            'inputAbbreviation' => 'nullable|string|max:6',
            'inputAddress' => 'nullable|string|max:255',
            'inputCity' => 'nullable|string|min:2|max:255',
            'inputPrimaryColor' => 'regex:/#[a-fA-F0-9]{6}/',
            'inputSecondaryColor' => 'regex:/#[a-fA-F0-9]{6}/',
            'inputZip' => 'nullable|digits:5',
            'inputLogo' => 'nullable|image'
        ]);
        $this->club->save();

        return redirect()->to('clubs/' . $this->club->id);
    }

    public function nbrTeamsSave()
    {
        $this->nbrTeams = $this->inputNbrTeams;
        $this->club->number_teams = $this->inputNbrTeams;
        $this->club->save();
    }

    public function render()
    {
        return view('livewire.update-team');
    }
}
