<?php

namespace Tests\Library\TypeCheck;

use App\Library\TypeCheck\IntegerChecker;
use PHPUnit_Framework_TestCase;

class IntegerCheckerTest extends PHPUnit_Framework_TestCase
{

    /** @var SampleIntegerChecker */
    private $sut;

    /** @before */
    public function setUp()
    {
        $this->sut = new SampleIntegerChecker();
    }

    /** @test */
    public function checkInteger_正常系()
    {
        // 実行
        $this->sut->checkInteger(10);
        $this->sut->checkInteger('1');
        $this->sut->checkInteger(1.0);
    }

    /**
     * @test
     * @expectedException App\Library\TypeCheck\TypeCheckException
     */
    public function checkInteger_異常系_null()
    {
        // 実行
        $this->sut->checkInteger(null);
    }

    /**
     * @test
     * @expectedException App\Library\TypeCheck\TypeCheckException
     */
    public function checkInteger_異常系_空文字()
    {
        // 実行
        $this->sut->checkInteger('');
    }

    /**
     * @test
     * @expectedException App\Library\TypeCheck\TypeCheckException
     */
    public function checkInteger_異常系_文字列()
    {
        // 実行
        $this->sut->checkInteger('abc');
    }

    /**
     * @test
     * @expectedException App\Library\TypeCheck\TypeCheckException
     */
    public function checkInteger_異常系_浮動小数点()
    {
        // 実行
        $this->sut->checkInteger(1.1);
    }

}

class SampleIntegerChecker
{

    use IntegerChecker {
        checkInteger as public;
    }

}
