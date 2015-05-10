<?php

namespace App\Domain\Event\Geolocation;

use App\Library\Domain\FloatValueObject;

class Latitude
{

    use FloatValueObject;

    const UNDEFINED = 0.0;

    /**
     * @return boolean 値が未定義ならtrue、そうでなければfalse
     */
    public function isUndefined()
    {
        return $this->getValue() === self::UNDEFINED;
    }

}
