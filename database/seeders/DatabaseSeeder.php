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
        $bookSeeder->seedBooksFromGoogleApi($googleBooksApi,"programming");
    }
}
