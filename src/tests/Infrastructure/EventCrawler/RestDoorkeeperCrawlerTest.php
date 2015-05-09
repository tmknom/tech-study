<?php

namespace Tests\Infrastructure\EventCrawler;

use App\Domain\Event\Core\SourceType;
use App\Domain\Event\EventList;
use App\Infrastructure\EventCrawler\RestDoorkeeperCrawler;
use PHPUnit_Framework_TestCase;
use Symfony\Component\EventDispatcher\Event;
use Tests\Fixture\Stub\Event\DoorkeeperJsonHttpClient;

class RestDoorkeeperCrawlerTest extends PHPUnit_Framework_TestCase
{

    /** @var RestDoorkeeperCrawler */
    private $sut;

    /** @before */
    public function setUp()
    {
        $this->sut = new RestDoorkeeperCrawler(new DoorkeeperJsonHttpClient());
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
        $this->assertEquals("WordPressもくもく会 at コエド第２回", $eventCore->getEventTitle());
        $this->assertEquals("http://jawsug-shimane.doorkeeper.jp/events/16986", $eventCore->getEventUrl());
        $this->assertEquals(SourceType::DOORKEEPER, $eventCore->getSourceType());
        $this->assertEquals("2014-12-06 04:00:00", $eventCore->getStartDateTime()->formatDateTime());

        $eventDetail = $event->getEventDetail();
        $this->assertEquals("16986", $eventDetail->getSourceEventId());
        $this->assertEquals("概要1", $eventDetail->getEventDescription());
        $this->assertEquals("", $eventDetail->getCatchCopy());
        $this->assertEquals("1978", $eventDetail->getOwnerId());

        $eventGeolocation = $event->getEventGeolocation();
        $this->assertEquals("松江市朝日町４７８番地１８ 松江テルサ別館２階", $eventGeolocation->getAddress());
        $this->assertEquals("松江オープンソースラボ", $eventGeolocation->getPlace());
        $this->assertEquals("35.4639771", $eventGeolocation->getLatitude());
        $this->assertEquals("133.06199059999994", $eventGeolocation->getLongitude());

        $eventCapacity = $event->getEventCapacity();
        $this->assertEquals("20", $eventCapacity->getCapacityLimit());
        $this->assertEquals("5", $eventCapacity->getAccepted());
        $this->assertEquals("0", $eventCapacity->getWaiting());
    }

}
