<?php

namespace App\Http\Livewire;

use App\Models\Club;
use App\Models\Department;
use App\Models\Region;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class SearchTeams extends Component
{
    use WithPagination;

    public $name;
    public $messageNoClub;
    public $query;
    public $search;
    public $regions;
    public $departements;
    public $nomClub = "";
    public $region;
    public $departement;

    public function mount(Request $request)
    {
        if ($request->has('search')) {
            $this->query = $request->search;
        }

        // $this->regions = Region::all();
        $this->departements = Department::all();

        $this->regions = Region::find($this->departements->keys());
    }

    public function updatedQuery()
    {
        $this->resetPage();
    }

    // // appel du composant pour la pagination
    // public function paginationView()
    // {
    //     return 'vendor.pagination.tailwind';
    // }

    public function render()
    {
        return view('livewire.search-teams', [
            'clubs' => Club::where('name', 'like', '%' . $this->query . '%')
            ->orwhere('city', 'like', '%' . $this->query . '%')
            ->orwhere('zip_code', 'like', '%' . $this->query . '%')
            ->orwhere('abbreviation', 'like', '%' . $this->query . '%')
            ->inRandomOrder()
            ->paginate(20),
        ]);
    }
}
