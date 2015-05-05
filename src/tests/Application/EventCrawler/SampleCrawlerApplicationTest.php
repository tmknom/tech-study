<?php

namespace Application\EventCrawler;

use App\Application\EventCrawler\SampleCrawlerApplication;
use App\Library\Http\HttpClient;
use TestCase;
use Tests\Infrastructure\EventCrawler\Stub\SampleHttpClient;

class SampleCrawlerApplicationTest extends TestCase
{

    /** @var SampleCrawlerApplication */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        $this->app->bind(HttpClient::class, SampleHttpClient::class);
        $this->sut = $this->app->make(SampleCrawlerApplication::class);
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
