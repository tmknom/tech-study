<?php

namespace App\Library\Domain;

trait StringValueObject
{

    use ValueObject;

    /**
     * @return string
     */
    protected function getValue()
    {
        return $this->getRawValue();
    }

}
