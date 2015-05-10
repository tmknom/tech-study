<?php

namespace App\Library\Domain;

use App\Library\TypeCheck\FloatChecker;

trait FloatValueObject
{

    use FloatChecker,
        ValueObject {
        ValueObject::__construct as construct;
    }

    /**
     * コンストラクタ
     *
     * @param float $value
     */
    public function __construct($value)
    {
        $this->construct($value);
        $this->checkFloat($this->getValue());
    }

    /**
     * @return float
     */
    protected function getValue()
    {
        return floatval($this->getRawValue());
    }

}
