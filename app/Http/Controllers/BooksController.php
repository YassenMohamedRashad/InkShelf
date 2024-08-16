<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Services\GoogleBooksApi;
use Database\Seeders\BookSeeder;
use ProtoneMedia\Splade\Facades\Splade;

class BooksController extends Controller
{
    protected $googleBooksApi;
    protected $bookSeeder;

    public function __construct()
    {
        $this->googleBooksApi = new GoogleBooksApi();
        $this->bookSeeder = new BookSeeder();
    }


    public function live_search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return ['items' => []];
        }

        // Fetch books from the database with optimized query
        $dbBooksQuery = Book::whereHas('categories', function ($q) use ($query) {
            $q->where('name', 'LIKE', "%$query%")
            ->orWhere('description', 'LIKE', "%$query%");
        })
            ->orWhereLike('identifier', "%$query%")
            ->orWhereTranslationLike('title', "%$query%")
            ->orWhereTranslationLike('description', "%$query%")
            ->take(8);


        // Execute the query and get results
        $db_books = $dbBooksQuery->get();

        // Fetch books from the Google Books API (ensure this method is optimized)
        $api_books = Book::factory()->withGoogleBooksData($this->googleBooksApi, $query);

        // Convert collections to arrays and merge
        $db_books_array = $db_books->toArray();
        $api_books_array = is_array($api_books) ? array_slice($api_books, 0, 7) : array_slice($api_books->toArray(), 0, 7); // Ensure $api_books is an array

        $processed_api_books = array_map(function ($item) {
            // Ensure $item is an array and has at least one nested array
            return isset($item[0]) && is_array($item[0]) ? $item[0] : [];
        }, $api_books_array);


        // Combine arrays efficiently
        $combined_books = array_merge($db_books_array, $processed_api_books);

        // Return only the first 7 books
        $limited_books = array_slice($combined_books, 0, 7);


        return response()->json(collect($limited_books));
    }
}
