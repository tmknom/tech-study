<?php

namespace App\Library\Domain;

trait FloatValueObject
{

    use ValueObject;

    /**
     * @return float
     */
    protected function getValue()
    {
        return $this->getRawValue();
    }

}
