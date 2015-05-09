<?php

namespace Tests\Infrastructure\SocialCrawler;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Rating\RatingCount\TwitterCount;
use App\Infrastructure\SocialCrawler\RestTwitterCountCrawler;
use PHPUnit_Framework_TestCase;
use Tests\Fixture\Stub\Social\Twitter\TwitterJsonHttpClient;

class RestTwitterCountCrawlerTest extends PHPUnit_Framework_TestCase
{

    /** @var RestTwitterCountCrawler */
    private $sut;

    /** @before */
    public function setUp()
    {
        $this->sut = new RestTwitterCountCrawler(new TwitterJsonHttpClient());
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
