<?php

namespace App\Domain\Event;

use App\Library\Domain\DomainCollection;
use Illuminate\Support\Collection;

class EventList
{

    use DomainCollection;

    /** @var Collection */
    private $value;

}
