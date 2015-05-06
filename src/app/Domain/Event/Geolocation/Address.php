<?php

namespace App\Domain\Event\Geolocation;

use App\Library\Domain\ValueObject;

class Address
{

    use ValueObject;

    /** @var string */
    private $value;

    public function isTokyo()
    {
        if (mb_strpos($this->value, '東京') === false) {
            return false;
        }
        return true;
    }

}
