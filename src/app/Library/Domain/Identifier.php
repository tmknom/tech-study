<?php

namespace App\Library\Domain;

trait Identifier
{

    use \App\Library\Domain\ValueObject;

    public static function createUndefinedInstance()
    {
        $class = static::class;
        return new $class(self::getUndefined());
    }

    private static function getUndefined()
    {
        return 'undefined';
    }

}
