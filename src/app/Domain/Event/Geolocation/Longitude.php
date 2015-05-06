<?php

namespace App\Domain\Event\Geolocation;

use App\Library\Domain\ValueObject;

class Longitude
{

    use ValueObject;

    /** @var float */
    private $value;

}
