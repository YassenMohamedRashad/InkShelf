<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Request;

class Search extends Component
{
    public $perPage = 10;
    public $search_term = '';



    function loadMore()
    {
        $this->perPage += 10;
    }


    function mount()
    {
        if (Request::query('searchTerm')) {
            $this->search_term = Request::query('searchTerm');
        }
    }
    public function render()
    {
        $books = Book::whereHas('categories', function ($q) {
            $q->where('name', 'LIKE', "%{$this->search_term}%")
                ->orWhere('description', 'LIKE', "%{$this->search_term}%");
        })
            ->orWhereLike('identifier', "%{$this->search_term}%")
            ->orWhereTranslationLike('title', "%{$this->search_term}%")
            ->orWhereTranslationLike('description', "%{$this->search_term}%")
            ->take($this->perPage)
            ->get();
        return view('livewire.pages.search', [
            'books' => $books
        ]);
    }
}
