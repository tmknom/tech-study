<?php

namespace App\Domain\Event\Detail;

use App\Library\Domain\ValueObject;

class EventDescription
{

    use ValueObject;

    /** @var string */
    private $value;

}
