<?php

namespace App\Domain\Rating\RatingCount;

use App\Library\Domain\ValueObject;

class FacebookCount implements RatingCount
{

    use ValueObject;

    /** @var int */
    private $value;

}
