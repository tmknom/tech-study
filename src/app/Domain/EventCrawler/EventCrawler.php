<?php

namespace App\Domain\EventCrawler;

use App\Domain\Event\EventList;

interface EventCrawler
{

    /**
     * @return EventList
     */
    public function crawl();

}
