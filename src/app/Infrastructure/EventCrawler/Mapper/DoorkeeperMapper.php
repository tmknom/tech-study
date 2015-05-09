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

class DoorkeeperMapper
{

    use EventMapper;

    /**
     * @param array $json
     * @return array
     */
    protected function getEventsArray(array $json)
    {
        return $json;
    }

    /**
     * @param array $json
     * @return EventCore
     */
    protected function createEventCore(array $json)
    {
        return EventCoreBuilder::builder()
                        ->setEventTitle($json['title'])
                        ->setEventUrl($json['public_url'])
                        ->setStartDateTime(new DateTimeImmutable($this->convertJST($json['starts_at'])))
                        ->setSourceType(SourceType::DOORKEEPER)
                        ->build();
    }

    private function convertJST($value)
    {
        return substr($value, 0, 19) . '+09:00';
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
                        ->setCatchCopy('')
                        ->setOwnerId($json['group']['id'])
                        ->build();
    }

    /**
     * @param array $json
     * @return EventCapacity
     */
    protected function createEventCapacity(array $json)
    {
        return EventCapacityBuilder::builder()
                        ->setCapacityLimit($json['ticket_limit'])
                        ->setAccepted($json['participants'])
                        ->setWaiting($json['waitlisted'])
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
                        ->setPlace($json['venue_name'])
                        ->setLatitude($json['lat'])
                        ->setLongitude($json['long'])
                        ->build();
    }

}
