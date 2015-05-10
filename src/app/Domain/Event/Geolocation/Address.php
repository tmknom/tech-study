<?php

namespace App\Domain\Event\Geolocation;

use App\Library\Domain\StringValueObject;

class Address
{

    use StringValueObject;

    /**
     * 東京かどうか判定する
     *
     * @return boolean 東京だったらtrue、そうでなければfalse
     */
    public function isTokyo()
    {
        if (mb_strpos($this->getValue(), '東京') === false) {
            return false;
        }
        return true;
    }

}
