<?php

namespace App\Domain\Event;

use App\Library\Domain\ValueObject;

class EventList
{

    use ValueObject;

    /** @var array */
    private $value;

}
