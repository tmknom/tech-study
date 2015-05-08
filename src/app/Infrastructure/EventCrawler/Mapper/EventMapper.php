<?php

namespace App\Infrastructure\EventCrawler\Mapper;

use App\Domain\Event\Area\EventArea;
use App\Domain\Event\Area\PrefectureCode;
use App\Domain\Event\Area\RegionCode;
use App\Domain\Event\Capacity\EventCapacity;
use App\Domain\Event\Core\EventCore;
use App\Domain\Event\Detail\EventDetail;
use App\Domain\Event\Event;
use App\Domain\Event\EventList;
use App\Domain\Event\Geolocation\EventGeolocation;
use App\Domain\Rating\RatingCount\EventRating;
use App\Infrastructure\Event\Builder\EventAreaBuilder;
use App\Infrastructure\Event\Builder\EventBuilder;
use App\Infrastructure\Event\Builder\EventRatingBuilder;

trait EventMapper
{

    /**
     * @param array $response
     * @return EventList
     */
    public function createEventList(array $response)
    {
        $result = array();
        $eventArrayList = $this->getEventsArray($response);
        foreach ($eventArrayList as $value) {
            $eventArray = $this->getEventArray($value);
            $event = $this->createEvent($eventArray);
            if ($event->isStartWithinOneYear()) {
                array_push($result, $event);
            }
        }
        return new EventList($result);
    }

    /**
     * @param array $json
     * @return array
     */
    abstract protected function getEventsArray(array $json);

    /**
     * @param array $json
     * @return EventCore
     */
    abstract protected function createEventCore(array $json);

    /**
     * @param array $json
     * @return EventDetail
     */
    abstract protected function createEventDetail(array $json);

    /**
     * @param array $json
     * @return EventCapacity
     */
    abstract protected function createEventCapacity(array $json);

    /**
     * @param array $json
     * @return EventGeolocation
     */
    abstract protected function createGeolocation(array $json);

    /**
     * @param array $value
     * @return array
     */
    private function getEventArray(array $value)
    {
        if (array_key_exists('event', $value)) {
            return $value['event'];
        }
        return $value;
    }

    /**
     * @param array $json
     * @return Event
     */
    private function createEvent(array $json)
    {
        $eventGeolocation = $this->createGeolocation($json);
        $eventArea = $this->createEventArea($eventGeolocation);

        return EventBuilder::builder()
                        ->setUndefinedEventId()
                        ->setEventCore($this->createEventCore($json))
                        ->setEventDetail($this->createEventDetail($json))
                        ->setEventCapacity($this->createEventCapacity($json))
                        ->setEventRating($this->createEventRating())
                        ->setEventGeolocation($eventGeolocation)
                        ->setEventArea($eventArea)
                        ->build();
    }

    /**
     * @return EventRating
     */
    private function createEventRating()
    {
        return EventRatingBuilder::builder()
                        ->setHatenaBookmarkCount(0)
                        ->setTwitterCount(0)
                        ->setFacebookCount(0)
                        ->setGooglePlusCount(0)
                        ->setPocketCount(0)
                        ->build();
    }

    /**
     * @param EventGeolocation $eventGeolocation
     * @return EventArea
     */
    private function createEventArea(EventGeolocation $eventGeolocation)
    {
        if ($eventGeolocation->getAddress()->isTokyo()) {
            return $this->createTokyoEventArea();
        }
        return $this->createUndefinedEventArea();
    }

    private function createTokyoEventArea()
    {
        return EventAreaBuilder::builder()
                        ->setPrefectureCode(new PrefectureCode('13'))
                        ->setRegionCode(new RegionCode('3'))
                        ->build();
    }

    private function createUndefinedEventArea()
    {
        return EventAreaBuilder::builder()
                        ->setPrefectureCode(PrefectureCode::UNDEFINED)
                        ->setRegionCode(RegionCode::UNDEFINED)
                        ->build();
    }

}
