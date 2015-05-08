<?php

namespace Tests\Application\SocialCrawler;

use App\Application\SocialCrawler\FacebookCrawlerApplication;
use App\Domain\Rating\RatingCount\FacebookCount;
use App\Library\Http\JsonHttpClient;
use Tests\Base\TestCase;
use Tests\Fixture\Builder\TestEventBuilder;
use Tests\Fixture\Seeder\EventRatingSeeder;
use Tests\Fixture\Seeder\EventSeeder;
use Tests\Infrastructure\SocialCrawler\Stub\Facebook\FacebookJsonHttpClient;

class FacebookCrawlerApplicationTest extends TestCase
{

    /** @var FacebookCrawlerApplication */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        $this->app->bind(JsonHttpClient::class, FacebookJsonHttpClient::class);
        $this->sut = $this->app->make(FacebookCrawlerApplication::class);
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
        $this->assertEquals(new FacebookCount(30), $actual);
    }

}
