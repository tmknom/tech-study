<?php

namespace App\Domain\Rating\RatingCount;

use App\Domain\Rating\RatingCount;
use App\Library\Domain\IntegerValueObject;

class PocketCount implements RatingCount
{

    use IntegerValueObject;

}
