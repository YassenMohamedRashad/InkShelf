<?php

namespace App\Livewire\Actions;

use App\Models\Author;
use App\Models\Book;
use App\Models\Book_author;
use App\Models\Book_category;
use App\Models\Category_book;
use App\Services\GoogleBooksApi;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class BooksLiveSearch extends Component
{
    use LivewireAlert;
    public $class;
    public $search_term = '';

    public function filterBook($book){
        $book = (object) $book;
        if(isset($book->id)){
            return $this->redirect(route('single-book', ['id' => $book->id]),true);
        }
        $google_book= Book::where(['google_id' => $book->google_id])->first();

        if($google_book){
            return $this->redirect(route('single-book', ['id' => $google_book->id]),true);
        }

        $created_book = Book::create([
            'google_id'=>$book->google_id,
            'cover'=>$book->cover,
            'identifier' => $book->identifier??null,
            'pdf' => $book->pdf??null,
            'webReaderLink' => $book->webReaderLink??null,
            'price' => $book->price??null,
            'stock' => random_int(30,100),
            'publishedDate' => $book->publishedDate??null,
            'en' => [
                'title' => $book->en['title'],
                'description' => $book->ar['description'] ?? null,
            ],
            'ar' => [
                'title' => $book->ar['title'],
                'description' => $book->ar['description'] ?? null,
            ],
        ]);

        if (!empty($book->categories)) {
            foreach ($book->categories as $category) {
                $CategoryExist = Book_category::where(['name' => $category])->first();
                if ($CategoryExist) {
                    Category_book::create([
                        'book_id' => $created_book->id,
                        'category_id' => $CategoryExist->id,
                    ]);
                    continue;
                }
                Category_book::create([
                    'book_id' => $created_book->id,
                    'category_id' => Book_category::create(['name' => $category])->id,
                ]);
            }
        }
        if (!empty($book->authors)) {
            foreach ($book->authors as $author) {
                $AuthorExist = Author::where(['name' => $author])->first();
                if ($AuthorExist) {
                    Book_author::create([
                        'book_id' => $created_book->id,
                        'author_id' => $AuthorExist->id,
                    ]);
                    continue;
                }
                Book_author::create([
                    'book_id' => $created_book->id,
                    'author_id' => Author::create(['name' => $author])->id,
                ]);
            }
        }
        return $this->redirect(route('single-book', ['id' => $created_book->id]),true);
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
                if(isset($item[0],$item[1]) && is_array($item[0]) && is_array($item[1])){
                    return [...$item[0], ...$item[1]];
                }
            }, $api_books_array);

            $books = array_slice(array_merge($books->toArray(), $processed_api_books), 0, 7);
        }

        return view('livewire.components.books-live-search', compact('books'));
    }
}
