<?php

namespace App\Domain\Event\Rating;

use App\Library\Domain\ValueObject;

class HatenaBookmarkCount
{

    use ValueObject;

    /** @var int */
    private $value;

}
