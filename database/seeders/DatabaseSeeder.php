<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\GoogleBooksApi;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $googleBooksApi = new GoogleBooksApi();
        $bookSeeder = new BookSeeder();
        $bookSeeder->seedBooksFromGoogleApi($googleBooksApi,"science");
        $bookSeeder->seedBooksFromGoogleApi($googleBooksApi,"maths");
        $bookSeeder->seedBooksFromGoogleApi($googleBooksApi,"programming");
        $bookSeeder->seedBooksFromGoogleApi($googleBooksApi,"stories");
        $bookSeeder->seedBooksFromGoogleApi($googleBooksApi,"harry potter");
        $bookSeeder->seedBooksFromGoogleApi($googleBooksApi,"روايات عربية");
        $bookSeeder->seedBooksFromGoogleApi($googleBooksApi,"قصص قصيرة");
    }
}
