<?php

namespace App\Infrastructure\EventCrawler\Mapper;

use App\Domain\Event\Capacity\EventCapacity;
use App\Domain\Event\Core\EventCore;
use App\Domain\Event\Core\SourceType;
use App\Domain\Event\Detail\EventDetail;
use App\Domain\Event\Geolocation\EventGeolocation;
use App\Infrastructure\Event\Builder\EventCapacityBuilder;
use App\Infrastructure\Event\Builder\EventCoreBuilder;
use App\Infrastructure\Event\Builder\EventDetailBuilder;
use App\Infrastructure\Event\Builder\EventGeolocationBuilder;
use DateTimeImmutable;

class PartakeMapper
{

    use EventMapper;

    /**
     * @param array $json
     * @return array
     */
    protected function getEventsArray(array $json)
    {
        return $json['events'];
    }

    /**
     * @param array $json
     * @return EventCore
     */
    protected function createEventCore(array $json)
    {
        return EventCoreBuilder::builder()
                        ->setEventTitle($json['title'])
                        ->setEventUrl($this->createUrl($json['id']))
                        ->setStartDateTime($this->createDateTimeImmutable($json['beginDateTime']))
                        ->setSourceType(SourceType::PARTAKE)
                        ->build();
    }

    /**
     * @param string $id
     * @return string
     */
    private function createUrl($id)
    {
        return 'http://partake.in/events/' . $id;
    }

    /**
     * @param int $unixTimestampWithMillisecond
     * @return DateTimeImmutable
     */
    private function createDateTimeImmutable($unixTimestampWithMillisecond)
    {
        $unixTimestamp = 0;
        if ($unixTimestampWithMillisecond > 1000) {
            $unixTimestamp = floor($unixTimestampWithMillisecond / 1000);
        }

        $result = new DateTimeImmutable();
        return $result->setTimestamp($unixTimestamp);
    }

    /**
     * @param array $json
     * @return EventDetail
     */
    protected function createEventDetail(array $json)
    {
        return EventDetailBuilder::builder()
                        ->setSourceEventId($json['id'])
                        ->setEventDescription($json['description'])
                        ->setCatchCopy($json['summary'])
                        ->setOwnerId($json['ownerId'])
                        ->build();
    }

    /**
     * @param array $json
     * @return EventCapacity
     */
    protected function createEventCapacity(array $json)
    {
        return EventCapacityBuilder::builder()
                        ->setCapacityLimit(0)
                        ->setAccepted(0)
                        ->setWaiting(0)
                        ->build();
    }

    /**
     * @param array $json
     * @return EventGeolocation
     */
    protected function createGeolocation(array $json)
    {
        return EventGeolocationBuilder::builder()
                        ->setAddress($json['address'])
                        ->setPlace($json['place'])
                        ->setLatitude(null)
                        ->setLongitude(null)
                        ->build();
    }

}
