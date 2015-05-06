<?php

namespace Tests\Domain\Event\Core;

use App\Domain\Event\Core\StartDateTime;
use DateTimeImmutable;
use PHPUnit_Framework_TestCase;

class StartDateTimeTest extends PHPUnit_Framework_TestCase
{

    /** @test */
    public function formatDateTime_正常系()
    {
        // 事前準備
        $sut = new StartDateTime(new DateTimeImmutable('2015-12-30 10:11:12'));

        // 実行
        $actual = $sut->formatDateTime();

        // 確認
        $this->assertEquals('2015-12-30 10:11:12', $actual);
    }

    /** @test */
    public function isWithinOneYear_正常系_一年以内の場合()
    {
        // 事前準備
        $sut = new StartDateTime(new DateTimeImmutable('+1 month'));

        // 実行
        $actual = $sut->isWithinOneYear();

        // 確認
        $this->assertEquals(true, $actual);
    }

    /** @test */
    public function isWithinOneYear_正常系_一年以上の場合()
    {
        // 事前準備
        $sut = new StartDateTime(new DateTimeImmutable('+1 year'));

        // 実行
        $actual = $sut->isWithinOneYear();

        // 確認
        $this->assertEquals(false, $actual);
    }

}
