<?php

namespace App\Domain\SocialCrawler;

use App\Domain\Event\Core\EventUrl;

interface SocialCrawler
{

    /**
     * @param EventUrl $eventUrl
     * @return mixed
     */
    public function crawl(EventUrl $eventUrl);

}
