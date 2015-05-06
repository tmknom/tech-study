<?php

namespace App\Library\Fundamental;

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
     * traitの呼び出し元クラスで、コンストラクタが定義されてない場合に完全コンストラクタとして自動で振る舞う
     * 
     * traitの呼び出し元クラスでコンストラクタが定義されている場合、本コンストラクタは呼び出されない
     * 
     * コンストラクタの引数を渡さなくても、勝手に動いてくれるため便利だが、
     * その半面、タイプヒンティングによる型チェックが出来なくなることに注意
     */
    public function __construct()
    {
        // コンストラクタの引数の値のリスト
        $constructorArgs = func_get_args();

        $this->completeConstruct($constructorArgs);
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
            throw new \Exception("CompleteConstructor error");
        }
    }

}
