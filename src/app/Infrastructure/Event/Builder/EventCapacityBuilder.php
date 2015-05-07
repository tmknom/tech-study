<?php

namespace App\Infrastructure\Event\Builder;

use App\Domain\Event\Capacity\Accepted;
use App\Domain\Event\Capacity\CapacityLimit;
use App\Domain\Event\Capacity\EventCapacity;
use App\Domain\Event\Capacity\Waiting;

class EventCapacityBuilder
{

    /** @var CapacityLimit */
    private $capacityLimit;

    /** @var Accepted */
    private $accepted;

    /** @var Waiting */
    private $waiting;

    /** @return EventCapacityBuilder */
    public function setCapacityLimit($value)
    {
        $this->capacityLimit = new CapacityLimit($this->getValueOrZero($value));
        return $this;
    }

    /** @return EventCapacityBuilder */
    public function setAccepted($value)
    {
        $this->accepted = new Accepted($this->getValueOrZero($value));
        return $this;
    }

    /** @return EventCapacityBuilder */
    public function setWaiting($value)
    {
        $this->waiting = new Waiting($this->getValueOrZero($value));
        return $this;
    }

    /** @return EventCapacity */
    public function build()
    {
        return new EventCapacity(
                $this->capacityLimit, $this->accepted, $this->waiting
        );
    }

    private function getValueOrZero($value)
    {
        return empty($value) ? 0 : $value;
    }

    /** @return EventCapacityBuilder */
    public static function builder()
    {
        return new EventCapacityBuilder();
    }

    /** コンストラクタ */
    private function __construct()
    {
        
    }

}
