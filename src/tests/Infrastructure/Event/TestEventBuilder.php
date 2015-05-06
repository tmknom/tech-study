<?php

namespace Tests\Infrastructure\Event;

use App\Domain\Event\Core\SourceType;
use App\Infrastructure\Event\Builder\EventAreaBuilder;
use App\Infrastructure\Event\Builder\EventBuilder;
use App\Infrastructure\Event\Builder\EventCapacityBuilder;
use App\Infrastructure\Event\Builder\EventCoreBuilder;
use App\Infrastructure\Event\Builder\EventDetailBuilder;
use App\Infrastructure\Event\Builder\EventGeolocationBuilder;
use App\Infrastructure\Event\Builder\EventRatingBuilder;
use DateTimeImmutable;

class TestEventBuilder
{

    private $eventId;
    private $eventTitle;
    private $eventUrl;
    private $startDateTime;
    private $sourceType;
    private $sourceEventId;
    private $eventDescription;
    private $catchCopy;
    private $ownerId;
    private $address;
    private $place;
    private $latitude;
    private $longitude;
    private $prefectureCode;
    private $regionCode;
    private $capacityLimit;
    private $accepted;
    private $waiting;
    private $hatenaBookmarkCount;
    private $twitterCount;
    private $facebookCount;
    private $googlePlusCount;
    private $pocketCount;

    /** コンストラクタ */
    private function __construct()
    {
        $this->eventId = 1;

        $this->eventTitle = 'サンプルイベント1';
        $this->eventUrl = 'http://atnd.org/events/17662';
        $this->startDateTime = '2014-10-20 19:00:00';
        $this->sourceType = SourceType::ATND;

        $this->sourceEventId = '17662';
        $this->eventDescription = '概要1';
        $this->catchCopy = 'キャッチコピー1';
        $this->ownerId = '10000';

        $this->address = '東京都千代田区丸の内3丁目5番1号';
        $this->place = '東京国際フォーラム　ホールB7';
        $this->latitude = 35.6769467;
        $this->longitude = 139.7635034;

        $this->prefectureCode = 13;
        $this->regionCode = 3;

        $this->capacityLimit = 30;
        $this->accepted = 5;
        $this->waiting = 0;

        $this->hatenaBookmarkCount = 10;
        $this->twitterCount = 5;
        $this->facebookCount = 3;
        $this->googlePlusCount = 1;
        $this->pocketCount = 15;
    }

    public function setEventId($eventId)
    {
        $this->eventId = $eventId;
        return $this;
    }

    public function setEventTitle($eventTitle)
    {
        $this->eventTitle = $eventTitle;
        return $this;
    }

    public function setEventUrl($eventUrl)
    {
        $this->eventUrl = $eventUrl;
        return $this;
    }

    public function setStartDateTime($startDateTime)
    {
        $this->startDateTime = $startDateTime;
        return $this;
    }

    public function setSourceType($sourceType)
    {
        $this->sourceType = $sourceType;
        return $this;
    }

    public function setSourceEventId($sourceEventId)
    {
        $this->sourceEventId = $sourceEventId;
        return $this;
    }

    public function setEventDescription($eventDescription)
    {
        $this->eventDescription = $eventDescription;
        return $this;
    }

    public function setCatchCopy($catchCopy)
    {
        $this->catchCopy = $catchCopy;
        return $this;
    }

    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;
        return $this;
    }

    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    public function setPlace($place)
    {
        $this->place = $place;
        return $this;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function setPrefectureCode($prefectureCode)
    {
        $this->prefectureCode = $prefectureCode;
        return $this;
    }

    public function setRegionCode($regionCode)
    {
        $this->regionCode = $regionCode;
        return $this;
    }

    public function setCapacityLimit($capacityLimit)
    {
        $this->capacityLimit = $capacityLimit;
        return $this;
    }

    public function setAccepted($accepted)
    {
        $this->accepted = $accepted;
        return $this;
    }

    public function setWaiting($waiting)
    {
        $this->waiting = $waiting;
        return $this;
    }

    public function setHatenaBookmarkCount($hatenaBookmarkCount)
    {
        $this->hatenaBookmarkCount = $hatenaBookmarkCount;
        return $this;
    }

    public function setTwitterCount($twitterCount)
    {
        $this->twitterCount = $twitterCount;
        return $this;
    }

    public function setFacebookCount($facebookCount)
    {
        $this->facebookCount = $facebookCount;
        return $this;
    }

    public function setGooglePlusCount($googlePlusCount)
    {
        $this->googlePlusCount = $googlePlusCount;
        return $this;
    }

    public function setPocketCount($pocketCount)
    {
        $this->pocketCount = $pocketCount;
        return $this;
    }

    public function build()
    {
        return EventBuilder::builder()
                        ->setEventId($this->eventId)
                        ->setEventCore($this->createEventCore())
                        ->setEventDetail($this->createEventDetail())
                        ->setEventCapacity($this->createEventCapacity())
                        ->setEventRating($this->createEventRating())
                        ->setEventGeolocation($this->createGeolocation())
                        ->setEventArea($this->createEventArea())
                        ->build();
    }

    private function createEventCore()
    {
        return EventCoreBuilder::builder()
                        ->setEventTitle($this->eventTitle)
                        ->setEventUrl($this->eventUrl)
                        ->setStartDateTime(new DateTimeImmutable($this->startDateTime))
                        ->setSourceType($this->sourceType)
                        ->build();
    }

    private function createEventDetail()
    {
        return EventDetailBuilder::builder()
                        ->setSourceEventId($this->sourceEventId)
                        ->setEventDescription($this->eventDescription)
                        ->setCatchCopy($this->catchCopy)
                        ->setOwnerId($this->ownerId)
                        ->build();
    }

    private function createGeolocation()
    {
        return EventGeolocationBuilder::builder()
                        ->setAddress($this->address)
                        ->setPlace($this->place)
                        ->setLatitude($this->latitude)
                        ->setLongitude($this->longitude)
                        ->build();
    }

    private function createEventArea()
    {
        return EventAreaBuilder::builder()
                        ->setPrefectureCode($this->prefectureCode)
                        ->setRegionCode($this->regionCode)
                        ->build();
    }

    private function createEventCapacity()
    {
        return EventCapacityBuilder::builder()
                        ->setCapacityLimit($this->capacityLimit)
                        ->setAccepted($this->accepted)
                        ->setWaiting($this->waiting)
                        ->build();
    }

    private function createEventRating()
    {
        return EventRatingBuilder::builder()
                        ->setHatenaBookmarkCount($this->hatenaBookmarkCount)
                        ->setTwitterCount($this->twitterCount)
                        ->setFacebookCount($this->facebookCount)
                        ->setGooglePlusCount($this->googlePlusCount)
                        ->setPocketCount($this->pocketCount)
                        ->build();
    }

    /** @return TestEventBuilder */
    public static function builder()
    {
        return new TestEventBuilder();
    }

}
