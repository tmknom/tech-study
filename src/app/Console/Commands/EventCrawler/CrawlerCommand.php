<?php

namespace App\Console\Commands\EventCrawler;

use App\Application\EventCrawler\CrawlerApplication;

trait CrawlerCommand
{

    /**
     * 実行時間の計測をしながら、クロール処理を実行
     *
     * @param CrawlerApplication $crawlerApplication
     */
    public function executeWithMeasureTime(CrawlerApplication $crawlerApplication)
    {
        $startTime = microtime(true);
        $eventList = $crawlerApplication->crawl();
        $resultTime = $eventList->count() . "件／実行時間" . number_format(microtime(true) - $startTime, 3) . '秒だぜぇ';
        echo $resultTime;
    }

}
