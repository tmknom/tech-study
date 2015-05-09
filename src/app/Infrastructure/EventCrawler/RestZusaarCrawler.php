<?php

namespace App\Infrastructure\EventCrawler;

use App\Domain\Event\EventList;
use App\Domain\EventCrawler\ZusaarCrawler;
use App\Infrastructure\EventCrawler\Mapper\ZusaarMapper;
use App\Library\Http\JsonHttpClient;

class RestZusaarCrawler implements ZusaarCrawler
{

    /** @var string APIのURL */
    const URL = 'http://www.zusaar.com/api/event/';

    /** @var JsonHttpClient */
    private $jsonHttpClient;

    /** @var ZusaarMapper */
    private $zusaarMapper;

    /** コンストラクタ */
    public function __construct(JsonHttpClient $jsonHttpClient)
    {
        $this->jsonHttpClient = $jsonHttpClient;
        $this->zusaarMapper = new ZusaarMapper();
    }

    /**
     * @return EventList
     */
    public function crawl()
    {
        $json = $this->jsonHttpClient->request(self::URL);
        return $this->zusaarMapper->createEventList($json);
    }

}
