<?php

namespace App\Domain\Event\Capacity;

use App\Library\Domain\Entity;

class EventCapacity
{

    use Entity;

    /** @var CapacityLimit */
    private $capacityLimit;

    /** @var Accepted */
    private $accepted;

    /** @var Waiting */
    private $waiting;

    public function __construct(CapacityLimit $capacityLimit, Accepted $accepted, Waiting $waiting)
    {
        $this->completeConstruct(func_get_args());
    }

    /**
     * @return Accepted
     */
    public function getAccepted()
    {
        return $this->accepted;
    }

    /**
     * @return CapacityLimit
     */
    public function getCapacityLimit()
    {
        return $this->capacityLimit;
    }

    /**
     * @return Waiting
     */
    public function getWaiting()
    {
        return $this->waiting;
    }

}
