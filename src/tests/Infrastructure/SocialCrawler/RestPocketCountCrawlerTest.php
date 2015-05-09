<?php

namespace Tests\Infrastructure\SocialCrawler;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Rating\RatingCount\PocketCount;
use App\Infrastructure\SocialCrawler\RestPocketCountCrawler;
use PHPUnit_Framework_TestCase;
use Tests\Fixture\Stub\Social\Pocket\PocketHttpClient;

class RestPocketCountCrawlerTest extends PHPUnit_Framework_TestCase
{

    /** @var RestPocketCountCrawler */
    private $sut;

    /** @before */
    public function setUp()
    {
        $this->sut = new RestPocketCountCrawler(new PocketHttpClient());
    }

    /** @test */
    public function crawl_正常系()
    {
        // 事前準備
        $eventUrl = new EventUrl('http://localhost/');

        // 実行
        $actual = $this->sut->crawl($eventUrl);

        // 確認
        $this->assertEquals(new PocketCount(200), $actual);
    }

}
