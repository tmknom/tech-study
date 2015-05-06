<?php

namespace App\Domain\Event\Rating;

use App\Library\Domain\ValueObject;

class TwitterCount
{

    use ValueObject;

    /** @var int */
    private $value;

}
