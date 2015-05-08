<?php

namespace App\Console\Commands\SocialCrawler;

use App\Application\EventUrlListReference\EventUrlListReferenceApplication;
use App\Application\SocialCrawler\TwitterCrawlerApplication;
use Illuminate\Console\Command;

/**
 * 注意）app/Console/Kernel.phpへの追加を忘れないこと！
 *
 * 実行方法：php artisan crawler:social
 */
class SocialCrawlerCommand extends Command
{

    protected $name = 'crawler:social';
    protected $description = "クローラコマンド：social";

    /** @var EventUrlListReferenceApplication */
    private $eventUrlListReferenceApplication;

    /** @var TwitterCrawlerApplication */
    private $twitterCrawlerApplication;

    /**
     * コンストラクタ
     *
     * @param EventUrlListReferenceApplication $eventUrlListReferenceApplication
     * @param TwitterCrawlerApplication $twitterCrawlerApplication
     */
    public function __construct(EventUrlListReferenceApplication $eventUrlListReferenceApplication,
                                TwitterCrawlerApplication $twitterCrawlerApplication)
    {
        parent::__construct();

        $this->eventUrlListReferenceApplication = $eventUrlListReferenceApplication;
        $this->twitterCrawlerApplication = $twitterCrawlerApplication;
    }

    /**
     * コマンド呼び出し時に実行
     */
    public function fire()
    {
        // クロールするURL一覧を取得
        $eventUrlList = $this->eventUrlListReferenceApplication->referRecent();
        // それぞれのURLについて各ソーシャルサービスをクロール
        foreach ($eventUrlList->toArray() as $eventUrl) {
            $this->twitterCrawlerApplication->crawl($eventUrl);
        }
        echo 'success';
    }

}
