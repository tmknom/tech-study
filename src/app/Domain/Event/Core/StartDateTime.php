<?php

namespace App\Domain\Event\Core;

use App\Library\Domain\ValueObject;

class StartDateTime
{

    use ValueObject;

    /** @var int */
    private $value;

    public function formatDateTime()
    {
        return date('Y-m-d H:i:s', $this->value);
    }

    public function isWithinOneYear()
    {
        if ($this->value < strtotime("+1 year")) {
            return true;
        }
        return false;
    }

}
