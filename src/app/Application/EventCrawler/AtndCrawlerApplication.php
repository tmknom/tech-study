<?php

namespace App\Application\EventCrawler;

use App\Domain\Event\EventRepository;
use App\Domain\EventCrawler\AtndCrawler;

class AtndCrawlerApplication implements CrawlerApplication
{

    use TransactionCrawlerApplication;

    /**
     * コンストラクタ
     *
     * @param AtndCrawler $crawler
     * @param EventRepository $eventRepository
     */
    public function __construct(AtndCrawler $crawler, EventRepository $eventRepository)
    {
        $this->constructByCaller($crawler, $eventRepository);
    }

}
