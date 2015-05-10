<?php

namespace Tests\Library\TypeCheck;

use App\Library\TypeCheck\FloatChecker;
use PHPUnit_Framework_TestCase;

class FloatCheckerTest extends PHPUnit_Framework_TestCase
{

    /** @var SampleFloatChecker */
    private $sut;

    /** @before */
    public function setUp()
    {
        $this->sut = new SampleFloatChecker();
    }

    /** @test */
    public function checkFloat_正常系()
    {
        // 実行
        $this->sut->checkFloat(1.1);
        $this->sut->checkFloat('1.1');
        $this->sut->checkFloat(10);
        $this->sut->checkFloat('10');
    }

    /**
     * @test
     * @expectedException App\Library\TypeCheck\TypeCheckException
     */
    public function checkFloat_異常系_null()
    {
        // 実行
        $this->sut->checkFloat(null);
    }

    /**
     * @test
     * @expectedException App\Library\TypeCheck\TypeCheckException
     */
    public function checkFloat_異常系_空文字()
    {
        // 実行
        $this->sut->checkFloat('');
    }

    /**
     * @test
     * @expectedException App\Library\TypeCheck\TypeCheckException
     */
    public function checkFloat_異常系_文字列()
    {
        // 実行
        $this->sut->checkFloat('abc');
    }

}

class SampleFloatChecker
{

    use FloatChecker {
        checkFloat as public;
    }

}
