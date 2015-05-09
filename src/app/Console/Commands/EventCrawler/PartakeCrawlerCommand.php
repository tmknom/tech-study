<?php

namespace App\Console\Commands\EventCrawler;

use App\Application\EventCrawler\PartakeCrawlerApplication;
use Illuminate\Console\Command;

/**
 * 注意）app/Console/Kernel.phpへの追加を忘れないこと！
 *
 * 実行方法：php artisan crawler:partake
 */
class PartakeCrawlerCommand extends Command
{

    use CrawlerCommand;

    const COMMAND_NAME = 'crawler:partake';

    protected $name = self::COMMAND_NAME;
    protected $description = "クローラコマンド：Partake";

    /**
     * コンストラクタ
     *
     * @param PartakeCrawlerApplication $crawlerApplication
     */
    public function __construct(PartakeCrawlerApplication $crawlerApplication)
    {
        parent::__construct();
        $this->construct($crawlerApplication);
    }

}
