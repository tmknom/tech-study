<?php

namespace App\Domain\Rating\RatingCount;

use App\Domain\Rating\RatingCount;
use App\Library\Domain\ValueObject;

class TwitterCount implements RatingCount
{

    use ValueObject;

    /** @var int */
    private $value;

}
