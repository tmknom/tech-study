<?php

namespace App\Library\TypeCheck;

trait FloatChecker
{

    /**
     * @param mixed $value
     * @throws TypeCheckException
     */
    protected function checkFloat($value)
    {
        if (filter_var($value, FILTER_VALIDATE_FLOAT) === false) {
            throw new TypeCheckException($value . ' is not float');
        }
    }

}
