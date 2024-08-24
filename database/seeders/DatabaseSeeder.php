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
        $this->call(RolesAndPermissionsSeeder::class);
        User::factory(10)->admin()->create([
            'name' => 'Admin' . random_int(10,100000),
        ]);
        User::factory(10)->user()->create([
            'name' => 'User' . random_int(10,100000),
        ]);
        $googleBooksApi = new GoogleBooksApi();
        $bookSeeder = new BookSeeder();

        $search_terms = config('googleBooksSeed', 'laravel');
        foreach ($search_terms as $search_term) {
            $bookSeeder->seedBooksFromGoogleApi($googleBooksApi, $search_term);
        }
    }
}
