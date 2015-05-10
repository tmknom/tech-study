<?php

namespace App\Library\Domain;

trait FloatValueObject
{

    use ValueObject {
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
    }

    /**
     * @return float
     */
    protected function getValue()
    {
        return $this->getRawValue();
    }

}
