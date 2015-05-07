<?php

namespace App\Console\Commands\EventCrawler;

use App\Application\EventCrawler\AtndCrawlerApplication;
use App\Application\EventCrawler\CrawlerApplication;
use Illuminate\Console\Command;

/**
 * 注意）app/Console/Kernel.phpへの追加を忘れないこと！
 *
 * 実行方法：php artisan crawler:atnd
 */
class AtndCrawlerCommand extends Command
{

    use CrawlerCommand;

    protected $name = 'crawler:atnd';
    protected $description = "クローラコマンド：Atnd";

    /** @var CrawlerApplication */
    private $crawlerApplication;

    /**
     * コンストラクタ
     *
     * @param AtndCrawlerApplication $crawlerApplication
     */
    public function __construct(AtndCrawlerApplication $crawlerApplication)
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
