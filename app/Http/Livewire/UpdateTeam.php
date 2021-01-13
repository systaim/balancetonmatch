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

    public function clickButtonCity()
    {
        if($this->buttonCity == 0){
            $this->buttonCity = 1;
        } elseif($this->buttonCity == 1) {
            $this->buttonCity = 0;
        }
    }

    public function citySave()
    {
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
        $this->nbrTeams = $this->inputNbrTeams;
        $this->club->number_teams = $this->inputNbrTeams;
        $this->club->save();
    }

    public function render()
    {
        return view('livewire.update-team');
    }
}
