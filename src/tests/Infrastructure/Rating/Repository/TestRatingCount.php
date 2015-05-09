<?php

namespace Tests\Infrastructure\Rating\Repository;

use App\Domain\Rating\RatingCount;
use App\Library\Domain\ValueObject;

class TestRatingCount implements RatingCount
{

    use ValueObject;

}
