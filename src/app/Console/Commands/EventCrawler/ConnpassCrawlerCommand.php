<?php

namespace App\Console\Commands\EventCrawler;

use App\Application\EventCrawler\ConnpassCrawlerApplication;
use Illuminate\Console\Command;

/**
 * 注意）app/Console/Kernel.phpへの追加を忘れないこと！
 *
 * 実行方法：php artisan crawler:connpass
 */
class ConnpassCrawlerCommand extends Command
{

    use CrawlerCommand;

    const COMMAND_NAME = 'crawler:connpass';

    protected $name = self::COMMAND_NAME;
    protected $description = "クローラコマンド：Connpass";

    /**
     * コンストラクタ
     *
     * @param ConnpassCrawlerApplication $crawlerApplication
     */
    public function __construct(ConnpassCrawlerApplication $crawlerApplication)
    {
        parent::__construct();
        $this->construct($crawlerApplication);
    }

}
