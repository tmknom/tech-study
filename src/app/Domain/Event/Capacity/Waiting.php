<?php

namespace App\Domain\Event\Capacity;

use App\Library\Domain\ValueObject;

class Waiting
{

    use ValueObject;

    /** @var int */
    private $value;

}
