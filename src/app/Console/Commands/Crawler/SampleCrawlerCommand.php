<?php

namespace App\Console\Commands\Crawler;

use Illuminate\Console\Command;

/**
 * 注意）app/Console/Kernel.phpへの追加を忘れないこと！
 *
 * 実行方法：php artisan crawler:sample
 */
class SampleCrawlerCommand extends Command
{

    protected $name = 'crawler:sample';
    protected $description = "クローラコマンド：sample";

    public function __construct()
    {
        parent::__construct();
    }

    public function fire()
    {
        $startTime = microtime(true);
        sleep(1);
        $result = "実行時間" . number_format(microtime(true) - $startTime, 3) . '秒だぜぇ';
        $this->info($result);
    }

}
