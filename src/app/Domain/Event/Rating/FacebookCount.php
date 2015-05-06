<?php

namespace App\Domain\Event\Rating;

use App\Library\Domain\ValueObject;

class FacebookCount
{

    use ValueObject;

    /** @var int */
    private $value;

}
