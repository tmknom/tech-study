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

        // 確認
        $this->assertTrue($actual instanceof ValidOneArgumentCompleteConstructor);
    }

    /**
     * @test
     * @expectedException LogicException
     */
    public function completeConstruct_異常系_パラメータ名が第一引数と合致しない()
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
