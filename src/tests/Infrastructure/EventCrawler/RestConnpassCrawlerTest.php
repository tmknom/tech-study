<?php

namespace Tests\Infrastructure\EventCrawler;

use App\Domain\Event\Core\SourceType;
use App\Domain\Event\EventList;
use App\Infrastructure\EventCrawler\RestConnpassCrawler;
use PHPUnit_Framework_TestCase;
use Symfony\Component\EventDispatcher\Event;
use Tests\Fixture\Stub\Event\ConnpassJsonHttpClient;

class RestConnpassCrawlerTest extends PHPUnit_Framework_TestCase
{

    /** @var RestConnpassCrawler */
    private $sut;

    /** @before */
    public function setUp()
    {
        $this->sut = new RestConnpassCrawler(new ConnpassJsonHttpClient());
    }

    /** @test */
    public function crawl_正常系()
    {
        // 実行
        /** @var EventList $actual */
        $actual = $this->sut->crawl();

        // 確認：全件チェック
        $this->assertTrue($actual instanceof EventList);
        $this->assertEquals(2, $actual->count());

        // 確認：１件チェック
        /** @var Event $event */
        $event = $actual->get(0);
        $this->assertEquals("undefined", $event->getEventId());

        $eventCore = $event->getEventCore();
        $this->assertEquals("Haskell 超入門 (2014/11)", $eventCore->getEventTitle());
        $this->assertEquals("http://hs-abc.connpass.com/event/9642/", $eventCore->getEventUrl());
        $this->assertEquals(SourceType::CONNPASS, $eventCore->getSourceType());
        $this->assertEquals("2014-11-09 13:00:00", $eventCore->getStartDateTime()->formatDateTime());

        $eventDetail = $event->getEventDetail();
        $this->assertEquals("9642", $eventDetail->getSourceEventId());
        $this->assertEquals("概要1", $eventDetail->getEventDescription());
        $this->assertEquals("Haskellをいじり倒す会", $eventDetail->getCatchCopy());
        $this->assertEquals("4865", $eventDetail->getOwnerId());

        $eventGeolocation = $event->getEventGeolocation();
        $this->assertEquals("東京都豊島区池袋 2-12-11 (三共池袋ビル 4階 401号室)", $eventGeolocation->getAddress());
        $this->assertEquals("池袋バイナリ勉強会", $eventGeolocation->getPlace());
        $this->assertEquals("35.732527800000", $eventGeolocation->getLatitude());
        $this->assertEquals("139.707230600000", $eventGeolocation->getLongitude());

        $eventCapacity = $event->getEventCapacity();
        $this->assertEquals("10", $eventCapacity->getCapacityLimit());
        $this->assertEquals("3", $eventCapacity->getAccepted());
        $this->assertEquals("0", $eventCapacity->getWaiting());
    }

}
