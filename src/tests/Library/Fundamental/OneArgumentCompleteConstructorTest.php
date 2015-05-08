<?php

namespace Tests\Library\Fundamental;

use App\Library\Fundamental\OneArgumentCompleteConstructor;
use LogicException;
use PHPUnit_Framework_TestCase;

class OneArgumentCompleteConstructorTest extends PHPUnit_Framework_TestCase
{

    /** @test */
    public function completeConstruct_正常系()
    {
        // 実行
        $actual = new ValidOneArgumentCompleteConstructor('elementA');

        // 確認：全件チェック
        $this->assertTrue($actual instanceof ValidOneArgumentCompleteConstructor);
    }

    /**
     * @test
     * @expectedException LogicException
     */
    public function completeConstruct_異常系_コンストラクタの引数とパラメータ数が合わない()
    {
        // 実行
        new InvalidOneArgumentCompleteConstructor('elementA');
    }

}

class ValidOneArgumentCompleteConstructor
{

    use OneArgumentCompleteConstructor;

    private $value;

    public function __construct($value)
    {
        $this->completeConstruct('value', $value);
    }

}

class InvalidOneArgumentCompleteConstructor
{

    use OneArgumentCompleteConstructor;

    private $value;

    public function __construct($value)
    {
        $this->completeConstruct('invalid', $value);
    }

}
