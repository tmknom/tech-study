<?php

namespace App\Application\EventCrawler;

use App\Domain\Event\EventRepository;
use App\Domain\EventCrawler\DoorkeeperCrawler;

class DoorkeeperCrawlerApplication implements CrawlerApplication
{

    use TransactionCrawlerApplication;

    /**
     * コンストラクタ
     *
     * @param DoorkeeperCrawler $crawler
     * @param EventRepository $eventRepository
     */
    public function __construct(DoorkeeperCrawler $crawler, EventRepository $eventRepository)
    {
        $this->constructByCaller($crawler, $eventRepository);
    }

}
