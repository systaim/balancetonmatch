<?php

namespace App\Http\Livewire;

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

    public function mount()
    {

        // dd($this->club->primary_color);
        $this->inputCity = $this->club->city;
        $this->inputZip = $this->club->zip_code;
        $this->inputAddress = $this->club->address;
        $this->inputPrimaryColor = $this->club->primary_color;
        $this->inputSecondaryColor = $this->club->secondary_color;
        $this->inputNbrTeams = $this->club->number_teams;
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

        $this->club->city = $this->inputCity;
        $this->club->zip_code = $this->inputZip;
        $this->club->address = $this->inputAddress;

        $this->club->primary_color = $this->inputPrimaryColor;
        $this->club->secondary_color = $this->inputSecondaryColor;

        $this->club->number_teams = $this->inputNbrTeams;

        $this->validate([
            'inputCity' => 'required|string|min:2',
            'inputZip' => 'required|digits:5',
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
