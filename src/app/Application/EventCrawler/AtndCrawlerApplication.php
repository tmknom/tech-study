<?php

namespace App\Application\EventCrawler;

use App\Domain\Event\EventRepository;
use App\Domain\EventCrawler\AtndCrawler;

class AtndCrawlerApplication
{

    use TransactionCrawlerApplication;

    /** コンストラクタ */
    public function __construct(AtndCrawler $crawler, EventRepository $eventRepository)
    {
        $this->constructByCaller($crawler, $eventRepository);
    }

}
