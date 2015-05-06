<?php

namespace App\Library\Fundamental;

trait OneArgumentCompleteConstructor
{

    /**
     * 引数一個の完全コンストラクタ
     * 
     * クラスのプロパティ名もチェックする
     * クラスのプロパティ名が想定していたものと異なる場合、例外をスロー
     * 
     * @param $propertyName クラスのプロパティ名
     * @param $value コンストラクタの引数
     */
    public function completeConstruct($propertyName, $value)
    {
        // プロパティ名のチェック
        $this->verifyPropertyName($propertyName);

        // プロパティのセット
        $this->{$propertyName} = $value;
    }

    /**
     * コンストラクタの引数のチェック
     */
    private function verifyPropertyName($propertyName)
    {
        $firstObjectVarsName = array_keys(get_object_vars($this))[0];
        if ($firstObjectVarsName !== $propertyName) {
            $message = get_class() . " class : Invalid property name '$" . $firstObjectVarsName . "', Please define property name '$" . $propertyName . "'.";
            throw new \Exception($message);
        }
    }

}
