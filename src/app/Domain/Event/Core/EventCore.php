<?php

namespace App\Domain\Event\Core;

use App\Library\Domain\Entity;

class EventCore
{

    use Entity;

    /** @var EventTitle */
    private $eventTitle;

    /** @var EventUrl */
    private $eventUrl;

    /** @var StartDateTime */
    private $startDateTime;

    /** @var SourceType */
    private $sourceType;

    public function __construct(EventTitle $eventTitle, EventUrl $eventUrl,
                                StartDateTime $startDateTime, SourceType $sourceType)
    {
        $this->completeConstruct(func_get_args());
    }

    /**
     * @return bool
     */
    public function isStartWithinOneYear()
    {
        return $this->startDateTime->isWithinOneYear();
    }

    /**
     * @return EventTitle
     */
    public function getEventTitle()
    {
        return $this->eventTitle;
    }

    /**
     * @return EventUrl
     */
    public function getEventUrl()
    {
        return $this->eventUrl;
    }

    /**
     * @return SourceType
     */
    public function getSourceType()
    {
        return $this->sourceType;
    }

    /**
     * @return StartDateTime
     */
    public function getStartDateTime()
    {
        return $this->startDateTime;
    }

}
