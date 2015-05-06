<?php

namespace App\Domain\Event\Geolocation;

use App\Library\Domain\ValueObject;

class Latitude
{

    use ValueObject;

    /** @var float */
    private $value;

}
