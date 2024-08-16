<?php

namespace Database\Factories;

use App\Services\GoogleBooksApi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'birth_date' => '2020/10/10',
            'death_date' => '2024/10/10',
            'nationality' => fake()->country(),
            'about' => fake()->text(),
        ];
    }

    public function withGoogleBooksData(GoogleBooksApi $googleBooksApi, $query, $lang = 'en', $max_result = 40)
    {
        $data = $googleBooksApi->makeAPIRequest($query, $lang, $max_result);

        $booksData = [];

        foreach ($data->items as $item) {

            $booksData[] = [
                [
                    'cover' => $item->volumeInfo->imageLinks->thumbnail ?? null,
                    'identifier' => isset($item->volumeInfo->industryIdentifiers) ? $item->volumeInfo->industryIdentifiers[0]->identifier : null,
                    'pdf' => $item->accessInfo->pdf->acsTokenLink ?? null,
                    'audio' => null,
                    'webReaderLink' => $item->accessInfo->webReaderLink ?? null,
                    // 'authors' => isset($item->volumeInfo->authors) ? json_encode($item->volumeInfo->authors) : null,
                ],
                [
                    'authors' => $item->volumeInfo->authors ?? null
                ]
            ];
        }

        return $booksData;
    }
}
