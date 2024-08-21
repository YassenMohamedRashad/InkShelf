<?php

namespace App\Livewire\Components;

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    public $user_cart_count = 0;
    protected $listeners = ['logout' => 'logout'];

    #[On('added-cart')]
    public function mount(){
        if(Auth::check()){
            $this->user_cart_count = Auth::user()->carts()->count();
        }
    }
    public function logout(){
        return $this->redirect(route('logout'), true);
    }
    public function render()
    {
        return view('livewire.components.navbar');
    }
}
