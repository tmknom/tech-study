<?php

namespace App\Infrastructure\Event\Detail;

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

    public function setSourceEventId($value)
    {
        $this->sourceEventId = new SourceEventId($value);
        return $this;
    }

    public function setEventDescription($value)
    {
        if (empty($value)) {
            $value = '';
        }
        $partialValue = mb_substr($value, 0, 16384);
        $this->eventDescription = new EventDescription($partialValue);
        return $this;
    }

    public function setCatchCopy($value)
    {
        $this->catchCopy = new CatchCopy($value);
        return $this;
    }

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
