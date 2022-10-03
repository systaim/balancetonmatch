<?php

namespace App\Http\Livewire;

use App\Models\Activity;
use App\Models\ClubActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateTeam extends Component
{
    use WithFileUploads;

    public $club, $city, $inputCity, $inputZip, $inputLogo, $inputAddress, $club_name, $inputTeamName;
    public $buttonCity, $inputPrimaryColor, $inputSecondaryColor, $nbrTeams, $inputNbrTeams, $buttonNbrTeams, $inputAbbreviation;

    public function mount()
    {

        // dd($this->club->primary_color);
        $this->club_name = $this->club->name;
        $this->inputCity = $this->club->city;
        $this->inputZip = $this->club->zip_code;
        $this->inputAddress = $this->club->address;
        $this->inputTeamName = $this->club->name;
        $this->inputPrimaryColor = $this->club->primary_color;
        $this->inputSecondaryColor = $this->club->secondary_color;
        $this->inputNbrTeams = $this->club->number_teams;
        $this->inputAbbreviation = $this->club->abbreviation;
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

        $this->club->city = strtoupper($this->inputCity);
        $this->club->name = strtoupper($this->inputTeamName);
        $this->club->zip_code = $this->inputZip;
        $this->club->address = $this->inputAddress;

        $this->club->primary_color = $this->inputPrimaryColor;
        $this->club->secondary_color = $this->inputSecondaryColor;

        $this->club->number_teams = $this->inputNbrTeams;
        $this->club->abbreviation = $this->inputAbbreviation;

        $this->validate([
            'inputTeamName' => 'required|string|min:2',
            'inputAbbreviation' => 'nullable|string|max:6',
            'inputAddress' => 'nullable|string|max:255',
            'inputCity' => 'nullable|string|min:2|max:255',
            'inputPrimaryColor' => 'regex:/#[a-fA-F0-9]{6}/',
            'inputSecondaryColor' => 'regex:/#[a-fA-F0-9]{6}/',
            'inputZip' => 'nullable|digits:5',
        ]);

        if ($this->inputLogo) {
            $path = $this->inputLogo->store('teamlogo');
            $this->club->logo_path = $path;
        }

        $this->club->save();
        if (Auth::user()->role != 'super-admin') {
            $activite = new ClubActivity();
            $activite['user_id'] = Auth::user()->id;
            $activite['club_id'] = $this->club->id;
            $activite['type'] = 'update_city';
            $activite['description'] = 'a modifié les informations du club';
            $activite->save();
        }

        return redirect()->to('clubs/' . $this->club->id);
    }

    public function nbrTeamsSave()
    {
        $this->nbrTeams = $this->inputNbrTeams;
        $this->club->number_teams = $this->inputNbrTeams;
        $this->club->save();
    }

    public function deleteLogo()
    {
        $this->club->logo_path = "";
        $this->club->save();

        return redirect()->to('clubs/' . $this->club->id);
    }

    public function render()
    {
        return view('livewire.update-team');
    }
}
