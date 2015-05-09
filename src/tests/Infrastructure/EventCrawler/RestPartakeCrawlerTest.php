<?php

namespace Tests\Infrastructure\EventCrawler;

use App\Domain\Event\Core\SourceType;
use App\Domain\Event\EventList;
use App\Infrastructure\EventCrawler\RestPartakeCrawler;
use PHPUnit_Framework_TestCase;
use Symfony\Component\EventDispatcher\Event;
use Tests\Fixture\Stub\Event\PartakeJsonHttpClient;

class RestPartakeCrawlerTest extends PHPUnit_Framework_TestCase
{

    /** @var RestPartakeCrawler */
    private $sut;

    /** @before */
    public function setUp()
    {
        $this->sut = new RestPartakeCrawler(new PartakeJsonHttpClient());
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
        $this->assertEquals("ガチ勢になるための圏論勉強会 第三十回", $eventCore->getEventTitle());
        $this->assertEquals("http://partake.in/events/1ebca649-9b44-4581-8f27-f85a0882e39d", $eventCore->getEventUrl());
        $this->assertEquals(SourceType::PARTAKE, $eventCore->getSourceType());
        $this->assertEquals("2014-11-09 18:00:00", $eventCore->getStartDateTime()->formatDateTime());

        $eventDetail = $event->getEventDetail();
        $this->assertEquals("1ebca649-9b44-4581-8f27-f85a0882e39d", $eventDetail->getSourceEventId());
        $this->assertEquals("概要1", $eventDetail->getEventDescription());
        $this->assertEquals("キャッチコピー1", $eventDetail->getCatchCopy());
        $this->assertEquals("decadae4-0257-4b0d-8b2a-162370679012", $eventDetail->getOwnerId());

        $eventGeolocation = $event->getEventGeolocation();
        $this->assertEquals("愛知県名古屋市昭和区福江2丁目9-33", $eventGeolocation->getAddress());
        $this->assertEquals("ITプランニング", $eventGeolocation->getPlace());
        $this->assertEquals(true, $eventGeolocation->getLatitude()->isUndefined());
        $this->assertEquals(true, $eventGeolocation->getLongitude()->isUndefined());

        $eventCapacity = $event->getEventCapacity();
        $this->assertEquals("0", $eventCapacity->getCapacityLimit());
        $this->assertEquals("0", $eventCapacity->getAccepted());
        $this->assertEquals("0", $eventCapacity->getWaiting());
    }

}
