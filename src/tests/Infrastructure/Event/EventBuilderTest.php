<?php

namespace Tests\Infrastructure\Event;

use App\Domain\Event\Core\SourceType;
use App\Domain\Event\Event;
use App\Domain\Event\EventId;
use App\Infrastructure\Event\Area\EventAreaBuilder;
use App\Infrastructure\Event\Capacity\EventCapacityBuilder;
use App\Infrastructure\Event\Core\EventCoreBuilder;
use App\Infrastructure\Event\Detail\EventDetailBuilder;
use App\Infrastructure\Event\EventBuilder;
use App\Infrastructure\Event\Geolocation\EventGeolocationBuilder;
use App\Infrastructure\Event\Rating\EventRatingBuilder;
use PHPUnit_Framework_TestCase;

class EventBuilderTest extends PHPUnit_Framework_TestCase
{

    /** @test */
    public function build_正常系()
    {
        // 実行
        $actual = EventBuilder::builder()
                ->setEventId(10)
                ->setEventCore($this->getEventCore())
                ->setEventDetail($this->getEventDetail())
                ->setEventCapacity($this->getEventCapacity())
                ->setEventRating($this->getEventRating())
                ->setEventGeolocation($this->getEventGeolocation())
                ->setEventArea($this->getEventArea())
                ->build();

        // 確認
        $eventId = new EventId(10);
        $expected = new Event(
                $eventId, $this->getEventCore(), $this->getEventDetail(), $this->getEventCapacity(),
                $this->getEventRating(), $this->getEventGeolocation(), $this->getEventArea()
        );
        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function build_正常系_IDが未定義の場合()
    {
        // 実行
        $actual = EventBuilder::builder()
                ->setUndefinedEventId()
                ->setEventCore($this->getEventCore())
                ->setEventDetail($this->getEventDetail())
                ->setEventCapacity($this->getEventCapacity())
                ->setEventRating($this->getEventRating())
                ->setEventGeolocation($this->getEventGeolocation())
                ->setEventArea($this->getEventArea())
                ->build();

        // 確認
        $eventId = new EventId('undefined');
        $expected = new Event(
                $eventId, $this->getEventCore(), $this->getEventDetail(), $this->getEventCapacity(),
                $this->getEventRating(), $this->getEventGeolocation(), $this->getEventArea()
        );
        $this->assertEquals($expected, $actual);
    }

    private function getEventCore()
    {
        return EventCoreBuilder::builder()
                        ->setEventTitle('タイトル1')
                        ->setEventUrl('url1')
                        ->setSourceType(SourceType::ATND)
                        ->setStartDateTime('now')
                        ->build();
    }

    private function getEventDetail()
    {
        return EventDetailBuilder::builder()
                        ->setCatchCopy('キャッチコピー1')
                        ->setEventDescription('概要1')
                        ->setOwnerId('owner1')
                        ->setSourceEventId('source_id1')
                        ->build();
    }

    private function getEventCapacity()
    {
        return EventCapacityBuilder::builder()
                        ->setCapacityLimit(1)
                        ->setAccepted(2)
                        ->setWaiting(3)
                        ->build();
    }

    private function getEventRating()
    {
        return EventRatingBuilder::builder()
                        ->setHatenaBookmarkCount(1)
                        ->setTwitterCount(2)
                        ->setFacebookCount(3)
                        ->setGooglePlusCount(4)
                        ->setPocketCount(5)
                        ->build();
    }

    private function getEventGeolocation()
    {
        return EventGeolocationBuilder::builder()
                        ->setAddress('address1')
                        ->setPlace('plase1')
                        ->setLatitude(2.1)
                        ->setLongitude(3.2)
                        ->build();
    }

    private function getEventArea()
    {
        return EventAreaBuilder::builder()
                        ->setPrefectureCode(1)
                        ->setRegionCode(2)
                        ->build();
    }

}
