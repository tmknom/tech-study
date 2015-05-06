<?php

namespace App\Application\EventCrawler;

use App\Domain\Event\EventList;

interface CrawlerApplication
{

    /**
     * @return EventList
     */
    public function crawl();

}
