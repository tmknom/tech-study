<?php

namespace App\Library\Http;

use GuzzleHttp\Client;

class GuzzleHttpClient implements HttpClient
{

    /** @var Client */
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * HTTPリクエスト送信
     *
     * @param string $url
     * @return string
     */
    public function request($url)
    {
        return $this->client->get($url)->getBody()->__toString();
    }

}
