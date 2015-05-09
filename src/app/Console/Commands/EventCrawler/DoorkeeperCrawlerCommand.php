<?php

namespace App\Console\Commands\EventCrawler;

use App\Application\EventCrawler\DoorkeeperCrawlerApplication;
use Illuminate\Console\Command;

/**
 * 注意）app/Console/Kernel.phpへの追加を忘れないこと！
 *
 * 実行方法：php artisan crawler:doorkeeper
 */
class DoorkeeperCrawlerCommand extends Command
{

    use CrawlerCommand;

    const COMMAND_NAME = 'crawler:doorkeeper';

    protected $name = self::COMMAND_NAME;
    protected $description = "クローラコマンド：Doorkeeper";

    /**
     * コンストラクタ
     *
     * @param DoorkeeperCrawlerApplication $crawlerApplication
     */
    public function __construct(DoorkeeperCrawlerApplication $crawlerApplication)
    {
        parent::__construct();
        $this->construct($crawlerApplication);
    }

}
