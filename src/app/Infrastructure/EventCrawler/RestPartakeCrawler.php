<?php

namespace App\Infrastructure\EventCrawler;

use App\Domain\Event\EventList;
use App\Domain\EventCrawler\PartakeCrawler;
use App\Infrastructure\EventCrawler\Mapper\PartakeMapper;
use App\Library\Http\JsonHttpClient;

class RestPartakeCrawler implements PartakeCrawler
{

    /** @var string APIのURL */
    const URL = 'http://partake.in/api/event/search';

    /** @var JsonHttpClient */
    private $jsonHttpClient;

    /** @var PartakeMapper */
    private $atndMapper;

    /** コンストラクタ */
    public function __construct(JsonHttpClient $jsonHttpClient)
    {
        $this->jsonHttpClient = $jsonHttpClient;
        $this->atndMapper = new PartakeMapper();
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
