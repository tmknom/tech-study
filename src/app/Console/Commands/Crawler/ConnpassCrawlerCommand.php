<?php

namespace App\Console\Commands\Crawler;

use App\Application\EventCrawler\ConnpassCrawlerApplication;
use App\Application\EventCrawler\CrawlerApplication;
use Illuminate\Console\Command;

/**
 * 注意）app/Console/Kernel.phpへの追加を忘れないこと！
 *
 * 実行方法：php artisan crawler:connpass
 */
class ConnpassCrawlerCommand extends Command
{

    use CrawlerCommand;

    protected $name = 'crawler:connpass';
    protected $description = "クローラコマンド：Connpass";

    /** @var CrawlerApplication */
    private $crawlerApplication;

    /**
     * コンストラクタ
     *
     * @param ConnpassCrawlerApplication $crawlerApplication
     */
    public function __construct(ConnpassCrawlerApplication $crawlerApplication)
    {
        parent::__construct();

        $this->crawlerApplication = $crawlerApplication;
    }

    /**
     * コマンド呼び出し時に実行
     */
    public function fire()
    {
        $this->executeWithMeasureTime($this->crawlerApplication);
    }

}
