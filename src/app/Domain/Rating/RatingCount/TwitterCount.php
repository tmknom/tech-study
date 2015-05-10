<?php

namespace App\Domain\Rating\RatingCount;

use App\Domain\Rating\RatingCount;
use App\Library\Domain\IntegerValueObject;

class TwitterCount implements RatingCount
{

    use IntegerValueObject;

}
