<?php

namespace App\Application\EventCrawler;

use App\Domain\EventCrawler\AtndCrawler;

class AtndCrawlerApplication
{

    /** @var AtndCrawler */
    private $atndCrawler;

    /** コンストラクタ */
    public function __construct(AtndCrawler $atndCrawler)
    {
        $this->atndCrawler = $atndCrawler;
    }

    /**
     * @return EventList
     */
    public function crawl()
    {
        return $this->atndCrawler->crawl();
    }

}
