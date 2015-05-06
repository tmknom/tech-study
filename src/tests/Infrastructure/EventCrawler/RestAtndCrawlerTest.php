<?php

namespace Tests\Infrastructure\EventCrawler;

use App\Domain\Event\Core\SourceType;
use App\Domain\Event\EventList;
use App\Infrastructure\EventCrawler\RestAtndCrawler;
use App\Infrastructure\EventCrawler\RestSampleCrawler;
use PHPUnit_Framework_TestCase;
use Symfony\Component\EventDispatcher\Event;
use Tests\Infrastructure\EventCrawler\Stub\AtndJsonHttpClient;

class RestAtndCrawlerTest extends PHPUnit_Framework_TestCase
{

    /** @var RestSampleCrawler */
    private $sut;

    /** @before */
    public function setUp()
    {
        $this->sut = new RestAtndCrawler(new AtndJsonHttpClient());
    }

    /** @test */
    public function crawl_正常系()
    {
        // 実行
        $actual = $this->sut->crawl();

        // 確認
        // 確認：全件チェック
        $this->assertTrue($actual instanceof EventList);
        $this->assertCount(2, $actual->getValue());

        // 確認：１件チェック
        /** @var Event $event */
        $event = $actual->getValue()[0];
        $this->assertEquals("undefined", $event->getEventId());

        $eventCore = $event->getEventCore();
        $this->assertEquals("サンプルイベント1", $eventCore->getEventTitle());
        $this->assertEquals("http://atnd.org/events/17662", $eventCore->getEventUrl());
        $this->assertEquals(SourceType::ATND, $eventCore->getSourceType());
        $this->assertEquals("2014-10-20 19:00:00", $eventCore->getStartDateTime()->formatDateTime());

        $eventDetail = $event->getEventDetail();
        $this->assertEquals("17662", $eventDetail->getSourceEventId());
        $this->assertEquals("概要1", $eventDetail->getEventDescription());
        $this->assertEquals("キャッチコピー1", $eventDetail->getCatchCopy());
        $this->assertEquals("10000", $eventDetail->getOwnerId());

        $eventGeolocation = $event->getEventGeolocation();
        $this->assertEquals("東京都千代田区丸の内3丁目5番1号", $eventGeolocation->getAddress());
        $this->assertEquals("東京国際フォーラム　ホールB7", $eventGeolocation->getPlace());
        $this->assertEquals("35.6769467", $eventGeolocation->getLatitude());
        $this->assertEquals("139.7635034", $eventGeolocation->getLongitude());

        $eventCapacity = $event->getEventCapacity();
        $this->assertEquals("30", $eventCapacity->getCapacityLimit());
        $this->assertEquals("5", $eventCapacity->getAccepted());
        $this->assertEquals("0", $eventCapacity->getWaiting());
    }

}
