<?php

namespace App\Livewire\Components;


use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    public $user_cart_count = 0;
    protected $listeners = ['logout' => 'logout'];

    public function redirectToAdminDashboard(){
        return $this->redirect(route('filament.admin.pages.dashboard'));
    }

    public function search(){
        $this->redirect(route('search',[
            'searchTerm' => 'history'
        ]),true);
    }

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
