<?php

namespace App\Domain\Rating\RatingCount;

use App\Domain\Rating\RatingCount;
use App\Library\Domain\IntegerValueObject;

class HatenaBookmarkCount implements RatingCount
{

    use IntegerValueObject;

}
