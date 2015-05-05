<?php

namespace App\Infrastructure\EventCrawler;

use App\Domain\EventCrawler\SampleCrawler;
use GuzzleHttp\Client;


class RestSampleCrawler implements SampleCrawler
{

    /** @var Client */
    private $httpClient;

    /** @var string APIのURL */
    const URL = 'http://api.atnd.org/events/?format=json&count=30';

    /** コンストラクタ */
    public function __construct()
    {
        $this->httpClient = new Client();
    }

    public function crawl()
    {
        $response = $this->httpClient->get(self::URL);
        return $response->getBody();
//        return $this->atndJsonMapper->createEventList($this->requestApi());
    }

    private function requestApi()
    {
////        return new JsonHttpResponse(json_decode(file_get_contents(app_path() . '/tests/fixtures/Atnd/atnd.json'), true), 200);
//        return $this->jsonRequest->request(self::URL);
    }
}
