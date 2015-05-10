<?php

namespace App\Domain\EventSummary;

use App\Domain\Event\Area\EventArea;
use App\Domain\Event\Capacity\EventCapacity;
use App\Domain\Event\Core\EventCore;
use App\Domain\Event\Detail\EventDetail;
use App\Domain\Event\EventId;
use App\Domain\Event\Geolocation\EventGeolocation;
use App\Domain\Rating\Rating;
use App\Library\Domain\Entity;

class EventSummary
{

    use Entity;

    /** @var EventId */
    private $eventId;

    /** @var EventCore */
    private $eventCore;

    /** @var EventCapacity */
    private $eventCapacity;

    /** @var Rating */
    private $rating;

    /** @var EventArea */
    private $eventArea;

    /**
     * コンストラクタ
     *
     * @param EventId $eventId
     * @param EventCore $eventCore
     * @param EventCapacity $eventCapacity
     * @param Rating $rating
     * @param EventArea $eventArea
     */
    public function __construct(EventId $eventId, EventCore $eventCore, EventCapacity $eventCapacity, 
                                Rating $rating, EventArea $eventArea)
    {
        $this->completeConstruct(func_get_args());
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
     * @return Rating
     */
    public function getRating()
    {
        return $this->rating;
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
