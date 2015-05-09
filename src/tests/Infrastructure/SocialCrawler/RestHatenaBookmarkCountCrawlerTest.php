<?php

namespace Tests\Infrastructure\SocialCrawler;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Rating\RatingCount\HatenaBookmarkCount;
use App\Infrastructure\SocialCrawler\RestHatenaBookmarkCountCrawler;
use PHPUnit_Framework_TestCase;
use Tests\Fixture\Stub\Social\HatenaBookmark\EmptyHatenaBookmarkHttpClient;
use Tests\Fixture\Stub\Social\HatenaBookmark\HatenaBookmarkHttpClient;

class RestHatenaBookmarkCountCrawlerTest extends PHPUnit_Framework_TestCase
{

    /** @var RestHatenaBookmarkCountCrawler */
    private $sut;

    /** @before */
    public function setUp()
    {
        
    }

    /** @test */
    public function crawl_正常系_値が取得できる場合()
    {
        // 事前準備
        $this->sut = new RestHatenaBookmarkCountCrawler(new HatenaBookmarkHttpClient());
        $eventUrl = new EventUrl('http://localhost/');

        // 実行
        $actual = $this->sut->crawl($eventUrl);

        // 確認
        $this->assertEquals(new HatenaBookmarkCount(13), $actual);
    }

    /** @test */
    public function crawl_正常系_値が取得できない場合()
    {
        // 事前準備
        $this->sut = new RestHatenaBookmarkCountCrawler(new EmptyHatenaBookmarkHttpClient());
        $eventUrl = new EventUrl('http://localhost/');

        // 実行
        $actual = $this->sut->crawl($eventUrl);

        // 確認
        $this->assertEquals(new HatenaBookmarkCount(0), $actual);
    }

}
