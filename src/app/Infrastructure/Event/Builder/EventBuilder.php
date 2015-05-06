<?php

namespace App\Infrastructure\Event\Builder;

use App\Domain\Event\Area\EventArea;
use App\Domain\Event\Capacity\EventCapacity;
use App\Domain\Event\Core\EventCore;
use App\Domain\Event\Detail\EventDetail;
use App\Domain\Event\Event;
use App\Domain\Event\EventId;
use App\Domain\Event\Geolocation\EventGeolocation;
use App\Domain\Event\Rating\EventRating;

class EventBuilder
{

    /** @var EventId */
    private $eventId;

    /** @var EventCore */
    private $eventCore;

    /** @var EventDetail */
    private $eventDetail;

    /** @var EventCapacity */
    private $eventCapacity;

    /** @var EventRating */
    private $eventRating;

    /** @var EventGeolocation */
    private $eventGeolocation;

    /** @var EventArea */
    private $eventArea;

    public function setUndefinedEventId()
    {
        $this->eventId = EventId::createUndefinedInstance();
        return $this;
    }

    public function setEventId($value)
    {
        $this->eventId = new EventId($value);
        return $this;
    }

    public function setEventCore(EventCore $value)
    {
        $this->eventCore = $value;
        return $this;
    }

    public function setEventDetail(EventDetail $value)
    {
        $this->eventDetail = $value;
        return $this;
    }

    public function setEventCapacity(EventCapacity $value)
    {
        $this->eventCapacity = $value;
        return $this;
    }

    public function setEventRating(EventRating $value)
    {
        $this->eventRating = $value;
        return $this;
    }

    public function setEventGeolocation(EventGeolocation $value)
    {
        $this->eventGeolocation = $value;
        return $this;
    }

    public function setEventArea(EventArea $eventArea)
    {
        $this->eventArea = $eventArea;
        return $this;
    }

    /** @return Event */
    public function build()
    {
        return new Event(
                $this->eventId, $this->eventCore, $this->eventDetail, $this->eventCapacity,
                $this->eventRating, $this->eventGeolocation, $this->eventArea
        );
    }

    /** @return EventBuilder */
    public static function builder()
    {
        return new EventBuilder();
    }

    /** コンストラクタ */
    private function __construct()
    {
        
    }

}
