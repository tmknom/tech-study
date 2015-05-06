<?php

namespace App\Domain\Event\Detail;

use App\Library\Domain\Entity;

class EventDetail
{

    use Entity;

    /** @var SourceEventId */
    private $sourceEventId;

    /** @var EventDescription */
    private $eventDescription;

    /** @var CatchCopy */
    private $catchCopy;

    /** @var OwnerId */
    private $ownerId;

    public function __construct(SourceEventId $sourceEventId, EventDescription $eventDescription,
                                CatchCopy $catchCopy, OwnerId $ownerId)
    {
        $this->completeConstruct(func_get_args());
    }

    /**
     * @return CatchCopy
     */
    public function getCatchCopy()
    {
        return $this->catchCopy;
    }

    /**
     * @return EventDescription
     */
    public function getEventDescription()
    {
        return $this->eventDescription;
    }

    /**
     * @return OwnerId
     */
    public function getOwnerId()
    {
        return $this->ownerId;
    }

    /**
     * @return SourceEventId
     */
    public function getSourceEventId()
    {
        return $this->sourceEventId;
    }

}
