<?php

namespace App\Domain\Rating\RatingCount;

use App\Library\Domain\ValueObject;

class GooglePlusCount implements RatingCount
{

    use ValueObject;

    /** @var int */
    private $value;

}
