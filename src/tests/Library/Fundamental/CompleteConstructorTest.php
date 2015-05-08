<?php

namespace Tests\Library\Fundamental;

use App\Library\Fundamental\CompleteConstructor;
use LogicException;
use PHPUnit_Framework_TestCase;

class CompleteConstructorTest extends PHPUnit_Framework_TestCase
{

    /** @test */
    public function completeConstruct_正常系()
    {
        // 実行
        $actual = new ValidCompleteConstructor('elementA', 'elementB');

        // 確認
        $this->assertTrue($actual instanceof ValidCompleteConstructor);
    }

    /**
     * @test
     * @expectedException LogicException
     */
    public function completeConstruct_異常系_コンストラクタの引数とパラメータ数が合わない()
    {
        // 実行
        new InvalidCompleteConstructor('elementA');
    }

}

class ValidCompleteConstructor
{

    use CompleteConstructor;

    private $elementA;
    private $elementB;

    public function __construct($elementA, $elementB)
    {
        $this->completeConstruct(func_get_args());
    }

}

class InvalidCompleteConstructor
{

    use CompleteConstructor;

    private $elementA;
    private $elementB;

    public function __construct($elementA)
    {
        $this->completeConstruct(func_get_args());
    }

}
