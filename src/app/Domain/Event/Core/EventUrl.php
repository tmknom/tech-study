<?php

namespace App\Domain\Event\Core;

use App\Library\Domain\ValueObject;

class EventUrl
{

    use ValueObject;

    /** @var string */
    private $value;

}
