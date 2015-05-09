<?php

namespace App\Console\Commands\SocialCrawler;

use App\Application\EventUrlListReference\EventUrlListReferenceApplication;
use App\Application\SocialCrawler\FacebookCrawlerApplication;
use App\Application\SocialCrawler\GooglePlusCrawlerApplication;
use App\Application\SocialCrawler\HatenaBookmarkCrawlerApplication;
use App\Application\SocialCrawler\PocketCrawlerApplication;
use App\Application\SocialCrawler\TwitterCrawlerApplication;
use App\Commands\SocialCrawler;
use App\Domain\Event\Core\EventUrl;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesCommands;

/**
 * 注意）app/Console/Kernel.phpへの追加を忘れないこと！
 *
 * 実行方法：php artisan crawler:social
 */
class SocialCrawlerCommand extends Command
{

    use DispatchesCommands;

    protected $name = 'crawler:social';
    protected $description = "クローラコマンド：social";

    /** @var EventUrlListReferenceApplication */
    private $eventUrlListReferenceApplication;

    /**
     * コンストラクタ
     *
     * @param EventUrlListReferenceApplication $eventUrlListReferenceApplication
     */
    public function __construct(EventUrlListReferenceApplication $eventUrlListReferenceApplication)
    {
        parent::__construct();

        $this->eventUrlListReferenceApplication = $eventUrlListReferenceApplication;
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
            $this->crawlByQueue(TwitterCrawlerApplication::class, $eventUrl);
            $this->crawlByQueue(FacebookCrawlerApplication::class, $eventUrl);
            $this->crawlByQueue(HatenaBookmarkCrawlerApplication::class, $eventUrl);
            $this->crawlByQueue(PocketCrawlerApplication::class, $eventUrl);
            $this->crawlByQueue(GooglePlusCrawlerApplication::class, $eventUrl);
        }
        echo json_encode(['result' => 'success']) . PHP_EOL;
    }

    /**
     * キュー経由でクロール処理実行
     *
     * @param string $socialCrawlerApplicationClass
     * @param EventUrl $eventUrl
     */
    private function crawlByQueue($socialCrawlerApplicationClass, EventUrl $eventUrl)
    {
        $this->dispatch(new SocialCrawler($socialCrawlerApplicationClass, $eventUrl));
    }

}
