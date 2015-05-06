<?php

namespace App\Infrastructure\EventCrawler;

use App\Domain\EventCrawler\SampleCrawler;
use App\Library\Http\HttpClient;

class RestSampleCrawler implements SampleCrawler
{

    /** @var HttpClient */
    private $httpClient;

    /** @var string APIのURL */
    const URL = 'http://api.atnd.org/events/?format=json&count=30';

    /** コンストラクタ */
    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function crawl()
    {
        return $this->httpClient->request(self::URL);
//        return $this->atndJsonMapper->createEventList($this->requestApi());
    }

    private function requestApi()
    {
////        return new JsonHttpResponse(json_decode(file_get_contents(app_path() . '/tests/fixtures/Atnd/atnd.json'), true), 200);
//        return $this->jsonRequest->request(self::URL);
    }

}
