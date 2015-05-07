<?php

namespace App\Console\Commands\EventCrawler;

use App\Application\EventCrawler\AtndCrawlerApplication;
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

    /**
     * コンストラクタ
     *
     * @param AtndCrawlerApplication $crawlerApplication
     */
    public function __construct(AtndCrawlerApplication $crawlerApplication)
    {
        parent::__construct();
        $this->construct($crawlerApplication);
    }

}
