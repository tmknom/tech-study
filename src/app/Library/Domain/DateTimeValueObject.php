<?php

namespace App\Library\Domain;

use DateTimeImmutable;

trait DateTimeValueObject
{

    use ValueObject {
        ValueObject::__construct as construct;
    }

    /**
     * コンストラクタ
     *
     * @param DateTimeImmutable $value
     */
    public function __construct(DateTimeImmutable $value)
    {
        $this->construct($value);
    }

    /**
     * @return DateTimeImmutable
     */
    protected function getValue()
    {
        return $this->getRawValue();
    }

}
