<?php

namespace App\Library\Fundamental;

use InvalidArgumentException;
use ReflectionObject;

/**
 * 独自のEnum定義
 *
 * 参考）http://qiita.com/Hiraku/items/71e385b56dcaa37629fe
 */
trait Enum
{

    private $value;

    function __construct($value)
    {
        $ref = new ReflectionObject($this);
        $constants = $ref->getConstants();
        if (!in_array($value, $constants, false)) {
            $message = $value . ' is not defined. Defined value is : [' . implode(",", $constants) . ']';
            throw new InvalidArgumentException($message);
        }

        $this->value = $value;
    }

    final static function __callStatic($label, $args)
    {
        $class = get_called_class();
        $const = constant("$class::$label");
        return new $class($const);
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
