<?php

namespace Tests\Infrastructure\SocialCrawler;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Rating\RatingCount\GooglePlusCount;
use App\Infrastructure\SocialCrawler\RestGooglePlusCountCrawler;
use PHPUnit_Framework_TestCase;
use Tests\Fixture\Stub\Social\GooglePlus\GooglePlusHttpClient;

class RestGooglePlusCountCrawlerTest extends PHPUnit_Framework_TestCase
{

    /** @var RestGooglePlusCountCrawler */
    private $sut;

    /** @before */
    public function setUp()
    {
        $this->sut = new RestGooglePlusCountCrawler(new GooglePlusHttpClient());
    }

    /** @test */
    public function crawl_正常系()
    {
        // 事前準備
        $eventUrl = new EventUrl('http://localhost/');

        // 実行
        $actual = $this->sut->crawl($eventUrl);

        // 確認
        $this->assertEquals(new GooglePlusCount(40), $actual);
    }

}
