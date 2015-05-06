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

class AtndMapper
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
                        ->setEventUrl($json['event_url'])
                        ->setStartDateTime(new DateTimeImmutable($json['started_at']))
                        ->setSourceType(SourceType::ATND)
                        ->build();
    }

    /**
     * @param array $json
     * @return EventDetail
     */
    protected function createEventDetail(array $json)
    {
        return EventDetailBuilder::builder()
                        ->setSourceEventId($json['event_id'])
                        ->setEventDescription($json['description'])
                        ->setCatchCopy($json['catch'])
                        ->setOwnerId($json['owner_id'])
                        ->build();
    }

    /**
     * @param array $json
     * @return EventCapacity
     */
    protected function createEventCapacity(array $json)
    {
        return EventCapacityBuilder::builder()
                        ->setCapacityLimit($json['limit'])
                        ->setAccepted($json['accepted'])
                        ->setWaiting($json['waiting'])
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
                        ->setLatitude($json['lat'])
                        ->setLongitude($json['lon'])
                        ->build();
    }

}
