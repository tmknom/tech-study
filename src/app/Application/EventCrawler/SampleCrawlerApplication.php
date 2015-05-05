<?php

namespace App\Application\EventCrawler;

use App\Domain\EventCrawler\SampleCrawler;

class SampleCrawlerApplication
{

    /** @var SampleCrawler */
    private $sampleCrawler;

    /** コンストラクタ */
    public function __construct(SampleCrawler $sampleCrawler)
    {
        $this->sampleCrawler = $sampleCrawler;
    }

    public function crawl(){
        return $this->sampleCrawler->crawl();
    }
}
