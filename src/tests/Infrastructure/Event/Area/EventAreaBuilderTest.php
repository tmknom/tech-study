<?php

namespace Tests\Infrastructure\Event\Area;

use App\Domain\Event\Area\EventArea;
use App\Domain\Event\Area\PrefectureCode;
use App\Domain\Event\Area\RegionCode;
use App\Infrastructure\Event\Area\EventAreaBuilder;
use PHPUnit_Framework_TestCase;

class EventAreaBuilderTest extends PHPUnit_Framework_TestCase
{

    /** @test */
    public function build_正常系()
    {
        // 実行
        $actual = EventAreaBuilder::builder()
                ->setPrefectureCode(1)
                ->setRegionCode(2)
                ->build();

        // 確認
        $expected = new EventArea(
                new PrefectureCode(1), new RegionCode(2)
        );
        $this->assertEquals($expected, $actual);
    }

}
