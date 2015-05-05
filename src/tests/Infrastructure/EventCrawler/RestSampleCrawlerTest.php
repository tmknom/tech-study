<?php

namespace Tests\Infrastructure\EventCrawler;

use App\Infrastructure\EventCrawler\RestSampleCrawler;
use PHPUnit_Framework_TestCase;
use Tests\Infrastructure\EventCrawler\Stub\SampleHttpClient;

class RestSampleCrawlerTest extends PHPUnit_Framework_TestCase
{

    /** @var RestSampleCrawler */
    private $sut;

    /** @before */
    public function setUp()
    {
        $this->sut = new RestSampleCrawler(new SampleHttpClient());
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
