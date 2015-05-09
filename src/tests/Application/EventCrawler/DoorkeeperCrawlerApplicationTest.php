<?php

namespace Tests\Application\EventCrawler;

use App\Application\EventCrawler\DoorkeeperCrawlerApplication;
use App\Domain\Event\EventList;
use App\Library\Http\JsonHttpClient;
use Tests\Base\TestCase;
use Tests\Fixture\Stub\Event\DoorkeeperJsonHttpClient;

class DoorkeeperCrawlerApplicationTest extends TestCase
{

    /** @var DoorkeeperCrawlerApplication */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        $this->app->bind(JsonHttpClient::class, DoorkeeperJsonHttpClient::class);
        $this->sut = $this->app->make(DoorkeeperCrawlerApplication::class);
    }

    /** @test */
    public function crawl_正常系()
    {
        // 実行
        $actual = $this->sut->crawl();

        // 確認
        $this->assertTrue($actual instanceof EventList);
        $this->assertEquals(2, $actual->count());
        $this->assertEquals('WordPressもくもく会 at コエド第２回', $actual->get(0)->getEventCore()->getEventTitle());
    }

}
