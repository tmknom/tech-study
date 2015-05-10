<?php

namespace App\Library\TypeCheck;

trait StringChecker
{

    /**
     * @param mixed $value
     * @throws TypeCheckException
     */
    protected function checkString($value)
    {
        if (!is_string($value)) {
            throw new TypeCheckException($value . ' is not string');
        }
    }

}
