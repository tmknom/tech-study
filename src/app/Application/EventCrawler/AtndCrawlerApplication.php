<?php

namespace App\Application\EventCrawler;

use App\Domain\Event\EventList;
use App\Domain\Event\EventRepository;
use App\Domain\EventCrawler\AtndCrawler;
use DB;

class AtndCrawlerApplication
{

    /** @var AtndCrawler */
    private $atndCrawler;

    /**  @var EventRepository */
    private $eventRepository;

    /**  @var EventList */
    private $savedEventList;

    /** コンストラクタ */
    public function __construct(AtndCrawler $atndCrawler, EventRepository $eventRepository)
    {
        $this->atndCrawler = $atndCrawler;
        $this->eventRepository = $eventRepository;
        $this->savedEventList = null;
    }

    /**
     * @return EventList
     */
    public function crawl()
    {
        DB::transaction(function () {
            //APIのリクエスト
            $eventList = $this->atndCrawler->crawl();

            // MySQLへの登録
            $this->savedEventList = $this->eventRepository->saveAll($eventList);

            // Elasticsearchへの登録
        });

        return $this->savedEventList;
    }

}
