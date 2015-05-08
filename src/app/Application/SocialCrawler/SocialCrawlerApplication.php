<?php

namespace App\Application\SocialCrawler;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Rating\RatingCount;

interface SocialCrawlerApplication
{

    /**
     * @param EventUrl $eventUrl
     * @return RatingCount
     */
    public function crawl(EventUrl $eventUrl);

}
