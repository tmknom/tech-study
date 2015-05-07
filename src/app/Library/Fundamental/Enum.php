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

    /** コンストラクタ */
    public function __construct($value)
    {
        $ref = new ReflectionObject($this);
        $constants = $ref->getConstants();
        if (!in_array($value, $constants, false)) {
            $message = $value . ' is not defined. Defined value is : [' . implode(",", $constants) . ']';
            throw new InvalidArgumentException($message);
        }

        $this->value = $value;
    }

    /**
     * 静的メソッド呼び出しであたかもEnumの定数を取得するマジックメソッド
     *
     * @param string $label
     * @param array $args
     * @return mixed
     */
    final public static function __callStatic($label, $args)
    {
        // 静的メソッドのコール元のクラス名を取得
        $class = get_called_class();
        // $labelと名前が一致する定数の値を取得する
        $const = constant("$class::$label");
        // コール元のクラスのインスタンスを、$labelの値を使って作成する
        return new $class($const);
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return strval($this->value);
    }

}
