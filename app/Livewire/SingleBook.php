<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class SingleBook extends Component
{
    public $id;
    use LivewireAlert;

    public $quantity = 1;
    public function addToCart($book_id)
    {
        if (!Auth::check()) {
            return $this->redirectRoute('login');
        }
        $user = Auth::user();

        if (!$user->hasVerifiedEmail()) {
            return $this->redirectRoute('verification.notice');
        }
        try {
            $book = Book::find($book_id);
            if (!$book) {
                $this->alert('error', 'Book not found', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                ]);
            }
            $cart = Cart::where('user_id', 1)->where('book_id', $book_id)->first();
            if ($cart) {
                $cart->quantity += $this->quantity ?? 1;
                $cart->price += $book->price * $this->quantity;
                $cart->save();
                $this->alert('success', 'book quantity updated successfully', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                ]);
            } else {
                Cart::create([
                    'user_id' => Auth::user()->id,
                    'book_id' => $book_id,
                    'price' => $book->price * $this->quantity,
                    'quantity' => $this->quantity
                ]);
                $this->alert('success', 'book added to cart successfully', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                ]);
            }
        } catch (\Throwable $th) {
            return
                $this->alert('error', $th->getMessage(), [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                ]);
        }
    }

    public function render()
    {
        $book = Book::findOrFail($this->id);
        return view('livewire.pages.single-book',[
            'book' => $book,
            'categories' => $book->categories()->get()
        ]);
    }
}
