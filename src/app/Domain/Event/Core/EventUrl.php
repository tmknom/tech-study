<?php

namespace App\Domain\Event\Core;

use App\Library\Domain\ValueObject;

class EventUrl
{

    use ValueObject;

    /**
     * URLエンコードした文字列を返す
     *
     * @return string
     */
    public function urlEncode()
    {
        return rawurlencode($this->value);
    }

}
