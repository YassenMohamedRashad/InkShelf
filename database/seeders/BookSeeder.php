<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Services\GoogleBooksApi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(GoogleBooksApi $googleBooksApi): void
    {
        


        $booksData = Book::factory()->withGoogleBooksData($googleBooksApi, 'programming');

        foreach ($booksData as $bookData) {
            Book::create($bookData);
        }
    }
}
