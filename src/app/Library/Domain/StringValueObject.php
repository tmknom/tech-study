<?php

namespace App\Library\Domain;

use App\Library\TypeCheck\StringChecker;

trait StringValueObject
{

    use StringChecker,
        ValueObject {
        ValueObject::__construct as construct;
    }

    /**
     * コンストラクタ
     *
     * @param string $value
     */
    public function __construct($value)
    {
        $this->construct($value);
        $this->checkString($this->getValue());
    }

    /**
     * @return string
     */
    protected function getValue()
    {
        return strval($this->getRawValue());
    }

}
