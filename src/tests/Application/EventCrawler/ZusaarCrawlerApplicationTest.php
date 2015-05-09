<?php

namespace Tests\Application\EventCrawler;

use App\Application\EventCrawler\ZusaarCrawlerApplication;
use App\Domain\Event\EventList;
use App\Library\Http\JsonHttpClient;
use Tests\Base\TestCase;
use Tests\Fixture\Stub\Event\ZusaarJsonHttpClient;

class ZusaarCrawlerApplicationTest extends TestCase
{

    /** @var ZusaarCrawlerApplication */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        $this->app->bind(JsonHttpClient::class, ZusaarJsonHttpClient::class);
        $this->sut = $this->app->make(ZusaarCrawlerApplication::class);
    }

    /** @test */
    public function crawl_正常系()
    {
        // 実行
        $actual = $this->sut->crawl();

        // 確認
        $this->assertTrue($actual instanceof EventList);
        $this->assertEquals(2, $actual->count());
        $this->assertEquals('Golang Cafe #55.1', $actual->get(0)->getEventCore()->getEventTitle());
    }

}
