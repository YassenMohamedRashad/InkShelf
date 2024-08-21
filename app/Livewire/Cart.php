<?php

namespace App\Livewire;

use App\Models\Cart as ModelsCart;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{
    use LivewireAlert;
    public $total;

    public function increase_quantity($cart_id)
    {
        $cart = ModelsCart::find($cart_id);
        $book = $cart->book;
        if ($cart->book->stock < ($cart->quantity + 1)) {
            $this->alert('error', 'books quantity not enough');
            return;
        }
        $cart->quantity++;
        $cart->price += $book->price;
        $cart->save();
        $this->dispatch('quantity-updated');
    }

    public function decrease_quantity($cart_id)
    {
        $cart = ModelsCart::find($cart_id);
        $book = $cart->book;
        if ($cart->quantity == 1) {
            return;
        }
        $cart->quantity--;
        $cart->price -= $book->price;
        $cart->save();
        $this->dispatch('quantity-updated');
    }

    #[On('quantity-updated')]
    public function setTotalPrice() {
        $this->total = Auth::user()->carts()->sum('price');
    }

    public function mount()
    {
        $this->setTotalPrice();
    }

    public function render()
    {
        $carts = ModelsCart::where('user_id', Auth::user()->id)->get();
        return view('livewire.pages.cart', [
            'carts' => $carts
        ]);
    }
}
