<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Book_author;
use App\Models\Book_category;
use App\Models\Category_book;
use App\Services\GoogleBooksApi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        Book::factory(10)->create();
    }

    public function seedBooksFromGoogleApi(GoogleBooksApi $googleBooksApi,$q, $lang = 'en', $max_result = 40){
        $booksData = Book::factory()->withGoogleBooksData($googleBooksApi, $q, $lang, $max_result);

        foreach ($booksData as $bookData) {
            $exist_book = Book::where(function ($query) use ($bookData) {
                $query->whereTranslation('title', $bookData[0]['en']['title'], 'en')
                ->orWhereTranslation('title', $bookData[0]['ar']['title'], 'ar');
            })
            ->where('cover', $bookData[0]['cover'])
            ->where('identifier', $bookData[0]['identifier'])
            ->first();
            if ($exist_book) {
                continue;
            }
            if ($bookData[1]['categories'] || $bookData[1]['authors']) {
                $created_book = Book::create($bookData[0]);

                // Handle categories
                if (!empty($bookData[1]['categories'])) {
                    foreach ($bookData[1]['categories'] as $category) {
                        // Check for similar category names before creating a new one
                        $existingCategories = Book_category::all(); // Fetch all existing categories
                        $similarCategory = null;

                        foreach ($existingCategories as $existingCategory) {
                            similar_text($existingCategory->name, $category, $percent);
                            if ($percent > 80) { // Threshold for similarity, you can adjust this
                                $similarCategory = $existingCategory;
                                break;
                            }
                        }

                        // Use the similar category if found, otherwise create a new one
                        if ($similarCategory) {
                            $bookCategory = $similarCategory;
                        } else {
                            $bookCategory = Book_category::firstOrCreate(['name' => $category]);
                        }

                        // Create the category-book relationship
                        Category_book::firstOrCreate([
                            'book_id' => $created_book->id,
                            'category_id' => $bookCategory->id,
                        ]);
                    }
                }

                // Handle authors
                if (!empty($bookData[1]['authors'])) {
                    foreach ($bookData[1]['authors'] as $author) {
                        // Check for similar author names before creating a new one
                        $existingAuthors = Author::all(); // Fetch all existing authors
                        $similarAuthor = null;

                        foreach ($existingAuthors as $existingAuthor) {
                            similar_text($existingAuthor->name, $author, $percent);
                            if ($percent > 80) { // Threshold for similarity, you can adjust this
                                $similarAuthor = $existingAuthor;
                                break;
                            }
                        }

                        // Use the similar author if found, otherwise create a new one
                        if ($similarAuthor) {
                            $bookAuthor = $similarAuthor;
                        } else {
                            $bookAuthor = Author::firstOrCreate(['name' => $author]);
                        }

                        // Check if the author-book relationship already exists before creating it
                        Book_author::firstOrCreate([
                            'book_id' => $created_book->id,
                            'author_id' => $bookAuthor->id,
                        ]);
                    }
                }
                continue;
            }

            Book::factory()->create($bookData[0]);
        }
    }
}
