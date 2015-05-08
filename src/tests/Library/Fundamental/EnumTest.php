<?php

namespace Tests\Library\Fundamental;

use App\Library\Fundamental\Enum;
use InvalidArgumentException;
use PHPUnit_Framework_TestCase;

class EnumTest extends PHPUnit_Framework_TestCase
{

    /** @test */
    public function __construct_正常系()
    {
        // 実行
        $actual = new SampleEnum(SampleEnum::EAST);

        // 確認
        $this->assertTrue($actual instanceof SampleEnum);
        $this->assertEquals('east', $actual);
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function __construct_異常系_存在しない値を使って初期化しようとしている()
    {
        // 実行
        new SampleEnum('invalid');
    }

    /** @test */
    public function __callStatic_正常系()
    {
        // 実行
        $actual = SampleEnum::EAST();

        // 確認
        $this->assertTrue($actual instanceof SampleEnum);
        $this->assertEquals('east', $actual->getValue());
    }

    /** @test */
    public function getValue_正常系()
    {
        // 実行
        $actual = new SampleEnum(SampleEnum::EAST);

        // 確認
        $this->assertEquals('east', $actual->getValue());
    }

}

class SampleEnum
{

    use Enum;

    const EAST = 'east';
    const WEST = 'west';
    const SOUTH = 'south';
    const NORTH = 'north';

}
