<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Order;
use App\Models\Order_item;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Checkout extends Component
{
    use LivewireAlert;
    public $payment_method = 'cash';


    public $description = '';

    public function place_order()
    {
        $user = Auth::user();
        $order = Order::create([
            'user_id' => $user->id,
            'order_address' => $user->address,
            'total_amount' => 0,
            'payment_method' => 'cash',
            'status' => 'pending',
            'description' => $this->description,
        ]);
        $carts = Auth::user()->carts;
        foreach ($carts as $cart) {
            $order_item = Order_item::create([
                'order_id' => $order->id,
                'book_id' => $cart->book_id,
                'quantity' => $cart->quantity,
                'price' => $cart->price,
            ]);
            $book = Book::find($order_item->book_id);
            $book->stock -= $cart->quantity;
            $book->save();
            $order->total_amount += $cart->price;
            $cart->delete();
        }
        $order->save();
        $this->alert('success', 'order placed successfully');
        $this->redirect(route('home'), true);
    }

    public function mount()
    {
        $user = Auth::user();
        if (!$user->address) {
            return $this->redirect(route('user-info'), true);
        }
    }
    public function render()
    {
        return view('livewire.pages.checkout',[
            'carts' => Auth::user()->carts,
            'total' => Auth::user()->carts()->sum('price')
        ]);
    }
}
