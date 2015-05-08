<?php

namespace App\Console\Commands\SocialCrawler;

use App\Application\EventUrlListReference\EventUrlListReferenceApplication;
use App\Application\SocialCrawler\FacebookCrawlerApplication;
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

    /** @var FacebookCrawlerApplication */
    private $facebookCrawlerApplication;

    /**
     * コンストラクタ
     *
     * @param EventUrlListReferenceApplication $eventUrlListReferenceApplication
     * @param TwitterCrawlerApplication $twitterCrawlerApplication
     */
    public function __construct(EventUrlListReferenceApplication $eventUrlListReferenceApplication,
                                TwitterCrawlerApplication $twitterCrawlerApplication,
                                FacebookCrawlerApplication $facebookCrawlerApplication)
    {
        parent::__construct();

        $this->eventUrlListReferenceApplication = $eventUrlListReferenceApplication;
        $this->twitterCrawlerApplication = $twitterCrawlerApplication;
        $this->facebookCrawlerApplication = $facebookCrawlerApplication;
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
            //$this->dispatch(new TwitterCountCrawlerCommand($eventUrl));
            //$this->dispatch(new FacebookCountCrawlerCommand($eventUrl));
            $this->twitterCrawlerApplication->crawl($eventUrl);
            $this->facebookCrawlerApplication->crawl($eventUrl);
        }
        echo 'success';
    }

}
