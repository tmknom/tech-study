<?php

namespace App\Library\Http;

class GuzzleJsonHttpClient implements JsonHttpClient
{

    /** @var GuzzleHttpClient */
    private $guzzleHttpClient;

    public function __construct()
    {
        $this->guzzleHttpClient = new GuzzleHttpClient();
    }

    /**
     * HTTPリクエスト送信し、結果をJSON配列で取得する
     *
     * @param string $url
     * @return array
     */
    public function request($url)
    {
        $response = $this->guzzleHttpClient->request($url);
        return json_decode($response, true);
    }

}
