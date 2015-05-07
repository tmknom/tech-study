<?php

namespace App\Console\Commands\SocialCrawler;

use App\Application\EventUrlListReference\EventUrlListReferenceApplication;
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
            $this->info($eventUrl);
        }
    }

}
