<?php

namespace App\Console\Commands\Crawler;

use App\Application\EventCrawler\AtndCrawlerApplication;
use Illuminate\Console\Command;

/**
 * 注意）app/Console/Kernel.phpへの追加を忘れないこと！
 *
 * 実行方法：php artisan crawler:atnd
 */
class AtndCrawlerCommand extends Command
{

    protected $name = 'crawler:atnd';
    protected $description = "クローラコマンド：Atnd";

    /** @var AtndCrawlerApplication */
    private $atndCrawlerApplication;

    public function __construct(AtndCrawlerApplication $atndCrawlerApplication)
    {
        parent::__construct();

        $this->atndCrawlerApplication = $atndCrawlerApplication;
    }

    public function fire()
    {
        $startTime = microtime(true);
        $result = $this->atndCrawlerApplication->crawl();
        $resultTime = " : 実行時間" . number_format(microtime(true) - $startTime, 3) . '秒だぜぇ';
        $this->info(var_dump($result) . $resultTime);
    }

}
