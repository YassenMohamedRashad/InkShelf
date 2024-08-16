<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class GoogleBooksApi
{

    public function makeAPIRequest($q,$lang='en',$max_result=40)
    {
        try {
            $response = Http::get("https://www.googleapis.com/books/v1/volumes", [
                'q' => $q,
                'maxResults' => $max_result,
                'langRestrict' => $lang,
                'key' => env('GOOGLE_API_KEY')
            ]);
        } catch (\Throwable $th) {
            throw new \Exception('Error while making API request:'. $th->getMessage());
        }

        return json_decode($response->getBody()->getContents());
    }
}
