<?php

namespace Tests\Infrastructure\EventCrawler;

use App\Infrastructure\EventCrawler\RestSampleCrawler;
use App\Infrastructure\EventCrawler\RestAtndCrawler;
use PHPUnit_Framework_TestCase;
use Tests\Infrastructure\EventCrawler\Stub\AtndHttpClient;

class RestAtndCrawlerTest extends PHPUnit_Framework_TestCase
{

    /** @var RestSampleCrawler */
    private $sut;

    /** @before */
    public function setUp()
    {
        $this->sut = new RestAtndCrawler(new AtndHttpClient());
    }

    /** @test */
    public function crawl_正常系()
    {
        // 実行
        $actual = json_decode($this->sut->crawl(), true);

        // 確認
        $this->assertCount(3, $actual['events']);
        $this->assertEquals('サンプルイベント1', $actual['events'][0]['event']['title']);
    }

}
