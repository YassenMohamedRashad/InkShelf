<?php

namespace App\Services;

use GuzzleHttp\Client;

class GoogleBooksApi
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function makeAPIRequest($q)
    {
        try {
            $response = $this->client->get("https://www.googleapis.com/books/v1/volumes?q=physics&maxResults=40&langRestrict=ar&key=".env('GOOGLE_API_KEY'));
        } catch (\Throwable $th) {
            throw new \Exception('Error while making API request:'. $th->getMessage());
        }

        return json_decode($response->getBody()->getContents());
    }
}
