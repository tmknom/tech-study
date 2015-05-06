<?php

namespace App\Domain\Event\Detail;

use App\Library\Domain\ValueObject;

class OwnerId
{

    use ValueObject;

    /** @var string */
    private $value;

}
