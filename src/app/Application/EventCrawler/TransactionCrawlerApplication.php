<?php

namespace App\Application\EventCrawler;

use App\Domain\Event\EventList;
use App\Domain\Event\EventRepository;
use App\Domain\EventCrawler\EventCrawler;
use DB;

trait TransactionCrawlerApplication
{

    /**  @var EventCrawler */
    private $crawler;

    /**  @var EventRepository */
    private $eventRepository;

    /**  @var EventList */
    private $savedEventList;

    /**
     * 呼び出し元クラスから呼び出すコンストラクタ
     *
     * @param EventCrawler $crawler
     * @param EventRepository $eventRepository
     */
    private function constructByCaller(EventCrawler $crawler, EventRepository $eventRepository)
    {
        $this->crawler = $crawler;
        $this->eventRepository = $eventRepository;
        $this->savedEventList = null;
    }

    /**
     * @return EventList
     */
    public function crawl()
    {
        DB::transaction(function () {
            // JSON APIのリクエスト
            $eventList = $this->crawler->crawl();

            // MySQLへの登録
            $this->savedEventList = $this->eventRepository->saveAll($eventList);

            // Elasticsearchへの登録
        });

        return $this->savedEventList;
    }

}
