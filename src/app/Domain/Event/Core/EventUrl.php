<?php

namespace App\Domain\Event\Core;

use App\Library\Domain\StringValueObject;

class EventUrl
{

    use StringValueObject;

    /**
     * URLエンコードした文字列を返す
     *
     * @return string
     */
    public function urlEncode()
    {
        return rawurlencode($this->getValue());
    }

}
