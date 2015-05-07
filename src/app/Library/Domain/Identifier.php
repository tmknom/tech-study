<?php

namespace App\Library\Domain;

trait Identifier
{

    use \App\Library\Domain\ValueObject;

    /**
     * 識別子が未定義の場合の識別子オブジェクトを生成する
     *
     * 生成されるオブジェクトの型は、本traitをuseしているクラスの型になる。
     * 識別子の生成は主に、RDBMSの機能を使うことが多いので、
     * 本メソッドが使用されるのは、永続化前のEntityが主となる。
     *
     * @return mixed
     */
    public static function createUndefinedInstance()
    {
        $class = static::class;
        return new $class(self::getUndefined());
    }

    /**
     * 識別子が未定義かどうかチェックする
     *
     * @return boolean 未定義だったらtrue、そうでなければfalse
     */
    public function isUndefined()
    {
        return $this->value === self::getUndefined();
    }

    /**
     * 識別子が未定義の場合の値
     *
     * @return string
     */
    private static function getUndefined()
    {
        return 'undefined';
    }

}
