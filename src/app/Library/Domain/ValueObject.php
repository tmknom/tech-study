<?php

namespace App\Library\Domain;

trait ValueObject
{

    use \App\Library\Fundamental\OneArgumentCompleteConstructor;

    public function __construct($value)
    {
        $this->completeConstruct('value', $value);
    }

    public function getValue()
    {
        return $this->value;
    }

    public function __toString()
    {
        return strval($this->value);
    }

}
