<?php

namespace App\Infrastructure\EventCrawler;

use App\Domain\Event\EventList;
use App\Domain\EventCrawler\AtndCrawler;
use App\Infrastructure\EventCrawler\Mapper\AtndMapper;
use App\Library\Http\JsonHttpClient;

class RestAtndCrawler implements AtndCrawler
{

    /** @var string APIのURL */
    const URL = 'http://api.atnd.org/events/?format=json&count=30';

    /** @var JsonHttpClient */
    private $jsonHttpClient;

    /** @var AtndMapper */
    private $atndMapper;

    /** コンストラクタ */
    public function __construct(JsonHttpClient $jsonHttpClient)
    {
        $this->jsonHttpClient = $jsonHttpClient;
        $this->atndMapper = new AtndMapper();
    }

    /**
     * @return EventList
     */
    public function crawl()
    {
        $json = $this->jsonHttpClient->request(self::URL);
        return $this->atndMapper->createEventList($json);
    }

}
