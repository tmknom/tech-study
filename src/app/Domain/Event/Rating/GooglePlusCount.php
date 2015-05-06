<?php

namespace App\Domain\Event\Rating;

use App\Library\Domain\ValueObject;

class GooglePlusCount
{

    use ValueObject;

    /** @var int */
    private $value;

}
