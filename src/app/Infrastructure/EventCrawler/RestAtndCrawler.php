<?php

namespace App\Infrastructure\EventCrawler;

use App\Domain\EventCrawler\AtndCrawler;
use App\Library\Http\JsonHttpClient;

class RestAtndCrawler implements AtndCrawler
{

    /** @var JsonHttpClient */
    private $jsonHttpClient;

    /** @var string APIのURL */
    const URL = 'http://api.atnd.org/events/?format=json&count=30';

    /** コンストラクタ */
    public function __construct(JsonHttpClient $jsonHttpClient)
    {
        $this->jsonHttpClient = $jsonHttpClient;
    }

    public function crawl()
    {
        $json = $this->jsonHttpClient->request(self::URL);
        return $json;
//        return $this->atndJsonMapper->createEventList($this->requestApi());
    }

}
