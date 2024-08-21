<?php

namespace App\Livewire\sections\home;

use App\Models\Book_category;
use Livewire\Component;

class Sec2 extends Component
{
    public $categories;

    public function mount(){
        $this->categories = Book_category::withCount('books')
            ->having('books_count', '>', 6)
            ->latest()
            ->get(20);
    }
    public function render()
    {
        return view('livewire.pages.home.sec2',[
            'categories' => $this->categories
        ]);
    }
}
