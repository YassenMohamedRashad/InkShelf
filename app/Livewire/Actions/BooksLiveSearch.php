<?php

namespace App\Livewire\Actions;

use App\Models\Book;
use App\Services\GoogleBooksApi;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class BooksLiveSearch extends Component
{
    use LivewireAlert;
    public $class;
    public $search_term = '';

    public function filterBook($book){
        if(isset($book['id'])){
            $this->alert('success','im work');
            return $this->redirect('/',true);
        }
        dd($book);
    }



    public function render()
    {
        $books = [];
        $googleBooksApi = new GoogleBooksApi;

        if (strlen($this->search_term) > 1) {
            $books = Book::whereHas('categories', function ($q) {
                $q->where('name', 'LIKE', "%{$this->search_term}%")
                    ->orWhere('description', 'LIKE', "%{$this->search_term}%");
            })
                ->orWhereLike('identifier', "%{$this->search_term}%")
                ->orWhereTranslationLike('title', "%{$this->search_term}%")
                ->orWhereTranslationLike('description', "%{$this->search_term}%")
                ->take(10)
                ->get();

            $api_books = Book::factory()->withGoogleBooksData($googleBooksApi, $this->search_term, max_result: 7);
            $api_books_array = is_array($api_books) ? $api_books : $api_books->toArray();

            $processed_api_books = array_map(function ($item) {
                // Ensure $item is an array and has at least one nested array
                return isset($item[0]) && is_array($item[0]) ? $item[0] : [];
            }, $api_books_array);

            $books = array_slice(array_merge($books->toArray(), $processed_api_books), 0, 7);
        }

        return view('livewire.components.books-live-search', compact('books'));
    }
}
