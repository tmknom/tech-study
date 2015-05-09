<?php

namespace App\Domain\Event\Geolocation;

use App\Library\Domain\ValueObject;

class Latitude
{

    use ValueObject;

    /** @var float */
    private $value;

    /**
     * @return boolean 値が定義されていればtrue、そうでなければfalse
     */
    public function isUndefined()
    {
        return is_null($this->value);
    }

}
