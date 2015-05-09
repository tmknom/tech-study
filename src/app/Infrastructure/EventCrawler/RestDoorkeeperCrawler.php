<?php

namespace App\Infrastructure\EventCrawler;

use App\Domain\Event\EventList;
use App\Domain\EventCrawler\DoorkeeperCrawler;
use App\Infrastructure\EventCrawler\Mapper\DoorkeeperMapper;
use App\Library\Http\JsonHttpClient;

class RestDoorkeeperCrawler implements DoorkeeperCrawler
{

    /** @var string APIのURL */
    const URL = 'http://api.doorkeeper.jp/events';

    /** @var JsonHttpClient */
    private $jsonHttpClient;

    /** @var DoorkeeperMapper */
    private $doorkeeperMapper;

    /** コンストラクタ */
    public function __construct(JsonHttpClient $jsonHttpClient)
    {
        $this->jsonHttpClient = $jsonHttpClient;
        $this->doorkeeperMapper = new DoorkeeperMapper();
    }

    /**
     * @return EventList
     */
    public function crawl()
    {
        $json = $this->jsonHttpClient->request(self::URL);
        return $this->doorkeeperMapper->createEventList($json);
    }

}
