<?php

namespace App\Library\Domain;

trait IntegerValueObject
{

    use ValueObject;

    /**
     * @return int
     */
    protected function getValue()
    {
        return $this->getRawValue();
    }

}
