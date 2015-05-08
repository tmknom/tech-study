<?php

namespace App\Domain\Event;

use App\Domain\Event\Area\EventArea;
use App\Domain\Event\Capacity\EventCapacity;
use App\Domain\Event\Core\EventCore;
use App\Domain\Event\Detail\EventDetail;
use App\Domain\Event\Geolocation\EventGeolocation;
use App\Domain\Rating\Rating;
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

    /** @var Rating */
    private $rating;

    /** @var EventGeolocation */
    private $eventGeolocation;

    /** @var EventArea */
    private $eventArea;

    /**
     * コンストラクタ
     *
     * @param EventId $eventId
     * @param EventCore $eventCore
     * @param EventDetail $eventDetail
     * @param EventCapacity $eventCapacity
     * @param Rating $rating
     * @param EventGeolocation $eventGeolocation
     * @param EventArea $eventArea
     */
    public function __construct(EventId $eventId, EventCore $eventCore, EventDetail $eventDetail,
                                EventCapacity $eventCapacity, Rating $rating,
                                EventGeolocation $eventGeolocation, EventArea $eventArea)
    {
        $this->completeConstruct(func_get_args());
    }

    /**
     * 開始日が一年以内かどうか判定する
     *
     * @return boolean 一年以内だったらtrue、そうでなければfalse
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
