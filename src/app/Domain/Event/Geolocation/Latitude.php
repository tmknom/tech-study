<?php

namespace App\Domain\Event\Geolocation;

use App\Library\Domain\FloatValueObject;

class Latitude
{

    use FloatValueObject;

    /**
     * @return boolean 値が定義されていればtrue、そうでなければfalse
     */
    public function isUndefined()
    {
        return is_null($this->getValue());
    }

}
