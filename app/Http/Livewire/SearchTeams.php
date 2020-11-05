<?php

namespace App\Http\Livewire;

use App\Models\Club;
use Livewire\Component;
use Livewire\WithPagination;

class SearchTeams extends Component
{
    use WithPagination;

    // public $search = "";
    public $name;
    public $clubs;
    public $messageNoClub;
    
    public function mount(){
        $this->clubs = [];
    }

    public function searchByName()
    {

        if (!empty($this->name)) {
            
            sleep(1);

            $results = Club::searchByName($this->name);

            if (empty($results)) {

                session()->flash('message', 'Aucune correspondance pour "' . $this->name . '"');
            }

            $this->clubs = $results;
            $this->messageNoClub = "Votre club n'apparait pas ? soumettez le ici";
        }
    }

    public function render()
    {
        return view('livewire.search-teams');
    }
}
