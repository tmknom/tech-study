<?php

namespace App\Infrastructure\EventSummary\Builder;

use App\Domain\Event\Area\EventArea;
use App\Domain\Event\Capacity\EventCapacity;
use App\Domain\Event\Core\EventCore;
use App\Domain\Event\EventId;
use App\Domain\EventSummary\EventSummary;
use App\Domain\Rating\Rating;

class EventSummaryBuilder
{

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

    /** @return EventSummaryBuilder */
    public function setEventId($value)
    {
        $this->eventId = new EventId($value);
        return $this;
    }

    /** @return EventSummaryBuilder */
    public function setEventCore(EventCore $value)
    {
        $this->eventCore = $value;
        return $this;
    }

    /** @return EventSummaryBuilder */
    public function setEventCapacity(EventCapacity $value)
    {
        $this->eventCapacity = $value;
        return $this;
    }

    /** @return EventSummaryBuilder */
    public function setRating(Rating $value)
    {
        $this->rating = $value;
        return $this;
    }

    /** @return EventSummaryBuilder */
    public function setEventArea(EventArea $eventArea)
    {
        $this->eventArea = $eventArea;
        return $this;
    }

    /** @return EventSummary */
    public function build()
    {
        return new EventSummary($this->eventId, $this->eventCore, $this->eventCapacity, $this->rating, $this->eventArea);
    }

    /** @return EventSummaryBuilder */
    public static function builder()
    {
        return new EventSummaryBuilder();
    }

    /** コンストラクタ */
    private function __construct()
    {
        
    }

}
