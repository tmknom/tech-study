<?php

namespace App\Application\EventCrawler;

use App\Domain\Event\EventRepository;
use App\Domain\EventCrawler\PartakeCrawler;

class PartakeCrawlerApplication implements CrawlerApplication
{

    use TransactionCrawlerApplication;

    /**
     * コンストラクタ
     *
     * @param PartakeCrawler $crawler
     * @param EventRepository $eventRepository
     */
    public function __construct(PartakeCrawler $crawler, EventRepository $eventRepository)
    {
        $this->constructByCaller($crawler, $eventRepository);
    }

}
