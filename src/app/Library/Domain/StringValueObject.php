<?php

namespace App\Library\Domain;

trait StringValueObject
{

    use ValueObject {
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
    }

    /**
     * @return string
     */
    protected function getValue()
    {
        return $this->getRawValue();
    }

}
