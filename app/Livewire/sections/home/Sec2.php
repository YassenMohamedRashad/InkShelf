<?php

namespace App\Livewire\sections\home;

use App\Models\Book_category;
use Livewire\Component;

class Sec2 extends Component
{

    public $perPage = 2;

    public function loadMore()
    {
        $this->perPage += 2;
    }

    public function render()
    {
        $categories = Book_category::withCount('books')
            ->having('books_count', '>', 6)
            ->latest()
            ->take($this->perPage)
            ->get();
        return view('livewire.pages.home.sec2', [
            'categories' => $categories
        ]);
    }
}
