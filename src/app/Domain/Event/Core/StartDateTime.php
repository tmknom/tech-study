<?php

namespace App\Domain\Event\Core;

use App\Library\Domain\ValueObject;
use DateTimeImmutable;

class StartDateTime
{

    use ValueObject;

    /** @var DateTimeImmutable */
    private $value;

    public function __construct(DateTimeImmutable $value)
    {
        $this->completeConstruct('value', $value);
    }

    public function formatDateTime()
    {
        return $this->value->format('Y-m-d H:i:s');
    }

    public function isWithinOneYear()
    {
        if ($this->value < new DateTimeImmutable('+1 year')) {
            return true;
        }
        return false;
    }

}
