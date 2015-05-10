<?php

namespace App\Library\Domain;

trait IntegerValueObject
{

    use ValueObject {
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
    }

    /**
     * @return int
     */
    protected function getValue()
    {
        return $this->getRawValue();
    }

}
