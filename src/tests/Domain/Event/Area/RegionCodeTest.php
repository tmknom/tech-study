<?php

namespace Tests\Domain\Event\Core;

use App\Domain\Event\Area\RegionCode;
use PHPUnit_Framework_TestCase;

class RegionCodeTest extends PHPUnit_Framework_TestCase
{

    /** @var RegionCode */
    private $sut;

    /** @before */
    public function setUp()
    {
        $this->sut = RegionCode::KANTO();
    }

    /** @test */
    public function getName_正常系()
    {
        // 実行
        $actual = $this->sut->getName();

        // 確認
        $this->assertEquals('関東', $actual);
    }

    /** @test */
    public function getCode_正常系()
    {
        // 実行
        $actual = $this->sut->getCode();

        // 確認
        $this->assertEquals(3, $actual);
    }

}
