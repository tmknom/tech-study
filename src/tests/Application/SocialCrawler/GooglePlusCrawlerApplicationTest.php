<?php

namespace Tests\Application\SocialCrawler;

use App\Application\SocialCrawler\GooglePlusCrawlerApplication;
use App\Domain\Rating\RatingCount\GooglePlusCount;
use App\Library\Http\HttpClient;
use Tests\Base\TestCase;
use Tests\Fixture\Builder\TestEventBuilder;
use Tests\Fixture\Seeder\EventRatingSeeder;
use Tests\Fixture\Seeder\EventSeeder;
use Tests\Fixture\Stub\Social\GooglePlus\GooglePlusHttpClient;

class GooglePlusCrawlerApplicationTest extends TestCase
{

    /** @var GooglePlusCrawlerApplication */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        $this->app->bind(HttpClient::class, GooglePlusHttpClient::class);
        $this->sut = $this->app->make(GooglePlusCrawlerApplication::class);
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
        $this->assertEquals(new GooglePlusCount(40), $actual);
    }

}
