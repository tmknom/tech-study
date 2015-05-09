<?php

namespace Tests\Application\EventCrawler;

use App\Application\EventCrawler\ConnpassCrawlerApplication;
use App\Domain\Event\EventList;
use App\Library\Http\JsonHttpClient;
use Tests\Base\TestCase;
use Tests\Fixture\Stub\Event\ConnpassJsonHttpClient;

class ConnpassCrawlerApplicationTest extends TestCase
{

    /** @var ConnpassCrawlerApplication */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        $this->app->bind(JsonHttpClient::class, ConnpassJsonHttpClient::class);
        $this->sut = $this->app->make(ConnpassCrawlerApplication::class);
    }

    /** @test */
    public function crawl_正常系()
    {
        // 実行
        $actual = $this->sut->crawl();

        // 確認
        $this->assertTrue($actual instanceof EventList);
        $this->assertEquals(2, $actual->count());
        $this->assertEquals('Haskell 超入門 (2014/11)', $actual->get(0)->getEventCore()->getEventTitle());
    }

}
