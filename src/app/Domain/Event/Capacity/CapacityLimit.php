<?php

namespace App\Domain\Event\Capacity;

use App\Library\Domain\ValueObject;

class CapacityLimit
{

    use ValueObject;

    /** @var int */
    private $value;

}
