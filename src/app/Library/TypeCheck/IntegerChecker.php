<?php

namespace App\Library\TypeCheck;

trait IntegerChecker
{

    /**
     * @param mixed $value
     * @throws TypeCheckException
     */
    protected function checkInteger($value)
    {
        if (filter_var($value, FILTER_VALIDATE_INT) === false) {
            throw new TypeCheckException($value . ' is not integer');
        }
    }

}
