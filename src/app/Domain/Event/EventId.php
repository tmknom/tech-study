<?php

namespace App\Domain\Event;

use App\Library\Domain\Identifier;

class EventId
{

    use Identifier;

    /** @var int */
    private $value;

}
