<?php

namespace App\Infrastructure\EventCrawler;

use App\Domain\Event\EventList;
use App\Domain\EventCrawler\ConnpassCrawler;
use App\Infrastructure\EventCrawler\Mapper\ConnpassMapper;
use App\Library\Http\JsonHttpClient;

class RestConnpassCrawler implements ConnpassCrawler
{

    /** @var string APIのURL */
    const URL = 'http://connpass.com/api/v1/event/';

    /** @var JsonHttpClient */
    private $jsonHttpClient;

    /** @var ConnpassMapper */
    private $mapper;

    /** コンストラクタ */
    public function __construct(JsonHttpClient $jsonHttpClient)
    {
        $this->jsonHttpClient = $jsonHttpClient;
        $this->mapper = new ConnpassMapper();
    }

    /**
     * @return EventList
     */
    public function crawl()
    {
        $json = $this->jsonHttpClient->request(self::URL);
        return $this->mapper->createEventList($json);
    }

}
