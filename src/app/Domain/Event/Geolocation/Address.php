<?php

namespace App\Domain\Event\Geolocation;

use App\Library\Domain\ValueObject;

class Address
{

    use ValueObject;

    /**
     * 東京かどうか判定する
     *
     * @return boolean 東京だったらtrue、そうでなければfalse
     */
    public function isTokyo()
    {
        if (mb_strpos($this->value, '東京') === false) {
            return false;
        }
        return true;
    }

}
