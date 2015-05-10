<?php

namespace Tests\Domain\Event\Core;

use App\Domain\Event\Area\PrefectureCode;
use App\Domain\Event\Area\RegionCode;
use PHPUnit_Framework_TestCase;

class PrefectureCodeTest extends PHPUnit_Framework_TestCase
{

    /** @var PrefectureCode */
    private $sut;

    /** @before */
    public function setUp()
    {
        $this->sut = PrefectureCode::TOKYO();
    }

    /** @test */
    public function getName_正常系()
    {
        // 実行
        $actual = $this->sut->getName();

        // 確認
        $this->assertEquals('東京都', $actual);
    }

    /** @test */
    public function getCode_正常系()
    {
        // 実行
        $actual = $this->sut->getCode();

        // 確認
        $this->assertEquals(13, $actual);
    }

    /** @test */
    public function getRegionCode_正常系()
    {
        // 実行
        $actual = $this->sut->getRegionCode();

        // 確認
        $this->assertEquals(RegionCode::KANTO(), $actual);
    }

}
