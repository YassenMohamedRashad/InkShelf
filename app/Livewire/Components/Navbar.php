<?php

namespace App\Livewire\Components;

use App\Livewire\Actions\Logout;
use Livewire\Component;

class Navbar extends Component
{
    public function logout(){
        Logout::class;
    }
    public function render()
    {
        return view('livewire.components.navbar');
    }
}
