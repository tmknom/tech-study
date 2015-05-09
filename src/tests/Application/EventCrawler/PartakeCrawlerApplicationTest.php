<?php

namespace Tests\Application\EventCrawler;

use App\Application\EventCrawler\PartakeCrawlerApplication;
use App\Domain\Event\EventList;
use App\Library\Http\JsonHttpClient;
use Tests\Base\TestCase;
use Tests\Fixture\Stub\Event\PartakeJsonHttpClient;

class PartakeCrawlerApplicationTest extends TestCase
{

    /** @var PartakeCrawlerApplication */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        $this->app->bind(JsonHttpClient::class, PartakeJsonHttpClient::class);
        $this->sut = $this->app->make(PartakeCrawlerApplication::class);
    }

    /** @test */
    public function crawl_正常系()
    {
        // 実行
        $actual = $this->sut->crawl();

        // 確認
        $this->assertTrue($actual instanceof EventList);
        $this->assertEquals(2, $actual->count());
        $this->assertEquals('ガチ勢になるための圏論勉強会 第三十回', $actual->get(0)->getEventCore()->getEventTitle());
    }

}
