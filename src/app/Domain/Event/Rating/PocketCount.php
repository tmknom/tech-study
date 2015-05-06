<?php

namespace App\Domain\Event\Rating;

use App\Library\Domain\ValueObject;

class PocketCount
{

    use ValueObject;

    /** @var int */
    private $value;

}
