<?php

namespace App\Domain\Event\Capacity;

use App\Library\Domain\ValueObject;

class Accepted
{

    use ValueObject;

    /** @var int */
    private $value;

}
