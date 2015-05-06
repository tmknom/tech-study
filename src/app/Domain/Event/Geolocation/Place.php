<?php

namespace App\Domain\Event\Geolocation;

use App\Library\Domain\ValueObject;

class Place
{

    use ValueObject;

    /** @var string */
    private $value;

}
