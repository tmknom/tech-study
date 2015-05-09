<?php

namespace App\Console\Commands\EventCrawler;

use App\Application\EventCrawler\CrawlerApplication;

trait CrawlerCommand
{

    /** @var CrawlerApplication */
    private $crawlerApplication;

    /**
     * 呼び出し元クラスから呼び出すコンストラクタ
     *
     * @param CrawlerApplication $crawlerApplication
     */
    private function construct(CrawlerApplication $crawlerApplication)
    {
        $this->crawlerApplication = $crawlerApplication;
    }

    /**
     * コマンド呼び出し時に実行
     */
    public function fire()
    {
        $this->executeWithMeasureTime($this->crawlerApplication);
    }

    /**
     * 実行時間の計測をしながら、クロール処理を実行
     *
     * @param CrawlerApplication $crawlerApplication
     */
    private function executeWithMeasureTime(CrawlerApplication $crawlerApplication)
    {
        $startTime = microtime(true);
        $eventList = $crawlerApplication->crawl();
        $executeTime = number_format(microtime(true) - $startTime, 3);
        echo json_encode(['event_count' => $eventList->count(), 'execute_time' => $executeTime]) . PHP_EOL;
    }

}
