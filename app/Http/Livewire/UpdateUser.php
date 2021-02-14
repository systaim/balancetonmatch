<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdateUser extends Component
{
    public $user;
    public $role;

    public function mount()
    {
        $this->role = $this->user->role;
    }

    public function userUpdate()
    {
        $this->user->role = $this->role;
        $this->user->save();

        session()->flash('success', 'role modifié');
    }
    public function render()
    {
        return view('livewire.update-user');
    }
}
