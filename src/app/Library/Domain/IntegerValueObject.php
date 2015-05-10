<?php

namespace App\Library\Domain;

use App\Library\TypeCheck\IntegerChecker;

trait IntegerValueObject
{

    use IntegerChecker,
        ValueObject {
        ValueObject::__construct as construct;
    }

    /**
     * コンストラクタ
     *
     * @param int $value
     */
    public function __construct($value)
    {
        $this->construct($value);
        $this->checkInteger($this->getValue());
    }

    /**
     * @return int
     */
    protected function getValue()
    {
        return intval($this->getRawValue());
    }

}
