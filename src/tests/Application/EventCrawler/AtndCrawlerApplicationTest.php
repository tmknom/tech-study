<?php

namespace Tests\Application\EventCrawler;

use App\Application\EventCrawler\AtndCrawlerApplication;
use App\Domain\Event\Event;
use App\Domain\Event\EventList;
use App\Library\Http\JsonHttpClient;
use Tests\Base\TestCase;
use Tests\Infrastructure\EventCrawler\Stub\AtndJsonHttpClient;

class AtndCrawlerApplicationTest extends TestCase
{

    /** @var AtndCrawlerApplication */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        $this->app->bind(JsonHttpClient::class, AtndJsonHttpClient::class);
        $this->sut = $this->app->make(AtndCrawlerApplication::class);
    }

    /** @test */
    public function crawl_正常系()
    {
        // 実行
        /** @var EventList $actual */
        $actual = $this->sut->crawl();

        // 確認
        $this->assertTrue($actual instanceof EventList);
        $this->assertEquals(2, $actual->count());

        /** @var Event $event */
        $event = $actual->get(0);
        $this->assertEquals('サンプルイベント1', $event->getEventCore()->getEventTitle());
    }

}
