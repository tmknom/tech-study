<?php

namespace App\Domain\Event\Core;

use App\Library\Domain\ValueObject;

class EventTitle
{

    use ValueObject;

    /** @var string */
    private $value;

}
