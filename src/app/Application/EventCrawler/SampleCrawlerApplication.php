<?php

namespace App\Application\EventCrawler;

class SampleCrawlerApplication
{

    /** コンストラクタ */
    public function __construct()
    {
    }

    public function crawl(){
        return SampleCrawlerApplication::class;
    }
}
