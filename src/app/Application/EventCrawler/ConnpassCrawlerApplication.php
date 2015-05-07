<?php

namespace App\Application\EventCrawler;

use App\Domain\Event\EventRepository;
use App\Domain\EventCrawler\ConnpassCrawler;

class ConnpassCrawlerApplication implements CrawlerApplication
{

    use TransactionCrawlerApplication;

    /**
     * コンストラクタ
     *
     * @param ConnpassCrawler $crawler
     * @param EventRepository $eventRepository
     */
    public function __construct(ConnpassCrawler $crawler, EventRepository $eventRepository)
    {
        $this->constructByCaller($crawler, $eventRepository);
    }

}
