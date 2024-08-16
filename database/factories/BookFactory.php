<?php

namespace Database\Factories;

use App\Models\Category_book;
use App\Services\GoogleBooksApi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
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
                    'title' => $item->volumeInfo->title,
                    'en' => [
                        'title' => $item->volumeInfo->title,
                        'description' => $item->volumeInfo->description ?? null,
                    ],
                    'ar' => [
                        'title' => $item->volumeInfo->title,
                        'description' => $item->volumeInfo->description ?? null,
                    ],
                ],
                [
                    'categories' => $item->volumeInfo->categories ?? null,
                    'authors' => $item->volumeInfo->authors ?? null
                ]
            ];
        }

        return $booksData;
    }
}
