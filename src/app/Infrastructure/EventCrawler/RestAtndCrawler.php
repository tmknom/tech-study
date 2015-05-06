<?php

namespace App\Infrastructure\EventCrawler;

use App\Domain\EventCrawler\AtndCrawler;
use App\Library\Http\HttpClient;

class RestAtndCrawler implements AtndCrawler
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

}
