<?php

namespace Tests\Infrastructure\Rating\Repository;

use App\Domain\Rating\RatingCount;
use App\Library\Domain\IntegerValueObject;

class TestRatingCount implements RatingCount
{

    use IntegerValueObject;

}
