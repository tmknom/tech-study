<?php

namespace App\Infrastructure\Event\Builder;

use App\Domain\Event\Detail\CatchCopy;
use App\Domain\Event\Detail\EventDescription;
use App\Domain\Event\Detail\EventDetail;
use App\Domain\Event\Detail\OwnerId;
use App\Domain\Event\Detail\SourceEventId;

class EventDetailBuilder
{

    /** @var SourceEventId */
    private $sourceEventId;

    /** @var EventDescription */
    private $eventDescription;

    /** @var CatchCopy */
    private $catchCopy;

    /** @var OwnerId */
    private $ownerId;

    /** @return EventDetailBuilder */
    public function setSourceEventId($value)
    {
        $this->sourceEventId = new SourceEventId($value);
        return $this;
    }

    /** @return EventDetailBuilder */
    public function setEventDescription($value)
    {
        $partialValue = mb_substr($this->getValueOrEmpty($value), 0, 16384);
        $this->eventDescription = new EventDescription($partialValue);
        return $this;
    }

    /** @return EventDetailBuilder */
    public function setCatchCopy($value)
    {
        $this->catchCopy = new CatchCopy($this->getValueOrEmpty($value));
        return $this;
    }

    /** @return EventDetailBuilder */
    public function setOwnerId($value)
    {
        $this->ownerId = new OwnerId($value);
        return $this;
    }

    /** @return EventDetail */
    public function build()
    {
        return new EventDetail(
                $this->sourceEventId, $this->eventDescription, $this->catchCopy, $this->ownerId
        );
    }

    private function getValueOrEmpty($value)
    {
        return empty($value) ? '' : $value;
    }

    /** @return EventDetailBuilder */
    public static function builder()
    {
        return new EventDetailBuilder();
    }

    /** コンストラクタ */
    private function __construct()
    {
        
    }

}
