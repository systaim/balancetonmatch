<?php

namespace App\Http\Livewire;

use App\Models\Club;
use Livewire\Component;
use Livewire\WithPagination;

class SearchTeams extends Component
{
    use WithPagination;

    public $name;
    public $messageNoClub;
    public $query;

    public function updatingQuery()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.search-teams', [
            'clubs' => Club::where('name', 'like', '%' . $this->query . '%')->inRandomOrder()->paginate(15),
        ]);
    }
}
