<?php

namespace Tests\Application\SocialCrawler;

use App\Application\SocialCrawler\TwitterCrawlerApplication;
use App\Domain\Event\Core\EventUrl;
use App\Domain\Event\Rating\TwitterCount;
use App\Library\Http\JsonHttpClient;
use Tests\Base\TestCase;
use Tests\Infrastructure\SocialCrawler\Stub\TwitterJsonHttpClient;

class TwitterCrawlerApplicationTest extends TestCase
{

    /** @var TwitterCrawlerApplication */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        $this->app->bind(JsonHttpClient::class, TwitterJsonHttpClient::class);
        $this->sut = $this->app->make(TwitterCrawlerApplication::class);
    }

    /** @test */
    public function crawl_正常系()
    {
        // 事前準備
        $eventUrl = new EventUrl('http://localhost/');

        // 実行
        $actual = $this->sut->crawl($eventUrl);

        // 確認
        $this->assertEquals(new TwitterCount(50), $actual);
    }

}
