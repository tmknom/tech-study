<?php

namespace Tests\Infrastructure\EventCrawler;

use App\Domain\Event\Core\SourceType;
use App\Domain\Event\EventList;
use App\Infrastructure\EventCrawler\RestZusaarCrawler;
use PHPUnit_Framework_TestCase;
use Symfony\Component\EventDispatcher\Event;
use Tests\Fixture\Stub\Event\ZusaarJsonHttpClient;

class RestZusaarCrawlerTest extends PHPUnit_Framework_TestCase
{

    /** @var RestZusaarCrawler */
    private $sut;

    /** @before */
    public function setUp()
    {
        $this->sut = new RestZusaarCrawler(new ZusaarJsonHttpClient());
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
        $this->assertEquals("Golang Cafe #55.1", $eventCore->getEventTitle());
        $this->assertEquals("http://www.zusaar.com/event/8767003", $eventCore->getEventUrl());
        $this->assertEquals(SourceType::ZUSAAR, $eventCore->getSourceType());
        $this->assertEquals("2014-11-23 18:00:00", $eventCore->getStartDateTime()->formatDateTime());

        $eventDetail = $event->getEventDetail();
        $this->assertEquals("8767003", $eventDetail->getSourceEventId());
        $this->assertEquals("概要1", $eventDetail->getEventDescription());
        $this->assertEquals("Go言語をいじり倒す会", $eventDetail->getCatchCopy());
        $this->assertEquals("agxzfnp1c2Fhci1ocmRyFQsSBFVzZXIiCzQzMDgyMDc3X3R3DA", $eventDetail->getOwnerId());

        $eventGeolocation = $event->getEventGeolocation();
        $this->assertEquals("岡山県岡山市北区青江1-12-12", $eventGeolocation->getAddress());
        $this->assertEquals("倉式珈琲店　青江店", $eventGeolocation->getPlace());
        $this->assertEquals("34.6348451", $eventGeolocation->getLatitude());
        $this->assertEquals("133.920408", $eventGeolocation->getLongitude());

        $eventCapacity = $event->getEventCapacity();
        $this->assertEquals("5", $eventCapacity->getCapacityLimit());
        $this->assertEquals("2", $eventCapacity->getAccepted());
        $this->assertEquals("0", $eventCapacity->getWaiting());
    }

}
