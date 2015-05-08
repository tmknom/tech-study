<?php

namespace Tests\Infrastructure\SocialCrawler;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Rating\RatingCount\FacebookCount;
use App\Infrastructure\SocialCrawler\RestFacebookCountCrawler;
use PHPUnit_Framework_TestCase;
use Tests\Infrastructure\SocialCrawler\Stub\Facebook\EmptyFacebookJsonHttpClient;
use Tests\Infrastructure\SocialCrawler\Stub\Facebook\FacebookJsonHttpClient;

class FacebookCountCrawlerTest extends PHPUnit_Framework_TestCase
{

    /** @var RestFacebookCountCrawler */
    private $sut;

    /** @before */
    public function setUp()
    {
        
    }

    /** @test */
    public function crawl_正常系_値が取得できる場合()
    {
        // 事前準備
        $this->sut = new RestFacebookCountCrawler(new FacebookJsonHttpClient());
        $eventUrl = new EventUrl('http://localhost/');

        // 実行
        $actual = $this->sut->crawl($eventUrl);

        // 確認
        $this->assertEquals(new FacebookCount(30), $actual);
    }

    /** @test */
    public function crawl_正常系_値が取得できない場合()
    {
        // 事前準備
        $this->sut = new RestFacebookCountCrawler(new EmptyFacebookJsonHttpClient());
        $eventUrl = new EventUrl('http://localhost/');

        // 実行
        $actual = $this->sut->crawl($eventUrl);

        // 確認
        $this->assertEquals(new FacebookCount(0), $actual);
    }

}
