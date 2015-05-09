<?php

namespace App\Application\EventCrawler;

use App\Domain\Event\EventRepository;
use App\Domain\EventCrawler\ZusaarCrawler;

class ZusaarCrawlerApplication implements CrawlerApplication
{

    use TransactionCrawlerApplication;

    /**
     * コンストラクタ
     *
     * @param ZusaarCrawler $crawler
     * @param EventRepository $eventRepository
     */
    public function __construct(ZusaarCrawler $crawler, EventRepository $eventRepository)
    {
        $this->constructByCaller($crawler, $eventRepository);
    }

}
