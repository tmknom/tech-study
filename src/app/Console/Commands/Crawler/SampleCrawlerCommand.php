<?php

namespace App\Console\Commands\Crawler;

use Illuminate\Console\Command;
use App\Application\EventCrawler\SampleCrawlerApplication;

/**
 * 注意）app/Console/Kernel.phpへの追加を忘れないこと！
 *
 * 実行方法：php artisan crawler:sample
 */
class SampleCrawlerCommand extends Command
{

    protected $name = 'crawler:sample';
    protected $description = "クローラコマンド：sample";

    /** @var SampleCrawlerApplication */
    private $sampleCrawlerApplication;

    public function __construct(SampleCrawlerApplication $sampleCrawlerApplication)
    {
        parent::__construct();

        $this->sampleCrawlerApplication = $sampleCrawlerApplication;
    }

    public function fire()
    {
        $startTime = microtime(true);
        $result = $this->sampleCrawlerApplication->crawl();
        $resultTime = " : 実行時間" . number_format(microtime(true) - $startTime, 3) . '秒だぜぇ';
        $this->info($result . $resultTime);
    }

}
