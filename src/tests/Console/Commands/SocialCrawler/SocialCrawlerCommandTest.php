<?php

namespace Tests\Console\Commands\SocialCrawler;

use App\Application\EventUrlListReference\EventUrlListReferenceApplication;
use App\Console\Commands\SocialCrawler\SocialCrawlerCommand;
use App\Domain\Event\Core\EventUrl;
use App\Domain\Rating\RatingCount\FacebookCount;
use App\Domain\Rating\RatingCount\HatenaBookmarkCount;
use App\Domain\Rating\RatingCount\TwitterCount;
use App\Domain\SocialCrawler\FacebookCountCrawler;
use App\Domain\SocialCrawler\HatenaBookmarkCountCrawler;
use App\Domain\SocialCrawler\TwitterCountCrawler;
use Tests\Base\TestCase;
use Tests\Fixture\Seeder\EventRatingSeeder;
use Tests\Fixture\Seeder\EventSeeder;

class SocialCrawlerCommandTest extends TestCase
{

    /** @var SocialCrawlerCommand */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        $this->app->bind(TwitterCountCrawler::class, StubTwitterCountCrawler::class);
        $this->app->bind(FacebookCountCrawler::class, StubFacebookCountCrawler::class);
        $this->app->bind(HatenaBookmarkCountCrawler::class, StubHatenaBookmarkCountCrawler::class);

        $eventUrlListReferenceApplication = $this->app->make(EventUrlListReferenceApplication::class);
        $this->sut = new SocialCrawlerCommand($eventUrlListReferenceApplication);
    }

    /** @test */
    public function fire_正常系()
    {
        // 事前準備：DBに初期データをセット
        $this->seed(EventSeeder::class);
        $this->seed(EventRatingSeeder::class);

        // 事前準備：標準出力をバッファリング
        ob_start();

        // 実行
        $this->sut->fire();

        // 確認
        $this->assertEquals('crawler:social', $this->sut->getName());
        // 確認＆後始末：バッファリングした標準出力を取得して、バッファリングは終了
        $actual = ob_get_clean();
        $this->assertEquals('success', $actual);
    }

}

class StubTwitterCountCrawler implements TwitterCountCrawler
{

    public function crawl(EventUrl $eventUrl)
    {
        return new TwitterCount(0);
    }

}

class StubFacebookCountCrawler implements FacebookCountCrawler
{

    public function crawl(EventUrl $eventUrl)
    {
        return new FacebookCount(0);
    }

}

class StubHatenaBookmarkCountCrawler implements HatenaBookmarkCountCrawler
{

    public function crawl(EventUrl $eventUrl)
    {
        return new HatenaBookmarkCount(0);
    }

}
