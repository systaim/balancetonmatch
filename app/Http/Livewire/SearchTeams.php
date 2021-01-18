<?php

namespace App\Http\Livewire;

use App\Models\Club;
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

    public function mount(Request $request)
    {
        if ($request->has('search')) {
            $this->query = $request->search;
        }
    }

    public function updatingQuery()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.search-teams', [
            'clubs' => Club::where('name', 'like', '%' . $this->query . '%')
            ->orwhere('city', 'like', '%' . $this->query . '%')
            ->orwhere('zip_code', $this->query)
            ->inRandomOrder()
            ->paginate(20),
        ]);
    }
}
