<?php

namespace App\Domain\Event;

use App\Domain\Event\Area\EventArea;
use App\Domain\Event\Capacity\EventCapacity;
use App\Domain\Event\Core\EventCore;
use App\Domain\Event\Detail\EventDetail;
use App\Domain\Event\Geolocation\EventGeolocation;
use App\Domain\Event\Rating\EventRating;
use App\Library\Domain\Entity;

class Event
{

    use Entity;

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

    public function __construct(EventId $eventId, EventCore $eventCore, EventDetail $eventDetail,
                                EventCapacity $eventCapacity, EventRating $eventRating,
                                EventGeolocation $eventGeolocation, EventArea $eventArea)
    {
        $this->completeConstruct(func_get_args());
    }

    /**
     * @return bool
     */
    public function isStartWithinOneYear()
    {
        return $this->eventCore->isStartWithinOneYear();
    }

    /**
     * @return EventId
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * @return EventCore
     */
    public function getEventCore()
    {
        return $this->eventCore;
    }

    /**
     * @return EventDetail
     */
    public function getEventDetail()
    {
        return $this->eventDetail;
    }

    /**
     * @return EventCapacity
     */
    public function getEventCapacity()
    {
        return $this->eventCapacity;
    }

    /**
     * @return EventRating
     */
    public function getEventRating()
    {
        return $this->eventRating;
    }

    /**
     * @return EventGeolocation
     */
    public function getEventGeolocation()
    {
        return $this->eventGeolocation;
    }

    /**
     * @return EventArea
     */
    public function getEventArea()
    {
        return $this->eventArea;
    }

}
