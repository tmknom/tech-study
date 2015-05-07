<?php

namespace App\Domain\Event\Detail;

use App\Library\Domain\Aggregate;

class EventDetail
{

    use Aggregate;

    /** @var SourceEventId */
    private $sourceEventId;

    /** @var EventDescription */
    private $eventDescription;

    /** @var CatchCopy */
    private $catchCopy;

    /** @var OwnerId */
    private $ownerId;

    /**
     * コンストラクタ
     *
     * @param SourceEventId $sourceEventId
     * @param EventDescription $eventDescription
     * @param CatchCopy $catchCopy
     * @param OwnerId $ownerId
     */
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
