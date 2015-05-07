<?php

namespace App\Infrastructure\Event\Builder;

use App\Domain\Event\Core\EventCore;
use App\Domain\Event\Core\EventTitle;
use App\Domain\Event\Core\EventUrl;
use App\Domain\Event\Core\SourceType;
use App\Domain\Event\Core\StartDateTime;
use DateTimeImmutable;

class EventCoreBuilder
{

    /** @var EventTitle */
    private $eventTitle;

    /** @var EventUrl */
    private $eventUrl;

    /** @var StartDateTime */
    private $startDateTime;

    /** @var SourceType */
    private $sourceType;

    /** @return EventCoreBuilder */
    public function setEventTitle($value)
    {
        $this->eventTitle = new EventTitle($value);
        return $this;
    }

    /** @return EventCoreBuilder */
    public function setEventUrl($value)
    {
        $this->eventUrl = new EventUrl($value);
        return $this;
    }

    /** @return EventCoreBuilder */
    public function setStartDateTime(DateTimeImmutable $value)
    {
        $this->startDateTime = new StartDateTime($value);
        return $this;
    }

    /** @return EventCoreBuilder */
    public function setSourceType($value)
    {
        $this->sourceType = new SourceType($value);
        return $this;
    }

    /** @return EventCore */
    public function build()
    {
        return new EventCore(
                $this->eventTitle, $this->eventUrl, $this->startDateTime, $this->sourceType
        );
    }

    /** @return EventCoreBuilder */
    public static function builder()
    {
        return new EventCoreBuilder();
    }

    /** コンストラクタ */
    private function __construct()
    {
        
    }

}
