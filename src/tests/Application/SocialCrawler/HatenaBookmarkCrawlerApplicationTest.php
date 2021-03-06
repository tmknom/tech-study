<?php

namespace Tests\Application\SocialCrawler;

use App\Application\SocialCrawler\HatenaBookmarkCrawlerApplication;
use App\Domain\Rating\RatingCount\HatenaBookmarkCount;
use App\Library\Http\HttpClient;
use Tests\Base\TestCase;
use Tests\Fixture\Builder\TestEventBuilder;
use Tests\Fixture\Seeder\EventRatingSeeder;
use Tests\Fixture\Seeder\EventSeeder;
use Tests\Fixture\Stub\Social\HatenaBookmark\HatenaBookmarkHttpClient;

class HatenaBookmarkCrawlerApplicationTest extends TestCase
{

    /** @var HatenaBookmarkCrawlerApplication */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        $this->app->bind(HttpClient::class, HatenaBookmarkHttpClient::class);
        $this->sut = $this->app->make(HatenaBookmarkCrawlerApplication::class);
    }

    /** @test */
    public function crawl_正常系()
    {
        // 事前準備：DBに初期データをセット
        $this->seed(EventSeeder::class);
        $this->seed(EventRatingSeeder::class);

        // 事前準備
        $eventUrl = TestEventBuilder::builder()->build()->getEventCore()->getEventUrl();

        // 実行
        $actual = $this->sut->crawl($eventUrl);

        // 確認
        $this->assertEquals(new HatenaBookmarkCount(13), $actual);
    }

}
