<?php

namespace App\Console\Commands\EventCrawler;

use App\Application\EventCrawler\ZusaarCrawlerApplication;
use Illuminate\Console\Command;

/**
 * 注意）app/Console/Kernel.phpへの追加を忘れないこと！
 *
 * 実行方法：php artisan crawler:zusaar
 */
class ZusaarCrawlerCommand extends Command
{

    use CrawlerCommand;

    const COMMAND_NAME = 'crawler:zusaar';

    protected $name = self::COMMAND_NAME;
    protected $description = "クローラコマンド：Zusaar";

    /**
     * コンストラクタ
     *
     * @param ZusaarCrawlerApplication $crawlerApplication
     */
    public function __construct(ZusaarCrawlerApplication $crawlerApplication)
    {
        parent::__construct();
        $this->construct($crawlerApplication);
    }

}
