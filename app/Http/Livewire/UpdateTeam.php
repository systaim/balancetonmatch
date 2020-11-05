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

    public $nbrTeams;
    public $inputNbrTeams;
    public $buttonNbrTeams;

    public function citySave()
    {
        $this->buttonCity = 'cliqué';

        $this->city = $this->inputCity;
        $this->zip_code = $this->inputZip;
        $this->address = $this->inputAddress;

        $this->club->city = $this->inputCity;
        $this->club->zip_code = $this->inputZip;
        $this->club->address = $this->inputAddress;

        $this->validate([
            'inputCity' => 'required|string|min:2',
            'inputZip' => 'required|digits:5',
        ]);
        $this->club->save();
    }

    public function nbrTeamsSave()
    {

        $this->buttonNbrTeams = 'cliqué';
        $this->nbrTeams = $this->inputNbrTeams;
        $this->club->number_teams = $this->inputNbrTeams;
        $this->club->save();
    }

    public function render()
    {
        return view('livewire.update-team');
    }
}
