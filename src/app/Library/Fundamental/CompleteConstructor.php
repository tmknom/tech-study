<?php

namespace App\Library\Fundamental;

use LogicException;

trait CompleteConstructor
{

    /**
     * 完全コンストラクタ
     * 
     * クラスのプロパティと呼び出し元コンストラクタの引数に基づいて
     * オブジェクトが持つプロパティの値を自動でセットする
     * 
     * 完全コンストラクタで実装したいクラスのコンストラクタから呼び出されることを想定
     * 
     * 【使い方】
     *  public function __construct(...) {
     *      $this->completeConstruct(func_get_args());
     *  }
     * 
     * @param array $constructorArgs コンストラクタの引数リスト（呼び出し元からfunc_get_args()の結果を渡すことを想定）
     */
    public function completeConstruct(array $constructorArgs)
    {
        // オブジェクトのキー名のリスト
        $propertyNames = array_keys(get_object_vars($this));

        // 引数の数チェック
        $this->verifyConstructor($propertyNames, $constructorArgs);

        // プロパティのセット
        $this->setProperty($propertyNames, $constructorArgs);
    }

    /**
     * プロパティに値をセット
     * 
     * 
     * @param array $propertyNames クラスのプロパティ名リスト
     * @param array $constructorArgs コンストラクタの引数リスト
     */
    private function setProperty(array $propertyNames, array $constructorArgs)
    {
        $counter = 0;
        foreach ($propertyNames as $propertyName) {
            $this->{$propertyName} = $constructorArgs[$counter];
            $counter++;
        }
    }

    /**
     * コンストラクタの引数のチェック
     */
    private function verifyConstructor(array $propertyNames, array $constructorArgs)
    {
        if (count($propertyNames) !== count($constructorArgs)) {
            throw new LogicException("CompleteConstructor error");
        }
    }

}
