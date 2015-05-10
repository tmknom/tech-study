<?php

namespace Tests\Library\TypeCheck;

use App\Library\TypeCheck\StringChecker;
use PHPUnit_Framework_TestCase;

class StringCheckerTest extends PHPUnit_Framework_TestCase
{

    /** @var SampleStringChecker */
    private $sut;

    /** @before */
    public function setUp()
    {
        $this->sut = new SampleStringChecker();
    }

    /** @test */
    public function checkString_正常系()
    {
        // 実行
        $this->sut->checkString('');
        $this->sut->checkString('abc');
        $this->sut->checkString('1');
        $this->sut->checkString('1.1');
    }

    /**
     * @test
     * @expectedException App\Library\TypeCheck\TypeCheckException
     */
    public function checkString_異常系_null()
    {
        // 実行
        $this->sut->checkString(null);
    }

    /**
     * @test
     * @expectedException App\Library\TypeCheck\TypeCheckException
     */
    public function checkString_異常系_整数()
    {
        // 実行
        $this->sut->checkString(10);
    }

    /**
     * @test
     * @expectedException App\Library\TypeCheck\TypeCheckException
     */
    public function checkString_異常系_浮動小数点()
    {
        // 実行
        $this->sut->checkString(1.1);
    }

}

class SampleStringChecker
{

    use StringChecker {
        checkString as public;
    }

}
