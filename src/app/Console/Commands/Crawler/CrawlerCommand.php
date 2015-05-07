<?php

namespace App\Console\Commands\Crawler;

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

        $result = $crawlerApplication->crawl();
        $this->info(var_dump($result));

        $resultTime = "実行時間" . number_format(microtime(true) - $startTime, 3) . '秒だぜぇ';
        $this->info($resultTime);
    }

}
