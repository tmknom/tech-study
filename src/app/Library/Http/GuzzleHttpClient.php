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
     * HTTPリクエスト送信し、結果を文字列で取得する
     *
     * @param string $url
     * @return string
     */
    public function request($url)
    {
        return $this->client->get($url)->getBody()->__toString();
    }

}
